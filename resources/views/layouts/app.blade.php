<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Archtech - @yield('title', 'Blog')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary: rgb(1, 101, 99);
            --primary-dark: #014d4b;
            --primary-light: #028b88;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, #ffffff 100%);
            color: var(--gray-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--primary);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(1, 101, 99, 0.1);
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            max-height: 45px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo:hover img {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a.active {
            color: var(--primary);
            font-weight: 600;
        }

        /* Contact button in nav */
        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--primary);
            color: white !important;
            padding: 0.4rem 1rem !important;
            border-radius: 30px;
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
            margin-left: 0.5rem;
        }

        .contact-link i {
            font-size: 0.8rem;
        }

        .contact-link:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(1, 101, 99, 0.3);
        }

        .contact-link:hover::after {
            display: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 3rem 1rem;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary);
            position: relative;
        }

        .page-header::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100px;
            height: 2px;
            background: var(--primary);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .page-description {
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        /* Blog Content */
        .blog-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .blog-content {
            padding: 2.5rem;
        }

        .post-meta {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            color: var(--gray-600);
            font-size: 0.95rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .post-meta i {
            color: var(--primary);
            margin-right: 0.3rem;
        }

        .post-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .post-content {
            color: var(--gray-700);
        }

        .post-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .post-content h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 2.5rem 0 1rem;
            color: var(--gray-900);
        }

        .post-content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 2rem 0 1rem;
            color: var(--gray-900);
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 2rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .post-content blockquote {
            border-left: 4px solid var(--primary);
            padding: 1rem 0 1rem 2rem;
            margin: 2rem 0;
            background: var(--gray-50);
            font-style: italic;
            color: var(--gray-600);
        }

        .post-content ul, .post-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .post-content li {
            margin-bottom: 0.5rem;
        }

        .post-content a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .post-content a:hover {
            text-decoration: underline;
        }

        .post-content code {
            background: var(--gray-100);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.9em;
            color: var(--primary-dark);
        }

        .post-content pre {
            background: var(--gray-900);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 2rem 0;
        }

        /* Tags */
        .post-tags {
            margin: 2.5rem 0 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .tag {
            display: inline-block;
            background: var(--gray-100);
            color: var(--gray-700);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--primary);
            color: white;
        }

        /* Share Buttons */
        .share-buttons {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
        }

        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-3px);
        }

        .share-btn.facebook { background: #1877f2; }
        .share-btn.twitter { background: #1da1f2; }
        .share-btn.linkedin { background: #0077b5; }
        .share-btn.whatsapp { background: #25d366; }

        /* Blog Grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .blog-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .blog-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-card-content {
            padding: 1.5rem;
        }

        .blog-card-category {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.2rem 1rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .blog-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .blog-card-title a {
            color: inherit;
            text-decoration: none;
        }

        .blog-card-title a:hover {
            color: var(--primary);
        }

        .blog-card-excerpt {
            color: var(--gray-600);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .blog-card-meta {
            display: flex;
            gap: 1rem;
            color: var(--gray-500);
            font-size: 0.85rem;
        }

        .blog-card-meta i {
            color: var(--primary);
            margin-right: 0.3rem;
        }

        /* READ MORE BUTTON - SMALLER VERSION */
        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.8rem;
            margin-top: 0.75rem;
            padding: 0.25rem 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }

        .read-more i {
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .read-more:hover {
            color: var(--primary-dark);
            border-bottom-color: var(--primary-light);
            gap: 0.6rem;
        }

        .read-more:hover i {
            transform: translateX(3px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 3rem 0;
            list-style: none;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            color: var(--gray-700);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination .active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Back to Top Button - NEW SMALL BUTTON */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(1, 101, 99, 0.3);
            z-index: 99;
        }

        .back-to-top.show {
            opacity: 1;
        }

        .back-to-top:hover {
            background: var(--primary-dark);
            transform: translateY(-5px);
        }

        .back-to-top i {
            font-size: 1rem;
        }

        /* Footer */
        .footer {
            background: var(--gray-900);
            color: white;
            margin-top: 4rem;
            padding: 3rem 0 2rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-logo img {
            max-height: 45px;
            width: auto;
            margin-bottom: 1rem;
            filter: brightness(0) invert(1);
            transition: opacity 0.3s ease;
        }

        .footer-logo img:hover {
            opacity: 0.9;
        }

        .footer-about {
            color: var(--gray-400);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: white;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-links i {
            color: var(--primary);
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .footer-links a:hover i {
            transform: translateX(3px);
        }

        .footer-contact {
            list-style: none;
            padding: 0;
        }

        .footer-contact li {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            color: var(--gray-400);
            font-size: 0.95rem;
        }

        .footer-contact i {
            color: var(--primary);
            width: 20px;
            margin-top: 3px;
            font-size: 0.9rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray-400);
            font-size: 0.9rem;
        }

        .footer-bottom a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                height: auto;
                padding: 1rem;
            }

            .nav-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .main-content {
                padding: 2rem 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .post-title {
                font-size: 1.8rem;
            }

            .blog-content {
                padding: 1.5rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                gap: 2rem;
            }
        }

        @media (max-width: 480px) {
            .post-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .share-buttons {
                flex-wrap: wrap;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <img src="{{ asset('homepage/file/assets/navlogo.png') }}" alt="Archtech Industries Logo">
            </a>

            <div class="nav-links">

                <a  href="/" class="{{ request()->is('/') ? 'active' : '' }}" class="contact-link">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header (Optional) -->
    @hasSection('page-header')
        <div class="main-content" style="padding-top: 1rem;">
            <div class="page-header">
                <h1 class="page-title">@yield('page-title')</h1>
                @hasSection('page-description')
                    <p class="page-description">@yield('page-description')</p>
                @endif
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        @if(request()->routeIs('blog.show'))
            <div class="blog-container">
                <div class="blog-content">
                    @yield('content')
                </div>
            </div>
        @else
            @yield('content')
        @endif
    </main>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div>
                    <a href="/" class="footer-logo">
                        <img src="{{ asset('homepage/file/assets/navlogo.png') }}" alt="Archtech Industries Logo">
                    </a>
                    <p class="footer-about">
                        Engineering excellence and innovative solutions for industrial and commercial applications. Your trusted partner in fire protection and engineering services.
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/profile.php?id=100078186617093" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div>
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="/about"><i class="fas fa-chevron-right"></i>About Us</a></li>
                        <li><a href="/services"><i class="fas fa-chevron-right"></i>Services</a></li>
                        <li><a href="/projects"><i class="fas fa-chevron-right"></i>Projects</a></li>
                        <li><a href="/blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                        <li><a href="#contact"><i class="fas fa-chevron-right"></i>Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="footer-title">Products</h5>
                    <ul class="footer-links">
                        <li><a href="/fire-pro"><i class="fas fa-chevron-right"></i>Fire Protection</a></li>
                        <li><a href="/mechanical"><i class="fas fa-chevron-right"></i>Mechanical</a></li>
                        <li><a href="/electrical"><i class="fas fa-chevron-right"></i>Electrical</a></li>
                        <li><a href="/auxiliary"><i class="fas fa-chevron-right"></i>Auxiliary</a></li>
                        <li><a href="/material-handling"><i class="fas fa-chevron-right"></i>Material Handling</a></li>
                        <li><a href="/tools-lifting"><i class="fas fa-chevron-right"></i>Tools & Lifting</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="footer-title">Contact</h5>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Yellow Bell Lower Cayam St. RLJB Purok 18, Colon, City of Naga, Cebu Philippines</span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <span>+63 969 193 8522</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>jophetbaruel.archtechphil@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} Archtech Industries. All rights reserved. |
                    <a href="#">Privacy Policy</a> |
                    <a href="#">Terms of Service</a>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Back to top button functionality
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('backToTop');
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        document.getElementById('backToTop')?.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
