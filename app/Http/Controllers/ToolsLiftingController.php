<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class ToolsLiftingController extends Controller
{
    public function index()
    {
        // Get the Tools & Lifting Equipment category
        $toolsCategory = Category::where('slug', 'tools-and-lifting-equipment')->first();

        if (!$toolsCategory) {
            $productsByCategory = [];
            return view('posts.tools-lifting', compact('productsByCategory'));
        }

        // Get all tools & lifting products
        $products = Post::with('category')
            ->where('category_id', $toolsCategory->id)
            ->where('is_published', true)
            ->whereNotNull('product_name')
            ->orderBy('created_at', 'desc')
            ->get();

        // Define all possible tools & lifting categories
        $productsByCategory = [
            'Power Tools' => [],
            'Hand Tools' => [],
            'Lifting Equipment' => [],
            'Lifting Shackles' => [],
            'Webbing Sling' => [],
            'WEBBING SLING' => [], // Keep both variants for backward compatibility
            'Concrete & Masonry' => [],
            'Grinders' => [],
            'Drills' => [],
            'Saws' => [],
            'Sanders' => [],
            'Socket & Sets' => [],
            'Cutting Tools' => [],
            'PPE' => [],
            'Tools & Equipment' => []
        ];

        foreach ($products as $product) {
            $category = $this->extractCategoryFromProduct($product);

            // Normalize WEBBING SLING to Webbing Sling
            if ($category === 'WEBBING SLING') {
                $category = 'Webbing Sling';
            }

            if (isset($productsByCategory[$category])) {
                $productsByCategory[$category][] = $product;
            } else {
                // Default to Tools & Equipment if no match
                $productsByCategory['Tools & Equipment'][] = $product;
            }
        }

        // Filter out empty categories
        $productsByCategory = array_filter($productsByCategory, function($items) {
            return count($items) > 0;
        });

        return view('posts.tools-lifting', compact('productsByCategory'));
    }

    public function product()
    {
        return view('product.tools-lifting');
    }

    private function extractCategoryFromProduct($product)
    {
        // Try to extract category from tags first
        if ($product->tags) {
            $tags = explode(',', $product->tags);
            $mainTag = trim($tags[0]);

            // Clean up the tag
            $mainTag = str_replace('-', ' ', $mainTag);
            $mainTag = str_replace('_', ' ', $mainTag);

            // Map to display categories
            $lowerTag = strtolower($mainTag);

            // Power Tools & Accessories
            if (str_contains($lowerTag, 'power tool')) return 'Power Tools';
            if (str_contains($lowerTag, 'drill')) return 'Drills';
            if (str_contains($lowerTag, 'saw')) return 'Saws';
            if (str_contains($lowerTag, 'grinder')) return 'Grinders';
            if (str_contains($lowerTag, 'sander')) return 'Sanders';
            if (str_contains($lowerTag, 'concrete') || str_contains($lowerTag, 'masonry')) return 'Concrete & Masonry';

            // Hand Tools
            if (str_contains($lowerTag, 'hand tool')) return 'Hand Tools';
            if (str_contains($lowerTag, 'socket')) return 'Socket & Sets';
            if (str_contains($lowerTag, 'cutting')) return 'Cutting Tools';

            // Lifting Equipment
            if (str_contains($lowerTag, 'webbing sling')) return 'Webbing Sling';
            if (str_contains($lowerTag, 'lifting shackle')) return 'Lifting Shackles';
            if (str_contains($lowerTag, 'lifting equipment')) return 'Lifting Equipment';
            if (str_contains($lowerTag, 'hoist')) return 'Lifting Equipment';
            if (str_contains($lowerTag, 'jack')) return 'Lifting Equipment';

            // Safety
            if (str_contains($lowerTag, 'ppe') || str_contains($lowerTag, 'safety') || str_contains($lowerTag, 'protective')) return 'PPE';

            return ucfirst($mainTag);
        }

        // Fallback: check product name
        $name = strtolower($product->product_name ?: $product->title);

        // Power Tools & Accessories
        if (str_contains($name, 'power tool')) return 'Power Tools';
        if (str_contains($name, 'drill')) return 'Drills';
        if (str_contains($name, 'saw')) return 'Saws';
        if (str_contains($name, 'grinder')) return 'Grinders';
        if (str_contains($name, 'sander')) return 'Sanders';
        if (str_contains($name, 'concrete') || str_contains($name, 'masonry')) return 'Concrete & Masonry';

        // Hand Tools
        if (str_contains($name, 'hand tool')) return 'Hand Tools';
        if (str_contains($name, 'socket')) return 'Socket & Sets';
        if (str_contains($name, 'cutting')) return 'Cutting Tools';

        // Lifting Equipment
        if (str_contains($name, 'webbing sling')) return 'Webbing Sling';
        if (str_contains($name, 'lifting shackle') || str_contains($name, 'shackle')) return 'Lifting Shackles';
        if (str_contains($name, 'lifting equipment')) return 'Lifting Equipment';
        if (str_contains($name, 'hoist')) return 'Lifting Equipment';
        if (str_contains($name, 'jack')) return 'Lifting Equipment';

        // Safety
        if (str_contains($name, 'ppe') || str_contains($name, 'safety') || str_contains($name, 'protective')) return 'PPE';

        return 'Tools & Equipment';
    }
}
