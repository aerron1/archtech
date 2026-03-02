@extends('posts.product')

@section('content')

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <!-- Category Buttons -->
        <div class="mb-5 d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
            <button class="btn btn-outline-primary btn-sm active" data-category="all">All Products</button>
            @foreach($productsByCategory as $categoryName => $products)
                <button class="btn btn-outline-primary btn-sm" data-category="{{ $categoryName }}">{{ $categoryName }}</button>
            @endforeach

            <!-- Right: Search Bar -->
            <div class="search-bar ms-auto">
                <input type="text" class="form-control form-control-sm" id="mainSearch" placeholder="Search products..." style="max-width: 220px;">
            </div>
        </div>

        <!-- No Products Message -->
        @if(empty($productsByCategory))
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                <h3>No Material Handling Products Found</h3>
                <p class="text-muted">Products will appear here once added by admin.</p>
            </div>
        @else
            <!-- Products Grid by Category -->
            <div class="material-handling-products-container">
                @foreach($productsByCategory as $categoryName => $products)
                    <div class="category-section mb-5" data-category="{{ $categoryName }}">
                        <div class="divider">
                            <h2 class="mb-3">{{ $categoryName }}</h2>
                            <hr class="mb-4">
                        </div>

                        <div class="row g-4 product-grid">
                            @foreach($products as $product)
                                <div class="col-6 col-md-4 col-lg-3 product-item"
                                     data-category="{{ $categoryName }}"
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
                                                <img src="{{ asset('homepage/file/assets/logo/material-handling-default.png') }}"
                                                     alt="Material Handling Product"
                                                     class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <small class="text-primary-custom fw-bold d-block mb-1">
                                                {{ $categoryName }}
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
                @endforeach
            </div>
        @endif
    </div>
</section>

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

    /* Material Handling Products Page Styles */
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
        background-color: #084433 !important;
        color: white !important;
        border-color: #084433 !important;
    }

    .product-modal-card {
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        display: flex;
        flex-direction: column;
    }

    .product-modal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(8, 68, 51, 0.1);
    }

    .product-image-container {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        overflow: hidden;
        padding: 15px;
    }

    .product-image-container img {
        max-height: 150px;
        max-width: 100%;
        width: auto;
        object-fit: contain;
    }

    .product-info {
        padding: 16px;
        border-top: 1px solid #e9ecef;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #084433;
        line-height: 1.4;
        height: 2.8em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-description-wrapper {
        flex: 1;
        min-height: 3.6em;
    }

    .product-description {
        font-size: 0.8rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0;
        word-wrap: break-word;
    }

    .divider h2 {
        color: #084433;
        font-weight: 700;
        font-size: 1.75rem;
    }

    .divider hr {
        border-top: 3px solid #084433;
        opacity: 0.2;
        margin-top: 5px;
    }

    .text-primary-custom {
        color: #5DB996;
    }

    .btn-primary {
        background-color: #084433;
        border-color: #084433;
    }

    .btn-primary:hover {
        background-color: #063325;
        border-color: #063325;
    }

    .btn-outline-primary {
        color: #084433;
        border-color: #084433;
    }

    .btn-outline-primary:hover {
        background-color: #084433;
        border-color: #084433;
    }

    /* Product Details Modal Styles */
    #productDetailsModal .modal-body {
        padding: 1.5rem;
    }

    #productDetailsModal .product-detail-image {
        max-height: 300px;
        width: 100%;
        object-fit: contain;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 1rem;
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
        margin-bottom: 1rem;
    }

    #productDetailsModal .category-badge {
        display: inline-block;
        padding: 0.35rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        background-color: #5DB996;
        margin-bottom: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-image-container {
            height: 150px;
        }

        .product-image-container img {
            max-height: 120px;
        }

        .product-title {
            font-size: 0.85rem;
        }

        .divider h2 {
            font-size: 1.5rem;
        }

        #productDetailsModal .product-detail-image {
            max-height: 200px;
        }
    }

    @media (max-width: 576px) {
        .product-image-container {
            height: 130px;
        }

        .product-image-container img {
            max-height: 100px;
        }

        .product-info {
            padding: 12px;
        }
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

    // 1. Category Filtering
    const categoryButtons = document.querySelectorAll('.features .btn-outline-primary[data-category]');
    const categorySections = document.querySelectorAll('.category-section');
    const mainSearch = document.getElementById('mainSearch');

    // Category filtering
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active state
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const category = this.dataset.category;
            filterProductsByCategory(category);
        });
    });

    function filterProductsByCategory(category) {
        if (category === 'all') {
            // Show all sections and all products
            categorySections.forEach(section => {
                section.classList.remove('hidden');
                const products = section.querySelectorAll('.product-item');
                products.forEach(product => product.classList.remove('hidden'));
            });
        } else {
            // Hide all sections first
            categorySections.forEach(section => {
                section.classList.add('hidden');
            });

            // Show only the selected category section
            const selectedSection = document.querySelector(`.category-section[data-category="${category}"]`);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');

                // Show all products in this section
                const products = selectedSection.querySelectorAll('.product-item');
                products.forEach(product => product.classList.remove('hidden'));
            }
        }

        // Apply search filter if there's an active search
        if (mainSearch && mainSearch.value.trim() !== '') {
            filterProductsBySearch(mainSearch.value.toLowerCase());
        }
    }

    // 2. Search functionality
    if (mainSearch) {
        mainSearch.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterProductsBySearch(searchTerm);
        });
    }

    function filterProductsBySearch(searchTerm) {
        // Get currently visible category
        const activeButton = document.querySelector('.features .btn-outline-primary.active');
        const activeCategory = activeButton ? activeButton.dataset.category : 'all';

        if (activeCategory === 'all') {
            // Search across all sections
            categorySections.forEach(section => {
                const products = section.querySelectorAll('.product-item');
                let hasVisibleProducts = false;

                products.forEach(product => {
                    const name = product.dataset.name || '';
                    const description = product.dataset.description || '';
                    const tags = product.dataset.tags || '';

                    if (searchTerm.trim() === '' || name.includes(searchTerm) || description.includes(searchTerm) || tags.includes(searchTerm)) {
                        product.classList.remove('hidden');
                        hasVisibleProducts = true;
                    } else {
                        product.classList.add('hidden');
                    }
                });

                // Hide section if no visible products
                if (searchTerm.trim() !== '') {
                    section.classList.toggle('hidden', !hasVisibleProducts);
                } else {
                    section.classList.remove('hidden');
                }
            });
        } else {
            // Search only within active category
            const activeSection = document.querySelector(`.category-section[data-category="${activeCategory}"]`);
            if (activeSection) {
                const products = activeSection.querySelectorAll('.product-item');

                products.forEach(product => {
                    const name = product.dataset.name || '';
                    const description = product.dataset.description || '';
                    const tags = product.dataset.tags || '';

                    if (searchTerm.trim() === '' || name.includes(searchTerm) || description.includes(searchTerm) || tags.includes(searchTerm)) {
                        product.classList.remove('hidden');
                    } else {
                        product.classList.add('hidden');
                    }
                });
            }
        }
    }

    // 3. View Details functionality - Updated with blur effect
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

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
            const category = card.querySelector('.text-primary-custom')?.textContent || 'Material Handling Product';

            // Create modal HTML with improved layout for long content
            const modalHTML = `
                <div class="row">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img src="${image}" class="product-detail-image img-fluid rounded" alt="${title}">
                        <div class="mt-2">
                            <span class="category-badge">${category}</span>
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

            // Set modal content
            document.getElementById('productModalTitle').textContent = title;
            document.getElementById('productModalBody').innerHTML = modalHTML;

            // Show modal
            const productModal = new bootstrap.Modal(document.getElementById('productDetailsModal'));
            productModal.show();
        });
    });
});
</script>

@endsection
