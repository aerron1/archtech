
@extends('posts.product')

@section('content')
<!-- Features Section -->
<section class="features" id="features">
    <div class="container mb-1 py-3">
        <div class="row align-items-center">
            <!-- Logo Column -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <img src="{{ asset('homepage/file/assets/logo/fluke_logo.png') }}"
                    style="width: 200px; height: 50px;"
                    alt="Logo">
            </div>

            <!-- Search Bar Column -->
            <div class="col-12 col-md-8">
                <div class="d-flex justify-content-center justify-content-md-end">
                    <div class="input-group input-group-sm" style="max-width: 450px;">
                        <input type="text" class="form-control" id="mainSearch" placeholder="Search brands...">
                        <button class="btn btn-primary" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Products Section -->
<section class="page-section py-2 " id="products">



        <!--product card -->
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <!-- Image Area -->
                    <div class="text-center py-3 bg-light">
                        <div class="mx-auto" style="width: 200px; height: 200px; overflow: hidden;">
                            <img src="{{ asset('homepage/file/assets/fluke/clamp.png') }}"
                                 class="img-fluid"
                                 alt="Digital Multimeters"
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-4">
                        <!-- Product Title -->
                        <h4 class="card-title fw-bold text-center mb-3">Clamp Meters</h4>

                        <!-- Action Button -->
                        <div class="mt-auto text-center">
                            <a href="#" class="btn btn-warning btn-lg text-dark fw-bold">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</section>


@endsection
s
