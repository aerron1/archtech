<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MaterialHandlingController extends Controller
{
    public function index()
    {
        // Get the Material Handling category
        $materialHandlingCategory = Category::where('slug', 'material-handling')->first();

        if (!$materialHandlingCategory) {
            $productsByCategory = [];
            return view('posts.material-handling', compact('productsByCategory'));
        }

        // Get all material handling products
        $products = Post::with('category')
            ->where('category_id', $materialHandlingCategory->id)
            ->where('is_published', true)
            ->whereNotNull('product_name')
            ->orderBy('created_at', 'desc')
            ->get();

        // Define all possible material handling categories
        $productsByCategory = [
            'Forklifts' => [],
            'Pallet Trucks' => [],
            'Pallet Jacks' => [],
            'Reach Trucks' => [],
            'Order Pickers' => [],
            'Lifting Jacks' => [],
            'Offshore & Marine' => [],
            'PPE' => [],
            'Shelving Systems' => [],
            'Racking Systems' => [],
            'Material Handling Equipment' => []
        ];

        foreach ($products as $product) {
            $category = $this->extractCategoryFromProduct($product);

            if (isset($productsByCategory[$category])) {
                $productsByCategory[$category][] = $product;
            } else {
                // Default to Material Handling Equipment if no match
                $productsByCategory['Material Handling Equipment'][] = $product;
            }
        }

        // Filter out empty categories
        $productsByCategory = array_filter($productsByCategory, function($items) {
            return count($items) > 0;
        });

        return view('posts.material-handling', compact('productsByCategory'));
    }

    public function product()
    {
        return view('product.material-handling');
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

            if (str_contains($lowerTag, 'forklift')) return 'Forklifts';
            if (str_contains($lowerTag, 'pallet truck')) return 'Pallet Trucks';
            if (str_contains($lowerTag, 'pallet jack')) return 'Pallet Jacks';
            if (str_contains($lowerTag, 'reach truck')) return 'Reach Trucks';
            if (str_contains($lowerTag, 'order picker')) return 'Order Pickers';
            if (str_contains($lowerTag, 'lifting jack')) return 'Lifting Jacks';
            if (str_contains($lowerTag, 'offshore') || str_contains($lowerTag, 'marine')) return 'Offshore & Marine';
            if (str_contains($lowerTag, 'ppe') || str_contains($lowerTag, 'safety') || str_contains($lowerTag, 'protective')) return 'PPE';
            if (str_contains($lowerTag, 'shelving')) return 'Shelving Systems';
            if (str_contains($lowerTag, 'racking')) return 'Racking Systems';

            return ucfirst($mainTag);
        }

        // Fallback: check product name
        $name = strtolower($product->product_name ?: $product->title);

        if (str_contains($name, 'forklift')) return 'Forklifts';
        if (str_contains($name, 'pallet truck')) return 'Pallet Trucks';
        if (str_contains($name, 'pallet jack')) return 'Pallet Jacks';
        if (str_contains($name, 'reach truck')) return 'Reach Trucks';
        if (str_contains($name, 'order picker')) return 'Order Pickers';
        if (str_contains($name, 'lifting jack')) return 'Lifting Jacks';
        if (str_contains($name, 'offshore') || str_contains($name, 'marine')) return 'Offshore & Marine';
        if (str_contains($name, 'ppe') || str_contains($name, 'safety') || str_contains($name, 'protective')) return 'PPE';
        if (str_contains($name, 'shelving')) return 'Shelving Systems';
        if (str_contains($name, 'racking')) return 'Racking Systems';

        return 'Material Handling Equipment';
    }
}
