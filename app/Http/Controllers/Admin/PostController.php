<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Brand;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('user')->latest();

        // Apply filters
        if ($request->has('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true)
                      ->where('published_at', '<=', now());
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            } elseif ($request->status === 'scheduled') {
                $query->where('is_published', true)
                      ->where('published_at', '>', now());
            }
        }

        if ($request->has('author')) {
            $query->where('user_id', $request->author);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('product_name', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(10);
        $users = User::all();

        // Count trashed posts
        $trashedCount = Post::onlyTrashed()->count();

        return view('admin.posts.index', compact('posts', 'users', 'trashedCount'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();

        // Get brands for categories that have brands (excluding Mechanical, Electrical, Material Handling, Tools & Lifting)
        $brandsByCategory = [];

        $fireProtection = Category::where('slug', 'fire-protection')->first();
        if ($fireProtection) {
            $fireBrands = Brand::whereIn('slug', [
                'hd-fire', 'kidde', 'buckeye', 'lehavot', 'nittan',
                'honeywell', 'protectowire', 'bristol', 'eaton',
                'pentair', 'ansul', 'amerex', 'tyco', 'rotarex'
            ])->where('is_active', true)->get();

            $brandsByCategory['fire_protection'] = $fireBrands;
        }

        // No mechanical brands needed - removed
        // No electrical brands needed - removed
        // No material handling brands needed - removed
        // No tools & lifting brands needed - removed

        $auxilliary = Category::where('slug', 'auxilliary')->first();
        if ($auxilliary) {
            $auxBrands = Brand::whereIn('slug', [
                'dahua', 'zkteco', 'hid-global', 'honeywell', 'hikvision'
            ])->where('is_active', true)->get();

            $brandsByCategory['auxilliary'] = $auxBrands;
        }

        return view('admin.posts.create', compact('categories', 'brandsByCategory'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'product_name' => 'required|string|max:255',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'category' => 'required|string',
            'tags' => 'required|string',
        ];

        // Add conditional validation based on category
        $category = Category::where('name', $request->category)->first();

        if ($category) {
            if ($category->slug === 'mechanical') {
                // For Mechanical - require mechanical_category, brand is optional
                $validationRules['mechanical_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'electrical') {
                // For Electrical - require electrical_category, brand is optional
                $validationRules['electrical_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'material-handling') {
                // For Material Handling - require material_handling_category, brand is optional
                $validationRules['material_handling_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'tools-and-lifting-equipment') {
                // For Tools & Lifting - require tools_lifting_category, brand is optional
                $validationRules['tools_lifting_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } else {
                // For other categories - require brand
                $validationRules['brand'] = 'required|string';
            }
        }

        $validated = $request->validate($validationRules);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);

        // Ensure unique slug
        $slugCount = Post::where('slug', $validated['slug'])->count();
        if ($slugCount > 0) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        // Set user_id
        $validated['user_id'] = auth()->id();

        // Handle draft vs publish
        if ($request->has('draft')) {
            $validated['is_published'] = false;
        }

        // Convert category name to category_id
        $category = Category::where('name', $validated['category'])->first();
        if (!$category) {
            return back()->withErrors(['category' => 'Selected category does not exist.']);
        }
        $validated['category_id'] = $category->id;

        // Handle brand - only if provided (not required for Mechanical, Electrical, Material Handling, Tools & Lifting)
        if (!empty($validated['brand'])) {
            $brand = Brand::where('name', $validated['brand'])->first();

            if (!$brand) {
                // If brand doesn't exist, create it automatically
                $brand = Brand::create([
                    'name' => $validated['brand'],
                    'slug' => Str::slug($validated['brand']),
                    'is_active' => true,
                ]);
            }

            $validated['brand_id'] = $brand->id;
        } else {
            $validated['brand_id'] = null;
        }

        // For Mechanical, store the mechanical_category in tags
        if ($category->slug === 'mechanical' && !empty($validated['mechanical_category'])) {
            if (!empty($validated['tags'])) {
                $validated['tags'] = $validated['mechanical_category'] . ', ' . $validated['tags'];
            } else {
                $validated['tags'] = $validated['mechanical_category'];
            }
        }

        // For Electrical, store the electrical_category in tags
        if ($category->slug === 'electrical' && !empty($validated['electrical_category'])) {
            if (!empty($validated['tags'])) {
                $validated['tags'] = $validated['electrical_category'] . ', ' . $validated['tags'];
            } else {
                $validated['tags'] = $validated['electrical_category'];
            }
        }

        // For Material Handling, store the material_handling_category in tags
        if ($category->slug === 'material-handling' && !empty($validated['material_handling_category'])) {
            if (!empty($validated['tags'])) {
                $validated['tags'] = $validated['material_handling_category'] . ', ' . $validated['tags'];
            } else {
                $validated['tags'] = $validated['material_handling_category'];
            }
        }

        // For Tools & Lifting, store the tools_lifting_category in tags
        if ($category->slug === 'tools-and-lifting-equipment' && !empty($validated['tools_lifting_category'])) {
            if (!empty($validated['tags'])) {
                $validated['tags'] = $validated['tools_lifting_category'] . ', ' . $validated['tags'];
            } else {
                $validated['tags'] = $validated['tools_lifting_category'];
            }
        }

        // Remove the string fields that don't exist in database
        unset($validated['category']);
        unset($validated['brand']);
        unset($validated['mechanical_category']);
        unset($validated['electrical_category']);
        unset($validated['material_handling_category']);
        unset($validated['tools_lifting_category']);

        Post::create($validated);

        $message = $validated['is_published'] ? 'Post published successfully!' : 'Post saved as draft!';

        return back()->with('success', $message);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();

        // Get brands for categories that have brands (excluding Mechanical, Electrical, Material Handling, Tools & Lifting)
        $brandsByCategory = [];

        $fireProtection = Category::where('slug', 'fire-protection')->first();
        if ($fireProtection) {
            $fireBrands = Brand::whereIn('slug', [
                'hd-fire', 'kidde', 'buckeye', 'lehavot', 'nittan',
                'honeywell', 'protectowire', 'bristol', 'eaton',
                'pentair', 'ansul', 'amerex', 'tyco', 'rotarex'
            ])->where('is_active', true)->get();

            $brandsByCategory['fire_protection'] = $fireBrands;
        }

        // No mechanical brands needed - removed
        // No electrical brands needed - removed
        // No material handling brands needed - removed
        // No tools & lifting brands needed - removed

        $auxilliary = Category::where('slug', 'auxilliary')->first();
        if ($auxilliary) {
            $auxBrands = Brand::whereIn('slug', [
                'dahua', 'zkteco', 'hid-global', 'honeywell', 'hikvision'
            ])->where('is_active', true)->get();

            $brandsByCategory['auxilliary'] = $auxBrands;
        }

        // Extract mechanical category from tags if it exists
        $mechanicalCategory = '';
        if ($post->category && $post->category->slug === 'mechanical' && $post->tags) {
            $tags = explode(',', $post->tags);
            $mechanicalCategory = trim($tags[0]);
        }

        // Extract electrical category from tags if it exists
        $electricalCategory = '';
        if ($post->category && $post->category->slug === 'electrical' && $post->tags) {
            $tags = explode(',', $post->tags);
            $electricalCategory = trim($tags[0]);
        }

        // Extract material handling category from tags if it exists
        $materialHandlingCategory = '';
        if ($post->category && $post->category->slug === 'material-handling' && $post->tags) {
            $tags = explode(',', $post->tags);
            $materialHandlingCategory = trim($tags[0]);
        }

        // Extract tools & lifting category from tags if it exists
        $toolsLiftingCategory = '';
        if ($post->category && $post->category->slug === 'tools-and-lifting-equipment' && $post->tags) {
            $tags = explode(',', $post->tags);
            $toolsLiftingCategory = trim($tags[0]);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'brandsByCategory', 'mechanicalCategory', 'electricalCategory', 'materialHandlingCategory', 'toolsLiftingCategory'));
    }

    public function update(Request $request, Post $post)
    {
        $validationRules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'product_name' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'category' => 'required|string',
            'tags' => 'nullable|string',
        ];

        // Add conditional validation based on category
        $category = Category::where('name', $request->category)->first();

        if ($category) {
            if ($category->slug === 'mechanical') {
                // For Mechanical - require mechanical_category, brand is optional
                $validationRules['mechanical_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'electrical') {
                // For Electrical - require electrical_category, brand is optional
                $validationRules['electrical_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'material-handling') {
                // For Material Handling - require material_handling_category, brand is optional
                $validationRules['material_handling_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } elseif ($category->slug === 'tools-and-lifting-equipment') {
                // For Tools & Lifting - require tools_lifting_category, brand is optional
                $validationRules['tools_lifting_category'] = 'required|string';
                $validationRules['brand'] = 'nullable|string';
            } else {
                // For other categories - require brand
                $validationRules['brand'] = 'required|string';
            }
        }

        $validated = $request->validate($validationRules);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('posts', 'public');
        }

        // Update slug if title changed
        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);

            // Ensure unique slug
            $slugCount = Post::where('slug', $validated['slug'])
                ->where('id', '!=', $post->id)
                ->count();

            if ($slugCount > 0) {
                $validated['slug'] = $validated['slug'] . '-' . time();
            }
        }

        // Convert category name to category_id
        $category = Category::where('name', $validated['category'])->first();
        if (!$category) {
            return back()->withErrors(['category' => 'Selected category does not exist.']);
        }
        $validated['category_id'] = $category->id;

        // Handle brand - only if provided (not required for Mechanical, Electrical, Material Handling, Tools & Lifting)
        if (!empty($validated['brand'])) {
            $brand = Brand::where('name', $validated['brand'])->first();

            if (!$brand) {
                // Create the brand if it doesn't exist
                $brand = Brand::create([
                    'name' => $validated['brand'],
                    'slug' => Str::slug($validated['brand']),
                    'is_active' => true,
                ]);
            }

            $validated['brand_id'] = $brand->id;
        } else {
            $validated['brand_id'] = null;
        }

        // For Mechanical, update the mechanical_category in tags
        if ($category->slug === 'mechanical' && !empty($validated['mechanical_category'])) {
            $existingTags = '';
            if (!empty($validated['tags'])) {
                $existingTags = $validated['tags'];
            }

            $validated['tags'] = $validated['mechanical_category'];
            if (!empty($existingTags)) {
                $validated['tags'] .= ', ' . $existingTags;
            }
        }

        // For Electrical, update the electrical_category in tags
        if ($category->slug === 'electrical' && !empty($validated['electrical_category'])) {
            $existingTags = '';
            if (!empty($validated['tags'])) {
                $existingTags = $validated['tags'];
            }

            $validated['tags'] = $validated['electrical_category'];
            if (!empty($existingTags)) {
                $validated['tags'] .= ', ' . $existingTags;
            }
        }

        // For Material Handling, update the material_handling_category in tags
        if ($category->slug === 'material-handling' && !empty($validated['material_handling_category'])) {
            $existingTags = '';
            if (!empty($validated['tags'])) {
                $existingTags = $validated['tags'];
            }

            $validated['tags'] = $validated['material_handling_category'];
            if (!empty($existingTags)) {
                $validated['tags'] .= ', ' . $existingTags;
            }
        }

        // For Tools & Lifting, update the tools_lifting_category in tags
        if ($category->slug === 'tools-and-lifting-equipment' && !empty($validated['tools_lifting_category'])) {
            $existingTags = '';
            if (!empty($validated['tags'])) {
                $existingTags = $validated['tags'];
            }

            $validated['tags'] = $validated['tools_lifting_category'];
            if (!empty($existingTags)) {
                $validated['tags'] .= ', ' . $existingTags;
            }
        }

        // Remove the string fields that don't exist in database
        unset($validated['category']);
        unset($validated['brand']);
        unset($validated['mechanical_category']);
        unset($validated['electrical_category']);
        unset($validated['material_handling_category']);
        unset($validated['tools_lifting_category']);

        $post->update($validated);

        $message = $validated['is_published'] ? 'Post updated and published!' : 'Post updated!';

        return back()->with('success', $message);
    }

    public function destroy(Post $post)
    {
        // Record deletion time explicitly if needed
        $post->deleted_at = now();
        $post->save();

        // Soft delete the post instead of hard delete
        $post->delete();

     return redirect()->route('admin.posts.trash')
        ->with('success', 'Post moved to trash successfully.');
    }

    // ========== TRASH METHODS ==========

    public function trash(Request $request)
    {
        $query = Post::onlyTrashed()->with('user')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('product_name', 'like', "%{$search}%");
            });
        }

        $trashedPosts = $query->paginate(10);

        return view('admin.posts.trash', compact('trashedPosts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {
            return redirect()->route('admin.posts.trash')
                ->with('error', 'Post is not in trash.');
        }

        $post->restore();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post restored successfully.');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Post is not in trash.');
        }

        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->forceDelete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Post permanently deleted.');
    }

    public function emptyTrash()
    {
        $trashedPosts = Post::onlyTrashed()->get();

        foreach ($trashedPosts as $post) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->forceDelete();
        }

        return redirect()->route('admin.posts.trash')
            ->with('success', 'Trash emptied successfully.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:restore,delete',
            'selected_posts' => 'required|array',
            'selected_posts.*' => 'exists:posts,id'
        ]);

        $action = $request->action;
        $postIds = $request->selected_posts;

        if ($action === 'restore') {
            // Use withTrashed to find all posts
            $posts = Post::withTrashed()->whereIn('id', $postIds)->get();
            foreach ($posts as $post) {
                if ($post->trashed()) {
                    $post->restore();
                }
            }
            $message = count($postIds) . ' post(s) restored successfully.';
        } else {
            $posts = Post::withTrashed()->whereIn('id', $postIds)->get();
            foreach ($posts as $post) {
                if ($post->featured_image) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $post->forceDelete();
            }
            $message = count($postIds) . ' post(s) permanently deleted.';
        }

        return redirect()->route('admin.posts.trash')->with('success', $message);
    }
}
