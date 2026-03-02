@extends('posts.product')

@section('content')

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <!-- Category Buttons -->
        <div class="mb-5 d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
            <button class="btn btn-outline-primary btn-sm active" data-category="all">All Products</button>
            <button class="btn btn-outline-primary btn-sm" data-category="cctv">CCTV</button>
            <button class="btn btn-outline-primary btn-sm" data-category="access-control">Access Control</button>

            <!-- Right: Search Bar -->
            <div class="search-bar ms-auto">
                <input type="text" class="form-control form-control-sm" id="mainSearch" placeholder="Search brands..." style="max-width: 220px;">
            </div>
        </div>

        <!-- CCTV Brands Section -->
        <div class="mb-5">
            <h4 class="fw-bold mb-4 text-center">CCTV Brands</h4>
            <div class="features-grid mb-4">
                @foreach($productsByBrand as $brandName => $brandData)
                    @if(in_array($brandName, $cctvBrands))
                        @php
                            $brandIndex = array_search($brandName, array_keys($productsByBrand)) + 1;
                        @endphp
                        <a href="#portfolioModal{{ $brandIndex }}" class="text-decoration-none brand-card" data-bs-toggle="modal" data-category="cctv">
                            <div class="feature-card position-relative">
                                <!-- CCTV Label -->
                                <div class="brand-type-label position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-info px-2 py-1">CCTV</span>
                                </div>

                                <div class="feature-icon">
                                    <img src="{{ asset('homepage/file/assets/logo/' . $brandData['image']) }}" alt="{{ $brandName }}">
                                </div>
                                <!-- Brand Name -->
                                <div class="text-center mt-2">
                                    <h6 class="fw-bold mb-0">{{ $brandName }}</h6>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Access Control Brands Section -->
        <div class="mb-5">
            <h4 class="fw-bold mb-4 text-center">Access Control Brands</h4>
            <div class="features-grid">
                @foreach($productsByBrand as $brandName => $brandData)
                    @if(in_array($brandName, $accessControlBrands))
                        @php
                            $brandIndex = array_search($brandName, array_keys($productsByBrand)) + 1;
                        @endphp
                        <a href="#portfolioModal{{ $brandIndex }}" class="text-decoration-none brand-card" data-bs-toggle="modal" data-category="access-control">
                            <div class="feature-card position-relative">
                                <!-- Access Control Label -->
                                <div class="brand-type-label position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-warning text-dark px-2 py-1">Access Control</span>
                                </div>

                                <div class="feature-icon">
                                    <img src="{{ asset('homepage/file/assets/logo/' . $brandData['image']) }}" alt="{{ $brandName }}">
                                </div>
                                <!-- Brand Name -->
                                <div class="text-center mt-2">
                                    <h6 class="fw-bold mb-0">{{ $brandName }}</h6>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Brand Modals -->
@php
    $brandIndex = 1;
@endphp

@foreach($productsByBrand as $brandName => $brandData)
    @php
        $modalId = 'portfolioModal' . $brandIndex;
        $brand = $brandData['brand'];
        $groupedProducts = $brandData['grouped_products'];
        $brandType = $brandData['type'];
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
                            @if($brandType == 'cctv')
                                <span class="badge bg-info ms-2">CCTV</span>
                            @else
                                <span class="badge bg-warning text-dark ms-2">Access Control</span>
                            @endif
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
                            <button class="btn btn-outline-primary bg-light text-dark active btn-sm main-nav-btn"
                                    data-category="all">All Products</button>

                            @if($brandType == 'cctv')
                                <button class="btn btn-outline-primary btn-sm main-nav-btn"
                                        data-category="cctv">CCTV Products</button>
                            @else
                                <button class="btn btn-outline-primary btn-sm main-nav-btn"
                                        data-category="access-control">Access Control Products</button>
                            @endif
                        </div>
                    </div>
                    <!-- End Nav-->

                    <!-- Products Grid -->
                    <div class="products-container" id="productsContainer{{ $brandIndex }}">
                        @if(count($brandData['products']) > 0)
                            <!-- Display all products initially -->
                            <div class="all-products-section">
                                <!-- CCTV Products Section -->
                                @if(count($groupedProducts['cctv']) > 0)
                                    <div class="category-section" data-category="cctv">
                                        <div class="divider">
                                            <h4 class="mb-2">CCTV Products</h4>
                                            <hr class="mb-3">
                                        </div>

                                        <div class="row g-3 product-grid">
                                            @foreach($groupedProducts['cctv'] as $product)
                                                <div class="col-6 col-md-4 col-lg-3 product-item"
                                                     data-category="cctv"
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
                                                                <!-- Fallback to brand logo -->
                                                                <img src="{{ asset('homepage/file/assets/logo/' . $brandData['image']) }}"
                                                                     alt="{{ $product->product_name ?? $product->title }}"
                                                                     class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <small class="text-primary-custom fw-bold d-block mb-1">
                                                                CCTV PRODUCT
                                                            </small>
                                                            <h6 class="product-title mb-2">
                                                                {{ $product->product_name ?? $product->title }}
                                                            </h6>
                                                            <div class="product-description-wrapper mb-3">
                                                                <p class="product-description small text-muted">
                                                                    {{ Str::limit(strip_tags($product->content), 100) }}
                                                                </p>
                                                            </div>
                                                            <button class="btn btn-primary btn-sm w-100 view-details">View Details</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Access Control Products Section -->
                                @if(count($groupedProducts['access-control']) > 0)
                                    <div class="category-section" data-category="access-control">
                                        <div class="divider">
                                            <h4 class="mb-2">Access Control Products</h4>
                                            <hr class="mb-3">
                                        </div>

                                        <div class="row g-3 product-grid">
                                            @foreach($groupedProducts['access-control'] as $product)
                                                <div class="col-6 col-md-4 col-lg-3 product-item"
                                                     data-category="access-control"
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
                                                                <!-- Fallback to brand logo -->
                                                                <img src="{{ asset('homepage/file/assets/logo/' . $brandData['image']) }}"
                                                                     alt="{{ $product->product_name ?? $product->title }}"
                                                                     class="img-fluid">
                                                            @endif
                                                        </div>
                                                        <div class="product-info">
                                                            <small class="text-primary-custom fw-bold d-block mb-1">
                                                                ACCESS CONTROL PRODUCT
                                                            </small>
                                                            <h6 class="product-title mb-2">
                                                                {{ $product->product_name ?? $product->title }}
                                                            </h6>
                                                            <div class="product-description-wrapper mb-3">
                                                                <p class="product-description small text-muted">
                                                                    {{ Str::limit(strip_tags($product->content), 100) }}
                                                                </p>
                                                            </div>
                                                            <button class="btn btn-primary btn-sm w-100 view-details">View Details</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
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
@endforeach

<!-- Product Details Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
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

    /* Ensure modals are visible */
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
        display: flex;
        flex-direction: column;
    }

    .product-modal-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .feature-card {
        transition: transform 0.2s;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .feature-card:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .brand-type-label {
        z-index: 1;
    }

    .feature-icon {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .feature-icon img {
        max-height: 80px;
        max-width: 100%;
        object-fit: contain;
    }

    .product-image-container {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        overflow: hidden;
        padding: 10px;
    }

    .product-image-container img {
        max-height: 120px;
        max-width: 100%;
        width: auto;
        object-fit: contain;
    }

    .product-info {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-description-wrapper {
        flex: 1;
        min-height: 60px;
    }

    .product-description {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4;
        max-height: 4.2em;
        margin-bottom: 0;
        word-wrap: break-word;
    }

    .divider h4 {
        color: #084433;
        font-weight: 600;
    }

    .divider hr {
        border-top: 2px solid #084433;
        opacity: 0.2;
    }

    /* Features Grid */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        justify-items: center;
        margin-bottom: 40px;
    }

    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1200px) {
        .features-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Badge Styles */
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
    }

    /* Section Titles */
    h4.fw-bold.mb-4.text-center {
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 10px;
        display: inline-block;
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

    // Handle all modals (brand modals)
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
        brandCards.forEach(card => {
            if (category === 'all') {
                card.style.display = '';
            } else {
                const cardCategory = card.dataset.category;
                if (cardCategory === category) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
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

    // 2. Modal Functionality
    document.querySelectorAll('.portfolio-modal').forEach(modal => {
        const modalId = modal.id;
        const modalSearch = modal.querySelector('.modal-search[data-modal="' + modalId + '"]');
        const searchBtn = modal.querySelector('.search-btn[data-modal="' + modalId + '"]');
        const navButtons = modal.querySelectorAll('.main-nav-btn, .accessories-btn');
        const productItems = modal.querySelectorAll('.product-item');
        const categorySections = modal.querySelectorAll('.category-section');

        // Get brand name from modal title
        const modalTitle = modal.querySelector('.modal-title');
        const brandName = modalTitle ? modalTitle.textContent.trim() : '';

        // Function to check if there are any visible products
        function checkAndShowNoProductsMessage() {
            const productsContainer = modal.querySelector('.products-container');
            const visibleProducts = modal.querySelectorAll('.product-item:not(.hidden)');

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
                    <h5>No products found </h5>
                    <p class="text-muted"></p>
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
                        item.classList.contains('hidden') === false
                    );
                    section.style.display = visibleItems.length > 0 ? 'block' : 'none';
                });

                // Check and show no products message
                checkAndShowNoProductsMessage();
            });

            // Search button click
            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    modalSearch.focus();
                });
            }
        }

        // Modal category filtering
        navButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Skip if it's a collapse toggle button
                if (this.hasAttribute('data-bs-toggle') && this.getAttribute('data-bs-toggle') === 'collapse') {
                    return;
                }

                // Update active state
                modal.querySelectorAll('.main-nav-btn.active, .accessories-btn.active').forEach(btn => {
                    btn.classList.remove('active', 'bg-light', 'text-dark', 'bg-secondary', 'text-white');
                });

                // Add active class
                if (this.classList.contains('accessories-btn')) {
                    this.classList.add('active', 'bg-secondary', 'text-white');
                } else {
                    this.classList.add('active', 'bg-light', 'text-dark');
                }

                const category = this.dataset.category;
                filterModalProducts(modalId, category);
            });
        });

        function filterModalProducts(modalId, category) {
            const allCategory = category === 'all';

            categorySections.forEach(section => {
                if (allCategory || section.dataset.category === category) {
                    section.style.display = 'block';
                    section.querySelectorAll('.product-item').forEach(item => {
                        item.classList.remove('hidden');
                    });
                } else {
                    section.style.display = 'none';
                    section.querySelectorAll('.product-item').forEach(item => {
                        item.classList.add('hidden');
                    });
                }
            });

            // Check and show no products message after filtering
            checkAndShowNoProductsMessage();
        }

        // Initial check for no products (if all are hidden initially)
        checkAndShowNoProductsMessage();
    });

    // 3. View Details functionality - Close brand modal and show product details with blur
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Get the current open brand modal
            const openBrandModal = document.querySelector('.portfolio-modal.show');

            // Get product info from the card
            const card = this.closest('.product-modal-card');
            const title = card.querySelector('.product-title')?.textContent || 'Product Details';

            // Get the full description from the data attribute or card
            const productItem = this.closest('.product-item');
            let fullDescription = '';

            if (productItem && productItem.dataset.description) {
                // If we have the full description in data attribute
                fullDescription = productItem.dataset.description;
            } else {
                // Fallback to the truncated description
                fullDescription = card.querySelector('.product-description')?.textContent || 'No description available.';
            }

            const image = card.querySelector('img')?.src || '';

            // Get product type
            const productType = productItem?.dataset.category === 'cctv' ? 'CCTV' : 'Access Control';

            // Get the product details modal
            const modal = document.getElementById('productDetailsModal');
            const modalTitle = modal.querySelector('.modal-title');
            const modalBody = modal.querySelector('.modal-body');

            // Set modal content
            modalTitle.textContent = title;
            modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="${image}" class="product-detail-image img-fluid rounded" alt="${title}">
                        <div class="mt-2">
                            <span class="badge ${productType === 'CCTV' ? 'bg-info' : 'bg-warning text-dark'}">${productType}</span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-detail-content">
                            <h6 class="fw-bold mb-3">Product Description</h6>
                            <div class="p-3 bg-light rounded">
                                ${fullDescription ? '<p style="white-space: pre-wrap;">' + fullDescription + '</p>' : '<p class="text-muted">No description available.</p>'}
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
                        const productModal = new bootstrap.Modal(modal);
                        productModal.show();
                    }, { once: true }); // Use { once: true } to ensure the event listener is removed after execution
                } else {
                    // If no instance found, just show product modal
                    const productModal = new bootstrap.Modal(modal);
                    productModal.show();
                }
            } else {
                // If no brand modal is open, just show product modal
                const productModal = new bootstrap.Modal(modal);
                productModal.show();
            }
        });
    });
});

// Helper function to get all quotes (kept for backward compatibility)
function getAuxiliaryQuotes() {
    return JSON.parse(localStorage.getItem('auxiliaryQuotes') || '[]');
}

// Helper function to clear quotes
function clearAuxiliaryQuotes() {
    localStorage.removeItem('auxiliaryQuotes');
}
</script>

@endsection
