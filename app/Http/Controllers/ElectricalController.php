<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class ElectricalController extends Controller
{
    public function index()
    {
        // Get the Electrical category
        $electricalCategory = Category::where('slug', 'electrical')->first();

        if (!$electricalCategory) {
            $productsByCategory = [];
            return view('posts.electrical', compact('productsByCategory'));
        }

        // Get all electrical products
        $products = Post::with('category')
            ->where('category_id', $electricalCategory->id)
            ->where('is_published', true)
            ->whereNotNull('product_name')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group products by category (extracted from tags)
        $productsByCategory = [
            'Clamp Meters' => [],
            'Digital Multimeters' => [],
            'Electrical Testers' => [],
            'Power Factor Controllers' => [],
            'Harmonic Filters' => [],
            'General Electrical' => []
        ];

        foreach ($products as $product) {
            $category = $this->extractCategoryFromProduct($product);

            if (isset($productsByCategory[$category])) {
                $productsByCategory[$category][] = $product;
            } else {
                // Default to General Electrical if no match
                $productsByCategory['General Electrical'][] = $product;
            }
        }

        // Filter out empty categories
        $productsByCategory = array_filter($productsByCategory, function($items) {
            return count($items) > 0;
        });

        return view('posts.electrical', compact('productsByCategory'));
    }

    public function product()
    {
        return view('product.electrical');
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

            if (str_contains($lowerTag, 'clamp')) return 'Clamp Meters';
            if (str_contains($lowerTag, 'multimeter')) return 'Digital Multimeters';
            if (str_contains($lowerTag, 'tester')) return 'Electrical Testers';
            if (str_contains($lowerTag, 'power factor')) return 'Power Factor Controllers';
            if (str_contains($lowerTag, 'harmonic')) return 'Harmonic Filters';

            return ucfirst($mainTag);
        }

        // Fallback: check product name
        $name = strtolower($product->product_name ?: $product->title);

        if (str_contains($name, 'clamp meter') || str_contains($name, 'clamp')) return 'Clamp Meters';
        if (str_contains($name, 'digital multimeter') || str_contains($name, 'multimeter')) return 'Digital Multimeters';
        if (str_contains($name, 'electrical tester') || str_contains($name, 'electric tester') || str_contains($name, 'tester')) return 'Electrical Testers';
        if (str_contains($name, 'power factor controller') || str_contains($name, 'power factor')) return 'Power Factor Controllers';
        if (str_contains($name, 'harmonic filter')) return 'Harmonic Filters';

        return 'General Electrical';
    }
}
