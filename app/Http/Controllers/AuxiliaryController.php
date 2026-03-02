<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class AuxiliaryController extends Controller
{
    public function index()
    {
        // Get Auxiliary category
        $auxCategory = Category::where('slug', 'auxilliary')->first();

        if (!$auxCategory) {
            // Debug: Check if category exists
            dd('Auxiliary category not found. Available categories:',
                Category::pluck('name', 'slug')->toArray());
        }

        // Define brand types for filtering
        $cctvBrands = ['Dahua'];
        $accessControlBrands = ['HIKVision', 'Zkteco', 'HID Global', 'Honeywell'];

        // Get all auxiliary brands
        $allAuxBrands = array_merge($cctvBrands, $accessControlBrands);

        // Brand logos mapping
        $brandLogos = [
            'Dahua' => 'dahua.png',
            'HIKVision' => 'hikvision.png',
            'Zkteco' => 'zkteco.png',
            'HID Global' => 'hidglobal.png',
            'Honeywell' => 'honeywell.png'
        ];

        // Get database brands
        $dbBrands = Brand::whereIn('name', $allAuxBrands)
            ->where('is_active', true)
            ->get()
            ->keyBy('name');

        // Debug: Check if brands exist
        if ($dbBrands->isEmpty()) {
            dd('No auxiliary brands found in database. Available brands:',
                Brand::pluck('name')->toArray());
        }

        // Get all auxiliary products grouped by brand
        $productsByBrand = [];
        $debugInfo = [];

        foreach ($allAuxBrands as $brandName) {
            $brand = $dbBrands->get($brandName);

            if (!$brand) {
                $debugInfo[$brandName] = 'Brand not found in database';
                continue;
            }

            // Get products for this brand and auxiliary category
            $products = Post::with(['brand', 'category'])
                ->where('brand_id', $brand->id)
                ->where('category_id', $auxCategory->id)
                ->where('is_published', true)
                ->whereNotNull('product_name')
                ->orderBy('created_at', 'desc')
                ->get();

            // Debug: Check products
            $debugInfo[$brandName] = [
                'brand_id' => $brand->id,
                'products_found' => $products->count(),
                'products' => $products->map(function($p) {
                    return [
                        'id' => $p->id,
                        'title' => $p->title,
                        'product_name' => $p->product_name,
                        'tags' => $p->tags,
                        'category_id' => $p->category_id,
                        'brand_id' => $p->brand_id,
                        'is_published' => $p->is_published
                    ];
                })->toArray()
            ];

            // Group products by tags (cctv or access-control)
            $groupedProducts = [
                'cctv' => [],
                'access-control' => []
            ];

            foreach ($products as $product) {
                $category = $this->extractCategoryFromTags($product);
                if ($category && isset($groupedProducts[$category])) {
                    $groupedProducts[$category][] = $product;
                } else {
                    // If no category detected, put in both or default based on brand
                    if (in_array($brandName, $cctvBrands)) {
                        $groupedProducts['cctv'][] = $product;
                    } else {
                        $groupedProducts['access-control'][] = $product;
                    }
                }
            }

            $productsByBrand[$brandName] = [
                'brand' => $brand,
                'products' => $products,
                'grouped_products' => $groupedProducts,
                'image' => $brandLogos[$brandName] ?? 'default-brand.png',
                'type' => in_array($brandName, $cctvBrands) ? 'cctv' : 'access-control'
            ];
        }

        // Debug: Show what we found
        // Uncomment the line below to see debug info
        // dd($debugInfo, $productsByBrand);

        return view('posts.auxiliary', compact('dbBrands', 'productsByBrand', 'brandLogos', 'cctvBrands', 'accessControlBrands'));
    }

    public function product()
    {
        return view('product.auxiliary');
    }

    private function extractCategoryFromTags($product)
    {
        // First check tags
        if ($product->tags) {
            $tags = explode(',', $product->tags);
            $tags = array_map('trim', $tags);
            $tags = array_map('strtolower', $tags);

            foreach ($tags as $tag) {
                // Check for cctv tags
                if (str_contains($tag, 'cctv') || str_contains($tag, 'camera') || str_contains($tag, 'surveillance')) {
                    return 'cctv';
                }

                // Check for access control tags
                if (str_contains($tag, 'access-control') || str_contains($tag, 'biometric') ||
                    str_contains($tag, 'fingerprint') || str_contains($tag, 'card-reader') ||
                    str_contains($tag, 'rfid') || str_contains($tag, 'door-controller') ||
                    str_contains($tag, 'access control')) {
                    return 'access-control';
                }
            }
        }

        // Check product name as fallback
        $name = strtolower($product->product_name ?: $product->title);

        if (str_contains($name, 'cctv') || str_contains($name, 'camera') || str_contains($name, 'surveillance')) {
            return 'cctv';
        }

        if (str_contains($name, 'access control') || str_contains($name, 'biometric') ||
            str_contains($name, 'fingerprint') || str_contains($name, 'card reader') ||
            str_contains($name, 'rfid') || str_contains($name, 'door control')) {
            return 'access-control';
        }

        return null;
    }
}
