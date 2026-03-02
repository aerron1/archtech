<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('user')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('client', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('featured')) {
            $query->where('is_featured', $request->featured === 'yes');
        }

        $projects = $query->paginate(10);
        $trashedCount = Project::onlyTrashed()->count();

        return view('admin.projects.index', compact('projects', 'trashedCount'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'status' => 'required|in:completed,ongoing,planned',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'featured_image' => 'nullable|image|max:5120', // 5MB max
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        // Set default values for checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('projects/featured', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('projects/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);
        $slugCount = Project::where('slug', $validated['slug'])->count();
        if ($slugCount > 0) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        $validated['user_id'] = auth()->id();

        Project::create($validated);

        // Redirect back to create page to show success message then redirect to index
        return redirect()->route('admin.projects.create')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'status' => 'required|in:completed,ongoing,planned',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'featured_image' => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        // Set default values for checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('projects/featured', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = $project->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('projects/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        $project->update($validated);

        // Redirect back to edit page to show success message then redirect to index
        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

         return redirect()->route('admin.projects.trash')
        ->with('success', 'Project moved to trash successfully.');
    }

    // Trash methods
    public function trash()
    {
        $projects = Project::onlyTrashed()->with('user')->latest()->paginate(10);
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.trash')
            ->with('success', 'Project restored successfully.');
    }

    public function forceDelete($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        // Delete images
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }

        if ($project->gallery_images) {
            foreach ($project->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $project->forceDelete();

        return redirect()->route('admin.projects.trash')
            ->with('success', 'Project permanently deleted.');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:restore,delete',
            'selected_projects' => 'required|array',
            'selected_projects.*' => 'exists:projects,id'
        ]);

        $action = $request->action;
        $projectIds = $request->selected_projects;

        if ($action === 'restore') {
            Project::withTrashed()->whereIn('id', $projectIds)->restore();
            $message = count($projectIds) . ' project(s) restored successfully.';
        } else {
            $projects = Project::withTrashed()->whereIn('id', $projectIds)->get();
            foreach ($projects as $project) {
                if ($project->featured_image) {
                    Storage::disk('public')->delete($project->featured_image);
                }
                if ($project->gallery_images) {
                    foreach ($project->gallery_images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
                $project->forceDelete();
            }
            $message = count($projectIds) . ' project(s) permanently deleted.';
        }

        return redirect()->route('admin.projects.trash')->with('success', $message);
    }

    // Remove gallery image
    public function removeGalleryImage(Request $request, Project $project)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        $galleryImages = $project->gallery_images ?? [];
        $imagePath = $request->image;

        if (($key = array_search($imagePath, $galleryImages)) !== false) {
            unset($galleryImages[$key]);
            Storage::disk('public')->delete($imagePath);
            $project->update(['gallery_images' => array_values($galleryImages)]);
        }

        return redirect()->route('admin.projects.edit', $project)
            ->with('success', 'Gallery image removed successfully.');
    }
}
