<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesAndBrandsSeeder extends Seeder
{
    public function run(): void
    {
        // Insert categories
        $categories = [
            ['name' => 'Fire Protection', 'slug' => 'fire-protection', 'has_brands' => true, 'order' => 1],
            ['name' => 'Mechanical', 'slug' => 'mechanical', 'has_brands' => true, 'order' => 2],
            ['name' => 'Electrical', 'slug' => 'electrical', 'has_brands' => true, 'order' => 3],
            ['name' => 'Auxilliary', 'slug' => 'auxilliary', 'has_brands' => true, 'order' => 4],
            ['name' => 'Material Handling', 'slug' => 'material-handling', 'has_brands' => true, 'order' => 5],
            ['name' => 'Tools and Lifting Equipment', 'slug' => 'tools-and-lifting-equipment', 'has_brands' => true, 'order' => 6],
        ];

        foreach ($categories as $category) {
            // Check if category already exists
            $exists = DB::table('categories')->where('slug', $category['slug'])->exists();
            if (!$exists) {
                DB::table('categories')->insert([
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'has_brands' => $category['has_brands'],
                    'order' => $category['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Get category IDs
        $fireProtection = DB::table('categories')->where('slug', 'fire-protection')->first();
        $mechanical = DB::table('categories')->where('slug', 'mechanical')->first();
        $electrical = DB::table('categories')->where('slug', 'electrical')->first();
        $auxilliary = DB::table('categories')->where('slug', 'auxilliary')->first();
        $materialHandling = DB::table('categories')->where('slug', 'material-handling')->first();
        $toolsAndLifting = DB::table('categories')->where('slug', 'tools-and-lifting-equipment')->first();

        if (!$fireProtection || !$mechanical || !$electrical || !$auxilliary || !$materialHandling || !$toolsAndLifting) {
            return;
        }

        // Insert Fire Protection Brands
        $fireBrands = ['HD Fire', 'Kidde', 'Buckeye', 'Lehavot', 'Nittan', 'Honeywell', 'Protectowire', 'Bristol', 'Eaton', 'Pentair', 'Ansul', 'Amerex', 'Tyco', 'Rotarex', 'Viking'];
        foreach ($fireBrands as $brandName) {
            $slug = Str::slug($brandName);

            // Check if brand exists
            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Insert Mechanical Brands
        $mechBrands = ['Carrier', 'Trane', 'Daikin', 'Mitsubishi', 'Johnson Controls', 'Waterfall', 'NMFIRE'];
        foreach ($mechBrands as $brandName) {
            $slug = Str::slug($brandName);

            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Insert Electrical Brands
        $elecBrands = ['Fluke', 'Circutor'];
        foreach ($elecBrands as $brandName) {
            $slug = Str::slug($brandName);

            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Insert Auxilliary Brands
        $auxBrands = ['Dahua', 'HIKVision', 'Zkteco', 'HID Global', 'Honeywell'];
        foreach ($auxBrands as $brandName) {
            $slug = Str::slug($brandName);

            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Insert Material Handling Brands
        $materialHandlingBrands = ['Techpro', 'LES'];
        foreach ($materialHandlingBrands as $brandName) {
            $slug = Str::slug($brandName);

            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Insert Tools & Lifting Equipment Brands
        $toolsBrands = ['Bosch', 'Makita', 'LES', 'Kentool'];
        foreach ($toolsBrands as $brandName) {
            $slug = Str::slug($brandName);

            $brand = DB::table('brands')->where('slug', $slug)->first();
            if (!$brand) {
                DB::table('brands')->insert([
                    'name' => $brandName,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
