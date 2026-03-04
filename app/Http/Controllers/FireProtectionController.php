<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FireProtectionController extends Controller
{
    public function index()
    {
        // Get Fire Protection category FIRST
        $fireCategory = Category::where('slug', 'fire-protection')->first();

        if (!$fireCategory) {
            abort(404, 'Fire Protection category not found');
        }

        // Get all fire protection brands from database
        $brands = [
            'HD Fire' => 'HD-fire.png',
            'Kidde' => 'kidde.png',
            'Buckeye' => 'BUCKEYYYEE.png',
            'Lehavot' => 'lehavot.png',
            'Nittan' => 'nittan.png',
            'Honeywell' => 'Honeywell.png',
            'Protectowire' => 'protectowire.png',
            'Bristol' => 'bristol.png',
            'Eaton' => 'eaton.png',
            'Pentair' => 'pentair.png',
            'Ansul' => 'ANSUL.png',
            'Amerex' => 'AMEREX.png',
            'Tyco' => 'tyco.png',
            'Rotarex' => 'rotarex.png',
            'Viking' => 'viking.png'
        ];

        // Get database brands
        $dbBrands = Brand::whereIn('name', array_keys($brands))
            ->where('is_active', true)
            ->get()
            ->keyBy('name');

        // Get all fire protection products grouped by brand
        $productsByBrand = [];

        foreach ($dbBrands as $brandName => $brand) {
            $products = Post::with(['brand', 'category'])
                ->where('brand_id', $brand->id)
                ->where('category_id', $fireCategory->id)
                ->where('is_published', true)
                ->whereNotNull('product_name')
                ->orderBy('created_at', 'desc')
                ->get();

            // Group products by tags (for categories in modals)
            $groupedProducts = [];
            foreach ($products as $product) {
                $category = $this->extractCategoryFromProduct($product);
                if (!isset($groupedProducts[$category])) {
                    $groupedProducts[$category] = [];
                }
                $groupedProducts[$category][] = $product;
            }

            $productsByBrand[$brandName] = [
                'brand' => $brand,
                'products' => $products,
                'grouped_products' => $groupedProducts,
                'image' => $brands[$brandName] ?? 'default-brand.png'
            ];
        }

        return view('posts.fire-protection', compact('dbBrands', 'productsByBrand', 'brands'));
    }

    private function extractCategoryFromProduct($product)
    {
        // Try to extract category from tags first
        if ($product->tags) {
            $tags = explode(',', $product->tags);
            $mainTag = trim($tags[0]);

            // Define all possible category names from both create.blade.php and fire-protection.blade.php
            $validCategories = [
                // HD Fire Categories
                'Alarm Valve',
                'Flexible Sprinkler Drops',
                'Water Spray Nozzle',
                'Custom Engineered Systems',
                'Foam Equipment & Device',
                'Foam Proportioning Systems',
                'Deluge Valves & Systems',
                'Foam Concentrates',
                'Pre Action Fire Protection',
                'Sprinklers & Accessories',

                // Kidde Categories
                'Gaseous Suppression - Clean Agent',
                'Detection & Control System',
                'Room Integrity Test',
                'Water Suppression System',

                // Buckeye Categories
                'Fire Extinguishers',
                'Gas Detection Transmitter',

               // Lehavot Categories
                'Kitchen Shield',  // CHANGED: from 'Fire Extinguishers', 'Fire Suppression Equipment'

                // Nittan Categories
                'Fire Detectors',
                'Fire Alarm Systems',

                // Honeywell Categories
                'Fire Alarm Systems',
                'Gas Detection',
                'Fire Suppression',

                // Protectowire Categories
                'Linear Heat Detection',
                'Fire Alarm Systems',

                // Bristol Categories
                'Fire Alarm Equipment',

                // Eaton Categories
                'Fire Pumps',
                'Electrical Fire Protection',

                // Pentair Categories
                'End Suction Pumps',
                'In-Line Pumps',
                'Split Case Pumps',
                'Vertical Multi-Stage Pumps',
                'Vertical Turbine Pumps',
                'End Suction Fire Pumps',
                'Split Case Fire Pumps',
                'Vertical Turbine Fire Pumps',

                // Ansul Categories
                'Fire Suppression Systems',
                'Fire Extinguishers',

                // Amerex Categories
                'Fire Extinguishers',
                'Fire Suppression',

                // Tyco Categories
                'Fire Sprinklers',
                'Fire Suppression Systems',

                // Rotarex Categories
                'Gas Control Equipment',
                'Fire Suppression',

                // Viking Main Categories
                'Fire Sprinkler',
                'Valves & Systems',
                'Foam Systems',
                'Special Hazards',
                'Piping Systems',
                'Electricals',

                // Viking Subcategories - Fire Sprinkler
                'Standard Coverage - Standard Response',
                'Standard Coverage - Quick Response',
                'Extended Coverage Sprinklers',
                'Storage Sprinklers',
                'Special Sprinklers',
                'Residential Sprinklers',
                'Dry Barrel Sprinklers',
                'Sprinkler Accessories',
                'Spray Nozzles',
                'View All Sprinklers',

                // Viking Subcategories - Valves & Systems
                'EasyPac Riser Assemblies',
                'Wet Pipe Systems',
                'Dry Pipe Systems',
                'Deluge & Preaction Systems',
                'Data Center Upgradeable Systems',
                'Flow Control & Pressure Regulation',
                'Firecycle® Systems',
                'Accessories',
                'View All Valves & Systems',

                // Viking Subcategories - Foam Systems
                'High Expansion Foam Systems',
                'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
                'Shared Foam System Components',
                'View All Foam Products',

                // Viking Subcategories - Special Hazards
                'Oxeo Clean Agent Extinguishing System',
                'Ignitable Liquid Storage Protection',
                'View All Special Hazards',

                // Viking Subcategories - Piping Systems
                'BlazeMaster® CPVC Pipe & Fittings',
                'InstaSeal® Welded Outlet Systems',
                'View All Piping Systems',

                // Viking Subcategories - Electricals
                'Release Control Panels',
                'Detection and Control Solutions',
                'View All Electrical Products'
            ];

            // Check if the main tag exactly matches any valid category
            if (in_array($mainTag, $validCategories)) {
                return $mainTag;
            }

            // If not exact match, try case-insensitive matching
            foreach ($validCategories as $validCategory) {
                if (strcasecmp($mainTag, $validCategory) === 0) {
                    return $validCategory;
                }
            }

            // If still no match, return the main tag (capitalized)
            return ucwords($mainTag);
        }

        // Fallback: check product name
        $name = strtolower($product->product_name ?: $product->title);

        $nameCategoryMap = [
            // HD Fire Categories
            'alarm valve' => 'Alarm Valve',
            'flexible sprinkler' => 'Flexible Sprinkler Drops',
            'sprinkler drop' => 'Flexible Sprinkler Drops',
            'water spray nozzle' => 'Water Spray Nozzle',
            'spray nozzle' => 'Water Spray Nozzle',
            'nozzle' => 'Water Spray Nozzle',
            'custom engineered' => 'Custom Engineered Systems',
            'engineered system' => 'Custom Engineered Systems',
            'foam equipment' => 'Foam Equipment & Device',
            'foam device' => 'Foam Equipment & Device',
            'foam proportioning' => 'Foam Proportioning Systems',
            'proportioning system' => 'Foam Proportioning Systems',
            'deluge valve' => 'Deluge Valves & Systems',
            'deluge system' => 'Deluge Valves & Systems',
            'foam concentrate' => 'Foam Concentrates',
            'pre action' => 'Pre Action Fire Protection',
            'sprinkler' => 'Sprinklers & Accessories',
            'sprinkler accessory' => 'Sprinklers & Accessories',

            // Kidde Categories
            'gaseous suppression' => 'Gaseous Suppression - Clean Agent',
            'clean agent' => 'Gaseous Suppression - Clean Agent',
            'detection & control' => 'Detection & Control System',
            'detection and control' => 'Detection & Control System',
            'fire detection' => 'Detection & Control System',
            'detection system' => 'Detection & Control System',
            'control system' => 'Detection & Control System',
            'room integrity' => 'Room Integrity Test',
            'integrity test' => 'Room Integrity Test',
            'water suppression' => 'Water Suppression System',

          // Buckeye Categories
            'fire extinguisher' => 'Fire Extinguishers',
            'extinguisher' => 'Fire Extinguishers',
            'gas detection' => 'Gas Detection Transmitters',  // CHANGED: from 'fire suppression system'
            'gas transmitter' => 'Gas Detection Transmitters',
            'gas detection transmitter' => 'Gas Detection Transmitters',
            'transmitter' => 'Gas Detection Transmitters',

          // Lehavot Categories
            'kitchen shield' => 'Kitchen Shield',
            'kitchen' => 'Kitchen Shield',
            'shield' => 'Kitchen Shield',

            // Nittan Categories
            'fire detector' => 'Fire Detectors',
            'detector' => 'Fire Detectors',
            'fire alarm' => 'Fire Alarm Systems',
            'alarm system' => 'Fire Alarm Systems',

            // Honeywell Categories
            'gas-detection' => 'Gas Detection',
            'fire suppression' => 'Fire Suppression',

            // Protectowire Categories
            'linear heat' => 'Linear Heat Detection',
            'heat detection' => 'Linear Heat Detection',

            // Bristol Categories
            'fire alarm equipment' => 'Fire Alarm Equipment',
            'alarm equipment' => 'Fire Alarm Equipment',

            // Eaton Categories
            'fire pump' => 'Fire Pumps',
            'pump' => 'Fire Pumps',
            'electrical fire' => 'Electrical Fire Protection',
            'electrical protection' => 'Electrical Fire Protection',

            // Pentair Categories
            'end suction' => 'End Suction Pumps',
            'in-line pump' => 'In-Line Pumps',
            'inline pump' => 'In-Line Pumps',
            'split case' => 'Split Case Pumps',
            'vertical multi-stage' => 'Vertical Multi-Stage Pumps',
            'multi-stage pump' => 'Vertical Multi-Stage Pumps',
            'vertical turbine' => 'Vertical Turbine Pumps',
            'turbine pump' => 'Vertical Turbine Pumps',
            'end suction fire pump' => 'End Suction Fire Pumps',
            'split case fire pump' => 'Split Case Fire Pumps',
            'vertical turbine fire pump' => 'Vertical Turbine Fire Pumps',

            // Ansul Categories
            'ansul suppression' => 'Fire Suppression Systems',
            'ansul extinguisher' => 'Fire Extinguishers',

            // Amerex Categories
            'amerex extinguisher' => 'Fire Extinguishers',
            'amerex suppression' => 'Fire Suppression',

            // Tyco Categories
            'tyco sprinkler' => 'Fire Sprinklers',
            'tyco suppression' => 'Fire Suppression Systems',

            // Rotarex Categories
            'gas control' => 'Gas Control Equipment',
            'control equipment' => 'Gas Control Equipment',
            'rotarex suppression' => 'Fire Suppression',

            // Viking Main Categories
            'viking fire sprinkler' => 'Fire Sprinkler',
            'viking valves' => 'Valves & Systems',
            'viking foam' => 'Foam Systems',
            'viking special hazards' => 'Special Hazards',
            'viking piping' => 'Piping Systems',
            'viking electrical' => 'Electricals',

            // Viking Subcategories - Fire Sprinkler
            'standard coverage standard response' => 'Standard Coverage - Standard Response',
            'standard coverage quick response' => 'Standard Coverage - Quick Response',
            'extended coverage' => 'Extended Coverage Sprinklers',
            'storage sprinkler' => 'Storage Sprinklers',
            'special sprinkler' => 'Special Sprinklers',
            'residential sprinkler' => 'Residential Sprinklers',
            'dry barrel' => 'Dry Barrel Sprinklers',
            'sprinkler accessories' => 'Sprinkler Accessories',
            'spray nozzles' => 'Spray Nozzles',
            'view all sprinklers' => 'View All Sprinklers',

            // Viking Subcategories - Valves & Systems
            'easypac' => 'EasyPac Riser Assemblies',
            'riser assembly' => 'EasyPac Riser Assemblies',
            'wet pipe' => 'Wet Pipe Systems',
            'dry pipe' => 'Dry Pipe Systems',
            'deluge' => 'Deluge & Preaction Systems',
            'preaction' => 'Deluge & Preaction Systems',
            'data center' => 'Data Center Upgradeable Systems',
            'flow control' => 'Flow Control & Pressure Regulation',
            'pressure regulation' => 'Flow Control & Pressure Regulation',
            'firecycle' => 'Firecycle® Systems',
            'accessories' => 'Accessories',
            'view all valves' => 'View All Valves & Systems',

            // Viking Subcategories - Foam Systems
            'high expansion foam' => 'High Expansion Foam Systems',
            'low expansion foam' => 'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
            'sfff' => 'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
            'fluorine free foam' => 'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
            'shared foam' => 'Shared Foam System Components',
            'view all foam' => 'View All Foam Products',

            // Viking Subcategories - Special Hazards
            'oxeo' => 'Oxeo Clean Agent Extinguishing System',
            'oxeo clean agent' => 'Oxeo Clean Agent Extinguishing System',
            'ignitable liquid' => 'Ignitable Liquid Storage Protection',
            'liquid storage' => 'Ignitable Liquid Storage Protection',
            'view all special hazards' => 'View All Special Hazards',

            // Viking Subcategories - Piping Systems
            'blazemaster' => 'BlazeMaster® CPVC Pipe & Fittings',
            'cpvc' => 'BlazeMaster® CPVC Pipe & Fittings',
            'instaseal' => 'InstaSeal® Welded Outlet Systems',
            'welded outlet' => 'InstaSeal® Welded Outlet Systems',
            'view all piping' => 'View All Piping Systems',

            // Viking Subcategories - Electricals
            'release control' => 'Release Control Panels',
            'control panel' => 'Release Control Panels',
            'detection & control solutions' => 'Detection and Control Solutions',
            'detection solution' => 'Detection and Control Solutions',
            'control solution' => 'Detection and Control Solutions',
            'view all electrical' => 'View All Electrical Products'
        ];

        foreach ($nameCategoryMap as $keyword => $category) {
            if (str_contains($name, $keyword)) {
                return $category;
            }
        }

        return 'General';
    }
}
