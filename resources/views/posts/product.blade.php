<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Archtech Industries</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&family=Roboto:wght@400;500&family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--Bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
         /* Contact Section */
        #contact {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

          .nav-contact-btn {
            align-items: end;
            background: #06a17d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .nav-contact-btn:hover {
            background: #293949;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: white;
            text-decoration: none;
        }
        :root {
            --primary-color: rgb(1, 101, 99);
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Features Section */
        .features {
            background-color: var(--white);
            margin-top: 6%;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 0 auto;
            max-width: 1400px;
        }

        .feature-card {
            width: 100%;
            height: 250px;
            background-color: var(--white);
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eaeaea;
            padding: 20px;
        }

        .feature-icon img {
            max-width: 100%;
            max-height: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: var(--primary-color);
        }

         /* Navigation */
         .navbar {
            background-color: var(--primary-color) !important;
            min-height: 60px;
        }

        /* Adjust navbar brand to fit within the height */
        .navbar-brand {
            display: flex;
            align-items: center;
            height: 60px;
            padding: 0;
        }

        .navbar-brand img {
            max-height: 70px;
            margin-top: 5px;
            width: auto;
        }

        /* Ensure navbar toggle button is centered */
        .navbar-toggler {
            padding: 0.25rem 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Adjust navbar collapse for mobile */
        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: var(--primary-color);
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 0 0 8px 8px;
            }

            .navbar-nav {
                text-align: center;
            }

            .nav-link {
                padding: 0.5rem 0;
            }

            .dropdown-menu {
                text-align: center;
                background-color: rgba(0, 0, 0, 0.2);
                border: none;
            }
        }


        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #063326;
            border-color: #063326;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .category-btn.active {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        /* Modal Styles */
        .portfolio-modal .modal-dialog {
            margin: 20px auto;
            max-width: 95vw;
            height: 95vh;
        }

        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #084433 0%, #0a573e 100%);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .modal-body {
            padding: 0;
            max-height: calc(95vh - 200px);
            overflow-y: auto;
        }

        /* Products Grid */
        .product-grid {
            padding: 20px;
        }

        .product-item {
            margin-bottom: 20px;
        }

        .product-modal-card {
            height: 100%;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .product-modal-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-color: var(--primary-color);
        }

        .product-image-container {
            height: 160px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .product-image-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 0.95rem;
            line-height: 1.3;
            min-height: 2.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-description {
            font-size: 0.85rem;
            line-height: 1.4;
            min-height: 3rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Category Navigation */
        .category-nav {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        /* Manufacturers Section */
        .manufacturers-section {
            padding: 30px 20px;
            background: #f8f9fa;
            margin-top: 20px;
        }

        .manufacturer-logo {
            padding: 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .manufacturer-logo:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .feature-card {
                height: 220px;
            }
        }

        @media (max-width: 992px) {
            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 15px;
            }

            .feature-card {
                height: 200px;
            }

            .modal-title {
                font-size: 1.25rem;
            }

            .product-grid {
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .features {
                padding: 60px 0;
            }

            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 12px;
            }

            .feature-card {
                height: 180px;
                padding: 15px;
            }

            .feature-icon img {
                max-height: 140px;
            }

            .modal-header {
                padding: 1rem;
            }

            .modal-title {
                font-size: 1.1rem;
            }

            .product-item {
                margin-bottom: 15px;
            }

            .product-image-container {
                height: 140px;
            }
        }

        @media (max-width: 576px) {
            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 10px;
            }

            .feature-card {
                height: 160px;
                padding: 10px;
            }

            .feature-icon img {
                max-height: 120px;
            }

            .modal-dialog {
                margin: 10px auto;
                height: 90vh;
            }

            .modal-body {
                max-height: calc(90vh - 150px);
            }

            .category-nav .btn {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }

            .product-info {
                padding: 10px;
            }

            .product-title {
                font-size: 0.85rem;
            }

            .product-description {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 400px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .feature-card {
                height: 140px;
            }

            .feature-icon img {
                max-height: 100px;
            }
        }

        /* Utility Classes */
        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }

        .border-primary-custom {
            border-color: var(--primary-color) !important;
        }

        /* Optional styling for better visual feedback */
        .main-nav-btn.active {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            border-color: #000000;
        }

        .accessories-btn.active {
            background-color: #6c757d;
            color: white;
            border-color: #6c757d;
        }

        .systems-btn.active {
            background-color: #6c757d;
            color: white;
            border-color: #6c757d;
        }

        /* Spacing between collapsible sections when both are open */
        #accessoriesButtons + #systemsButtons {
            margin-top: 0.5rem;
        }

        /* Fix for anchor links with fixed navbar */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('homepage/file/assets/navlogo.png') }}" alt="Archtech Industries Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}#services">Services</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('fire-pro.index') }}">Fire Protection</a></li>
                            <li><a class="dropdown-item" href="{{ route('mechanical.index') }}">Mechanical</a></li>
                            <li><a class="dropdown-item" href="{{ Route('electrical.index') }}">Electrical</a></li>
                            <li><a class="dropdown-item" href="{{ route('auxiliary.index') }}">Auxiliary</a></li>
                            <li><a class="dropdown-item" href="{{ route('material-handling.index') }}">Material Handling</a></li>
                            <li><a class="dropdown-item" href="{{ route('tools-lifting.index') }}">Tools & lifting equipment</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">All Products</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}#about">About</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}#projects">Projects</a></li>
                    <a href="{{ route('home') }}#contact" class="nav-contact-btn">Contact us</a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
     <!-- Updated Footer with All Accreditation Images -->
    <footer class="bg-dark text-light pt-5 pb-3 mt-5">
           <div class="container">
            <div class="row text-center text-md-start">

                <!-- Company Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Archtech Industries</h5>
                    <p class="small text-muted">
                        Providing reliable engineered systems and innovative solutions for modern industries.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2 mb-4">
                    <h6 class="fw-semibold">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                        <li><a href="{{ route('home') }}#about" class="text-decoration-none text-muted">Products</a></li>
                        <li><a href="{{ route('home') }}#services" class="text-decoration-none text-muted">Services</a></li>
                        <li><a href="{{ route('home') }}#contact" class="text-decoration-none text-muted">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="col-md-3 mb-4">
                    <h6 class="fw-semibold">Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">Help Center</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">FAQs</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Terms of Service</a></li>
                    </ul>
                </div>
                <!-- Support -->
                {{-- <div class="col-md-3 mb-4">
                    <h6 class="fw-semibold">Brands</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">Help Center</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">FAQs</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Terms of Service</a></li>
                    </ul>
                </div> --}}

                <!-- Contact -->
                <div class="col-md-6">
                    <h6 class="fw-semibold">Contact Us</h6>
                    <p class="small text-muted mb-1"><i class="fa-solid fa-location-dot"></i> Yellow Bell Lower Cayam St. RLJB Purok 18, Colon,
                        City of Naga, Cebu Philippines</p>
                    <p class="small text-muted mb-1"><i class="fa-solid fa-phone"></i> +63 969 193 8522</p>
                    <p class="small text-muted mb-1"><i class="fa-solid fa-at"></i> jophetbaruel.archtechphil@gmail.com</p>
                    <p class="small text-muted"><i class="fa-brands fa-facebook"></i> Archtech Industries</p>
                </div>


                <!-- Social Images -->
<div class="col-md-6 d-flex justify-content-md-end justify-content-center align-items-center gap-1 mt-3 mt-md-0">

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/pcab.gif') }}"
             alt="Bureau Logo" width="50" height="50" class="img-fluid d-block">
    </a>

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/buro.png') }}"
             alt="Bureau Logo" width="50" height="50" class="img-fluid d-block">
    </a>

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/com.png') }}"
             alt="Twitter" width="50" height="50" class="img-fluid d-block">
    </a>

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/naga.png') }}"
             alt="LinkedIn" width="50" height="50" class="img-fluid d-block">
    </a>

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/dole.png') }}"
             alt="Instagram" width="50" height="50" class="img-fluid d-block">
    </a>

    <a href="#" class="d-inline-block bg-white rounded-circle p-1 shadow-sm">
        <img class="rounded-circle" src="{{ asset('homepage/file/assets/logo/phil.png') }}"
             alt="YouTube" width="50" height="50" class="img-fluid d-block">
    </a>

</div>
            </div>

            <!-- Divider -->
            <hr class="border-secondary">

            <!-- Bottom Row -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="small text-muted mb-2 mb-md-0">
                    © 2026 Archtech Industries. All rights reserved.
                </p>

                <!-- Social Icons (Bootstrap Icons) -->
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/profile.php?id=100078186617093" class="text-muted fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-linkedin"></i></a>
                </div>


            </div>
        </div>
    </footer>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle navigation links to home page sections
            document.querySelectorAll('a[href^="{{ route('home') }}#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    window.location.href = href;
                });
            });

            // Handle direct hash links that should go to home
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const hash = this.getAttribute('href');

                    // If it's a homepage section, go to home with hash
                    if (hash === '#about' || hash === '#projects' || hash === '#contact' || hash === '#services') {
                        window.location.href = '{{ route('home') }}' + hash;
                    }
                });
            });
        });
    </script>
</body>
</html>
