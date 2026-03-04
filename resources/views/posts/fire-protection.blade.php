@extends('posts.product')

@section('content')

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <!-- Category Buttons -->
        <div class="mb-5 d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
            <button class="btn btn-outline-primary btn-sm active" data-category="all">All Brands</button>

            <!-- Right: Search Bar -->
            <div class="search-bar ms-auto">
                <input type="text" class="form-control form-control-sm" id="mainSearch" placeholder="Search brands..." style="max-width: 220px;">
            </div>
        </div>

        <div class="features-grid">
            <!-- Brand Cards -->
            @php
                $brandIndex = 1;
            @endphp

            @foreach($productsByBrand as $brandName => $brandData)
                @if($brandIndex <= 15) {{-- Increased to 15 to include Viking --}}
                    <a href="#portfolioModal{{ $brandIndex }}" class="text-decoration-none brand-card" data-bs-toggle="modal">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <img src="{{ asset('homepage/file/assets/img/brands/' . $brandData['image']) }}" alt="{{ $brandName }}">
                            </div>
                        </div>
                    </a>
                    @php $brandIndex++; @endphp
                @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Brand Modals -->
@php
    $brandIndex = 1;

    // Define category structure for each brand (matching create.blade.php)
    $brandCategories = [
        'HD Fire' => [
            'main_categories' => [
                'All Products' => 'all',
                'Alarm Valve' => 'Alarm Valve',
                'Flexible Sprinkler Drops' => 'Flexible Sprinkler Drops',
                'Water Spray Nozzle' => 'Water Spray Nozzle',
                'Custom Engineered Systems' => 'Custom Engineered Systems',
                'Foam Equipment & Device' => 'Foam Equipment & Device',
                'Foam Proportioning Systems' => 'Foam Proportioning Systems',
                'Deluge Valves & Systems' => 'Deluge Valves & Systems',
                'Foam Concentrates' => 'Foam Concentrates',
                'Pre Action Fire Protection' => 'Pre Action Fire Protection',
                'Sprinklers & Accessories' => 'Sprinklers & Accessories'
            ]
        ],
        'Kidde' => [
            'main_categories' => [
                'All Products' => 'all',
                'Gaseous Suppression - Clean Agent' => 'Gaseous Suppression - Clean Agent',
                'Detection & Control System' => 'Detection & Control System',
                'Water Suppression System' => 'Water Suppression System'
            ]
        ],
        'Buckeye' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Extinguishers' => 'Fire Extinguishers',
                'Gas Detection Transmitters' => 'Gas Detection Transmitters'
            ]
        ],
        'Lehavot' => [
            'main_categories' => [
                'All Products' => 'all',
                'Kitchen Shield' => 'Kitchen Shield',
            ]
        ],
        'Nittan' => [
            'main_categories' => [
                'All Products' => 'all',
                'UL Addressable' => 'UL Addressable',
                'UL Conventional' => 'UL Conventional',
                'JP Conventional' => 'JP Conventional',
                'EN Addressable' => 'EN Addressable',
                'EN Conventional' => 'EN Conventional'
            ]
        ],
        'Honeywell' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Alarm Systems' => 'Fire Alarm Systems',
                'Gas Detection' => 'Gas Detection',
                'Fire Suppression' => 'Fire Suppression'
            ]
        ],
        'Protectowire' => [
            'main_categories' => [
                'All Products' => 'all',
                'Linear Heat Detection' => 'Linear Heat Detection',
                'Fire Alarm Systems' => 'Fire Alarm Systems'
            ]
        ],
        'Bristol' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Alarm Equipment' => 'Fire Alarm Equipment'
            ]
        ],
        'Eaton' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Pumps' => 'Fire Pumps',
                'Electrical Fire Protection' => 'Electrical Fire Protection'
            ]
        ],
        'Pentair' => [
            'main_categories' => [
                'All Products' => 'all',
                'End Suction Pumps' => 'End Suction Pumps',
                'In-Line Pumps' => 'In-Line Pumps',
                'Split Case Pumps' => 'Split Case Pumps',
                'Vertical Multi-Stage Pumps' => 'Vertical Multi-Stage Pumps',
                'Vertical Turbine Pumps' => 'Vertical Turbine Pumps',
                'End Suction Fire Pumps' => 'End Suction Fire Pumps',
                'Split Case Fire Pumps' => 'Split Case Fire Pumps',
                'Vertical Turbine Fire Pumps' => 'Vertical Turbine Fire Pumps'
            ]
        ],
        'Ansul' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Suppression Systems' => 'Fire Suppression Systems',
                'Fire Extinguishers' => 'Fire Extinguishers'
            ]
        ],
        'Amerex' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Extinguishers' => 'Fire Extinguishers',
                'Fire Suppression' => 'Fire Suppression'
            ]
        ],
        'Tyco' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Sprinklers' => 'Fire Sprinklers',
                'Fire Suppression Systems' => 'Fire Suppression Systems'
            ]
        ],
        'Rotarex' => [
            'main_categories' => [
                'All Products' => 'all',
                'Gas Control Equipment' => 'Gas Control Equipment',
                'Fire Suppression' => 'Fire Suppression'
            ]
        ],
        'Viking' => [
            'main_categories' => [
                'All Products' => 'all',
                'Fire Sprinkler' => 'Fire Sprinkler',
                'Valves & Systems' => 'Valves & Systems',
                'Foam Systems' => 'Foam Systems',
                'Special Hazards' => 'Special Hazards',
                'Piping Systems' => 'Piping Systems',
                'Electricals' => 'Electricals'
            ]
        ]
    ];
@endphp

@foreach($productsByBrand as $brandName => $brandData)
    @if($brandIndex <= 15)
        @php
            $modalId = 'portfolioModal' . $brandIndex;
            $brand = $brandData['brand'];
            $groupedProducts = $brandData['grouped_products'];

            // Get categories for this brand, or use empty array if not found
            $brandCat = $brandCategories[$brandName] ?? ['main_categories' => ['All Products' => 'all']];
            $mainCategories = $brandCat['main_categories'] ?? ['All Products' => 'all'];
        @endphp

        <!-- {{ $brandName }} Modal -->
        <div class="modal fade portfolio-modal" id="{{ $modalId }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header mb-2">
                        <div class="d-flex align-items-center w-100">
                            <div class="flex-grow-1">
                                <h5 class="modal-title">{{ $brandName }}</h5>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Category Navigation -->
                        <div class="p-3 mb-2">
                            <!-- Search Bar -->
                            <div class="search-bar d-flex justify-content-start mb-3">
                                <div class="input-group" style="max-width: 350px;">
                                    <button class="btn btn-primary btn-sm search-btn" type="button" data-modal="{{ $modalId }}">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <input type="text" class="form-control form-control-sm modal-search" data-modal="{{ $modalId }}" placeholder="Search {{ $brandName }} products...">
                                </div>
                            </div>

                            <!-- Navigation buttons -->
                            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start" id="mainNavigation{{ $brandIndex }}">
                                @foreach($mainCategories as $categoryName => $categoryType)
                                    <button class="btn btn-outline-primary {{ $categoryType == 'all' ? 'bg-light text-dark active' : '' }} btn-sm main-nav-btn"
                                            data-category="{{ $categoryType }}">{{ $categoryName }}</button>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Nav-->

                        <!-- Products Grid -->
                        <div class="products-container" id="productsContainer{{ $brandIndex }}">
                            @if(count($brandData['products']) > 0)
                                <!-- Display all products initially -->
                                <div class="all-products-section">
                                    @foreach($groupedProducts as $category => $categoryProducts)
                                        @if(count($categoryProducts) > 0)
                                            <div class="category-section" data-category="{{ $category }}">
                                                <div class="divider">
                                                    <h4 class="mb-2">{{ $category }}</h4>
                                                    <hr class="mb-3">
                                                </div>

                                                <div class="row g-3 product-grid">
                                                    @foreach($categoryProducts as $product)
                                                        <div class="col-6 col-md-4 col-lg-3 product-item"
                                                             data-category="{{ $category }}"
                                                             data-name="{{ strtolower($product->product_name ?? $product->title) }}"
                                                             data-description="{{ strtolower(strip_tags($product->content)) }}"
                                                             data-tags="{{ strtolower($product->tags ?? '') }}">
                                                            <div class="product-modal-card">
                                                                <div class="product-image-container">
                                                                    @if($product->featured_image)
                                                                        <img src="{{ Storage::url($product->featured_image) }}"
                                                                             alt="{{ $product->product_name ?? $product->title }}"
                                                                             class="img-fluid">
                                                                    @else
                                                                        <img src="{{ asset('homepage/file/assets/img/brands/' . $brandData['image']) }}"
                                                                             alt="{{ $product->product_name ?? $product->title }}"
                                                                             class="img-fluid">
                                                                    @endif
                                                                </div>
                                                                <div class="product-info">
                                                                    <small class="text-primary-custom fw-bold d-block mb-1">
                                                                        {{ $product->product_type ?? 'PRODUCT' }}
                                                                    </small>
                                                                    <h6 class="product-title mb-2">
                                                                        {{ $product->product_name ?? $product->title }}
                                                                    </h6>
                                                                    <p class="product-description small text-muted mb-3">
                                                                        {{ Str::limit(strip_tags($product->content), 80) }}
                                                                    </p>
                                                                    <button class="btn btn-primary btn-sm w-100 view-details">View Details</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5>No products found for {{ $brandName }}</h5>
                                    <p class="text-muted">Products will appear here once added by admin.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php $brandIndex++; @endphp
    @endif
@endforeach

<!-- Product Details Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="productModalBody">
                <!-- Product details loaded via JavaScript -->
            </div>
        </div>
    </div>
</div>

<style>
    /* Blur backdrop effect */
    .modal-blur-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1040;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .modal-blur-backdrop.show {
        opacity: 1;
        pointer-events: none;
    }

    /* Ensure modals appear above the blur backdrop */
    .modal {
        background-color: transparent;
        z-index: 1050;
    }

    .modal.show {
        background-color: transparent;
    }

    /* Hide the default backdrop */
    .modal-backdrop {
        display: none !important;
    }

    /* Ensure modal is visible */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    /* When modal is shown, ensure blur backdrop is visible */
    .modal.show ~ .modal-blur-backdrop {
        opacity: 1;
    }

    /* Minimal CSS additions - only what's needed */
    .product-item {
        display: block;
    }

    .product-item.hidden {
        display: none;
    }

    .category-section.hidden {
        display: none;
    }

    .btn-outline-primary.active {
        background-color: #ffffff !important;
        color: rgb(0, 0, 0) !important;
    }

    .btn-outline-secondary.active {
        background-color: #6c757d !important;
        color: white !important;
    }

    .product-modal-card {
        transition: transform 0.2s;
        height: 100%;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-modal-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .feature-card {
        transition: transform 0.2s;
    }

    .feature-card:hover {
        transform: scale(1.05);
    }

    .product-image-container {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        overflow: hidden;
    }

    .product-image-container img {
        max-height: 120px;
        width: auto;
        object-fit: contain;
        padding: 10px;
    }

    .product-info {
        padding: 15px;
    }

    .divider h4 {
        color: #084433;
        font-weight: 600;
    }

    .divider hr {
        border-top: 2px solid #084433;
        opacity: 0.2;
    }

    /* Product Details Modal Styles */
    #productDetailsModal .modal-body {
        padding: 1.5rem;
    }

    #productDetailsModal .product-detail-image {
        max-height: 400px;
        width: 100%;
        object-fit: contain;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
    }

    #productDetailsModal .product-detail-content {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
    }

    #productDetailsModal .product-detail-content p {
        white-space: pre-wrap;
        word-wrap: break-word;
        line-height: 1.6;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create blur backdrop element
    const blurBackdrop = document.createElement('div');
    blurBackdrop.className = 'modal-blur-backdrop';
    document.body.appendChild(blurBackdrop);

    // Track currently open modals
    let openModalsCount = 0;

    // Function to show/hide blur backdrop based on open modals
    function updateBlurBackdrop() {
        if (openModalsCount > 0) {
            blurBackdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        } else {
            blurBackdrop.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    // Handle brand modals
    document.querySelectorAll('.portfolio-modal').forEach(modal => {
        // When modal is shown
        modal.addEventListener('show.bs.modal', function() {
            openModalsCount++;
            updateBlurBackdrop();
        });

        // When modal is hidden
        modal.addEventListener('hidden.bs.modal', function() {
            openModalsCount = Math.max(0, openModalsCount - 1);
            updateBlurBackdrop();
        });
    });

    // Handle product details modal
    const productDetailsModal = document.getElementById('productDetailsModal');
    if (productDetailsModal) {
        productDetailsModal.addEventListener('show.bs.modal', function() {
            openModalsCount++;
            updateBlurBackdrop();
        });

        productDetailsModal.addEventListener('hidden.bs.modal', function() {
            openModalsCount = Math.max(0, openModalsCount - 1);
            updateBlurBackdrop();
        });
    }

    // 1. Main Page Filtering
    const mainCategoryButtons = document.querySelectorAll('.features .btn-outline-primary[data-category]');
    const brandCards = document.querySelectorAll('.brand-card');
    const mainSearch = document.getElementById('mainSearch');

    // Category filtering on main page
    mainCategoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            mainCategoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;
            filterBrands(category);
        });
    });

    function filterBrands(category) {
        // This would filter brands based on their product categories
        // For now, we'll just show all since we don't have brand-level category data
        brandCards.forEach(card => {
            if (category === 'all') {
                card.style.display = '';
            } else {
                // In a real implementation, you would check if brand has products in this category
                card.style.display = '';
            }
        });
    }

    // Main page search
    if (mainSearch) {
        mainSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            brandCards.forEach(card => {
                const img = card.querySelector('img');
                if (img) {
                    const altText = img.alt.toLowerCase();
                    if (altText.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    }

    // Create a comprehensive mapping of all Viking categories
    const vikingCategories = {
        'Fire Sprinkler': [
            'Standard Coverage - Standard Response',
            'Standard Coverage - Quick Response',
            'Extended Coverage Sprinklers',
            'Storage Sprinklers',
            'Special Sprinklers',
            'Residential Sprinklers',
            'Dry Barrel Sprinklers',
            'Sprinkler Accessories',
            'Spray Nozzles',
            'View All Sprinklers'
        ],
        'Valves & Systems': [
            'EasyPac Riser Assemblies',
            'Wet Pipe Systems',
            'Dry Pipe Systems',
            'Deluge & Preaction Systems',
            'Data Center Upgradeable Systems',
            'Flow Control & Pressure Regulation',
            'Firecycle® Systems',
            'Accessories',
            'View All Valves & Systems'
        ],
        'Foam Systems': [
            'High Expansion Foam Systems',
            'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
            'Shared Foam System Components',
            'View All Foam Products'
        ],
        'Special Hazards': [
            'Oxeo Clean Agent Extinguishing System',
            'Ignitable Liquid Storage Protection',
            'View All Special Hazards'
        ],
        'Piping Systems': [
            'BlazeMaster® CPVC Pipe & Fittings',
            'InstaSeal® Welded Outlet Systems',
            'View All Piping Systems'
        ],
        'Electricals': [
            'Release Control Panels',
            'Detection and Control Solutions',
            'View All Electrical Products'
        ]
    };

    // Create mapping for Nittan categories
    const nittanCategories = {
        'UL Addressable': [
            'Panels',
            'Optional Modules',
            'Annunciators',
            'Graphic Monitor Softwares',
            'Detectors & Bases',
            'Accessories'
        ],
        'UL Conventional': [
            'Detectors & Bases',
            'Pull Stations',
            'Notification Appliances',
            'Accessories'
        ],
        'JP Conventional': [
            'Panels',
            'Accessories',
            'Detectors & Bases',
            'Manual Alarm Station',
            'Gas Detectors',
            'Explosion Proof Type',
            'Test Tool'
        ],
        'EN Addressable': [
            'Panel',
            'FX Series Accessories',
            'NF Series Accessories',
            'Call Points',
            'Notification Appliances',
            'Gas Detectors',
            'Loop Modules'
        ],
        'EN Conventional': [
            'Panels',
            'Gas Detectors',
            'Detectors & Bases',
            'Call points',
            'Notification Appliances'
        ]
    };

    // Function to check if a category belongs to a main category
    function categoryBelongsToMain(category, mainCategory) {
        // Direct match with main category
        if (category === mainCategory) return true;

        // Check if category starts with mainCategory (for Viking format like "Fire Sprinkler - Standard Coverage...")
        if (category && category.startsWith(mainCategory + ' - ')) {
            return true;
        }

        // Check Viking categories
        const vikingSubcategories = vikingCategories[mainCategory];
        if (vikingSubcategories) {
            // Check exact match in subcategories
            if (vikingSubcategories.includes(category)) {
                return true;
            }

            // Check case-insensitive match
            const categoryLower = category.toLowerCase();
            for (let i = 0; i < vikingSubcategories.length; i++) {
                if (vikingSubcategories[i].toLowerCase() === categoryLower) {
                    return true;
                }
            }

            // For Electricals categories, handle specific keywords
            if (mainCategory === 'Electricals') {
                if (categoryLower.includes('release control') &&
                    vikingSubcategories.some(s => s.toLowerCase().includes('release control'))) {
                    return true;
                }
                if (categoryLower.includes('detection and control') &&
                    vikingSubcategories.some(s => s.toLowerCase().includes('detection and control'))) {
                    return true;
                }
                if (categoryLower.includes('view all electrical') &&
                    vikingSubcategories.some(s => s.toLowerCase().includes('view all electrical'))) {
                    return true;
                }
            }

            // For Foam Systems, handle SFFF variations
            if (mainCategory === 'Foam Systems') {
                if (categoryLower.includes('sfff') || categoryLower.includes('fluorine free')) {
                    return true;
                }
            }
        }

        // Check Nittan categories
        const nittanSubcategories = nittanCategories[mainCategory];
        if (nittanSubcategories) {
            // Check exact match in subcategories
            if (nittanSubcategories.includes(category)) {
                return true;
            }

            // Check case-insensitive match
            const categoryLower = category.toLowerCase();
            for (let i = 0; i < nittanSubcategories.length; i++) {
                if (nittanSubcategories[i].toLowerCase() === categoryLower) {
                    return true;
                }
            }
        }

        return false;
    }

    // Function to check if there are any visible products
    function checkAndShowNoProductsMessage(modal) {
        const productsContainer = modal.querySelector('.products-container');
        const visibleProducts = modal.querySelectorAll('.product-item:not(.hidden)');

        // Get brand name from modal title
        const modalTitle = modal.querySelector('.modal-title');
        const brandName = modalTitle ? modalTitle.textContent.trim() : '';

        // Check if no products message already exists
        let noProductsDiv = productsContainer.querySelector('.no-products-message');

        if (visibleProducts.length === 0) {
            // Show no products message
            if (!noProductsDiv) {
                noProductsDiv = document.createElement('div');
                noProductsDiv.className = 'text-center py-5 no-products-message';
                noProductsDiv.innerHTML = `
                    <div class="divider p-2">
                        <h4 class="mb-2">${brandName}</h4>
                        <hr class="mb-3">
                    </div>
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5>No products found</h5>
                    <p class="text-muted">Try selecting a different category.</p>
                `;
                productsContainer.appendChild(noProductsDiv);
            }
        } else {
            // Remove no products message if it exists
            if (noProductsDiv) {
                noProductsDiv.remove();
            }
        }
    }

    // 2. Modal Functionality - UPDATED FOR VIKING AND NITTAN CATEGORIES
    document.querySelectorAll('.portfolio-modal').forEach(modal => {
        const modalId = modal.id;
        const modalSearch = modal.querySelector('.modal-search[data-modal="' + modalId + '"]');
        const searchBtn = modal.querySelector('.search-btn[data-modal="' + modalId + '"]');
        const navButtons = modal.querySelectorAll('.main-nav-btn');
        const productItems = modal.querySelectorAll('.product-item');
        const categorySections = modal.querySelectorAll('.category-section');

        // Modal search functionality - includes tags search
        if (modalSearch) {
            modalSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();

                productItems.forEach(item => {
                    const name = item.dataset.name ? item.dataset.name.toLowerCase() : '';
                    const description = item.dataset.description ? item.dataset.description.toLowerCase() : '';
                    const tags = item.dataset.tags ? item.dataset.tags.toLowerCase() : '';

                    if (name.includes(searchTerm) || description.includes(searchTerm) || tags.includes(searchTerm)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });

                // Show/hide category sections based on visible products
                categorySections.forEach(section => {
                    const itemsInSection = section.querySelectorAll('.product-item');
                    const visibleItems = Array.from(itemsInSection).filter(item =>
                        !item.classList.contains('hidden')
                    );
                    section.style.display = visibleItems.length > 0 ? 'block' : 'none';
                });

                // Check and show no products message
                checkAndShowNoProductsMessage(modal);
            });

            // Search button click
            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    modalSearch.focus();
                });
            }
        }

        // Modal category filtering - UPDATED for Viking and Nittan
        navButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Update active state
                modal.querySelectorAll('.main-nav-btn.active').forEach(btn => {
                    btn.classList.remove('active', 'bg-light', 'text-dark');
                });

                // Add active class
                this.classList.add('active', 'bg-light', 'text-dark');

                const category = this.dataset.category;
                filterModalProducts(modal, category);
            });
        });

        function filterModalProducts(modal, category) {
            const allCategory = category === 'all';
            const categorySections = modal.querySelectorAll('.category-section');
            const productItems = modal.querySelectorAll('.product-item');

            console.log('Filtering modal for category:', category);

            if (allCategory) {
                // Show all sections and products
                categorySections.forEach(section => {
                    section.style.display = 'block';
                });
                productItems.forEach(item => {
                    item.classList.remove('hidden');
                });
            } else {
                // Hide all sections first
                categorySections.forEach(section => {
                    section.style.display = 'none';
                });

                // Hide all products first
                productItems.forEach(item => {
                    item.classList.add('hidden');
                });

                // Show sections and products that match the selected category
                categorySections.forEach(section => {
                    const sectionCategory = section.dataset.category;

                    // Check if this section's category belongs to the selected main category
                    if (categoryBelongsToMain(sectionCategory, category)) {
                        section.style.display = 'block';

                        // Show all products in this section
                        section.querySelectorAll('.product-item').forEach(item => {
                            item.classList.remove('hidden');
                        });
                    }
                });
            }

            // Check and show no products message after filtering
            checkAndShowNoProductsMessage(modal);
        }

        // Initialize with all products visible
        filterModalProducts(modal, 'all');

        // Make the "All Products" button active by default
        const allProductsBtn = modal.querySelector('.main-nav-btn[data-category="all"]');
        if (allProductsBtn) {
            allProductsBtn.classList.add('active', 'bg-light', 'text-dark');
        }
    });

    // 3. View Details functionality with blur effect and closing brand modal
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Get the current open brand modal
            const openBrandModal = document.querySelector('.portfolio-modal.show');

            // Get product info from the card
            const card = this.closest('.product-modal-card');
            const productItem = this.closest('.product-item');
            const title = card.querySelector('.product-title')?.textContent || 'Product Details';

            // Get full description from data attribute
            let fullDescription = '';
            if (productItem && productItem.dataset.description) {
                fullDescription = productItem.dataset.description;
            } else {
                fullDescription = card.querySelector('.product-description')?.textContent || 'No description available.';
            }

            const image = card.querySelector('img')?.src || '';
            const productType = card.querySelector('.text-primary-custom')?.textContent || 'PRODUCT';

            // Set product details modal content
            document.getElementById('productModalTitle').textContent = title;
            document.getElementById('productModalBody').innerHTML = `
                <div class="row">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="${image}" class="product-detail-image img-fluid rounded" alt="${title}">
                        <div class="mt-2">
                            <span class="badge bg-primary">${productType}</span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-detail-content">
                            <h4 style="color: #084433;" class="mb-3">${title}</h4>
                            <div class="product-full-description">
                                <h6 class="fw-bold mb-2">Product Description</h6>
                                <div class="p-3 bg-light rounded">
                                    ${fullDescription ? '<p style="white-space: pre-wrap;">' + fullDescription + '</p>' : '<p class="text-muted">No description available.</p>'}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // If a brand modal is open, close it first
            if (openBrandModal) {
                const brandModalInstance = bootstrap.Modal.getInstance(openBrandModal);
                if (brandModalInstance) {
                    brandModalInstance.hide();

                    // Wait for brand modal to close before showing product details
                    openBrandModal.addEventListener('hidden.bs.modal', function() {
                        // Show the product details modal
                        const productModal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
                        productModal.show();
                    }, { once: true });
                }
            } else {
                // If no brand modal is open, just show product modal
                const productModal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
                productModal.show();
            }
        });
    });
});
</script>

@endsection
