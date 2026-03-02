<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MechanicalController extends Controller
{
    public function index()
    {
        // Get the Mechanical category
        $mechanicalCategory = Category::where('slug', 'mechanical')->first();

        if (!$mechanicalCategory) {
            $productsByCategory = [];
            return view('posts.mechanical', compact('productsByCategory'));
        }

        // Get all mechanical products grouped by their category (from tags)
        $products = Post::with('category')
            ->where('category_id', $mechanicalCategory->id)
            ->where('is_published', true)
            ->whereNotNull('product_name')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group products by category (extracted from tags)
        $productsByCategory = [
            'Fuel tanks' => [],
            'Fire pumps' => [],
            'Pumps group' => [],
            'Diesel engines' => [],
            'Accessories' => []
        ];

        foreach ($products as $product) {
            $category = $this->extractCategoryFromProduct($product);

            // Map to the display categories
            $displayCategory = $this->mapToDisplayCategory($category);

            if ($displayCategory && isset($productsByCategory[$displayCategory])) {
                $productsByCategory[$displayCategory][] = $product;
            } else {
                // Default to 'Fire pumps' if no match
                $productsByCategory['Fire pumps'][] = $product;
            }
        }

        // Filter out empty categories
        $productsByCategory = array_filter($productsByCategory, function($items) {
            return count($items) > 0;
        });

        return view('posts.mechanical', compact('productsByCategory'));
    }

    public function product()
    {
        return view('product.mechanical');
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

            return $mainTag;
        }

        // Fallback: check product name
        $name = strtolower($product->product_name ?: $product->title);

        if (str_contains($name, 'fuel tank') || str_contains($name, 'fuel')) {
            return 'Fuel tanks';
        }
        if (str_contains($name, 'fire pump') || str_contains($name, 'pump')) {
            return 'Fire pumps';
        }
        if (str_contains($name, 'pump group') || str_contains($name, 'group')) {
            return 'Pumps group';
        }
        if (str_contains($name, 'diesel') || str_contains($name, 'engine')) {
            return 'Diesel engines';
        }
        if (str_contains($name, 'accessory') || str_contains($name, 'accessories')) {
            return 'Accessories';
        }

        return 'Fire pumps';
    }

    private function mapToDisplayCategory($category)
    {
        $category = strtolower(trim($category));

        $mapping = [
            'fuel tank' => 'Fuel tanks',
            'fuel tanks' => 'Fuel tanks',
            'fuel' => 'Fuel tanks',
            'tank' => 'Fuel tanks',
            'fire pump' => 'Fire pumps',
            'fire pumps' => 'Fire pumps',
            'pump' => 'Fire pumps',
            'pumps' => 'Fire pumps',
            'pump group' => 'Pumps group',
            'pumps group' => 'Pumps group',
            'group' => 'Pumps group',
            'fire pump group' => 'Pumps group',
            'diesel' => 'Diesel engines',
            'engine' => 'Diesel engines',
            'diesel engine' => 'Diesel engines',
            'diesel engines' => 'Diesel engines',
            'accessory' => 'Accessories',
            'accessories' => 'Accessories'
        ];

        foreach ($mapping as $key => $display) {
            if (str_contains($category, $key)) {
                return $display;
            }
        }

        return null;
    }
}
