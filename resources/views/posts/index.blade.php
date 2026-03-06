<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Archtech Industries</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('homepage/file/assets/faviconlogo.png')}}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        :root {
            --primary-color: rgb(1, 101, 99);
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Fix for anchor links with fixed navbar - THIS IS CRITICAL */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px; /* This ensures sections start below navbar */
        }

        /* Ensure each section has proper scroll margin */
        #services,
        #about,
        #projects,
        #contact,
        .page-section {
            scroll-margin-top: 80px;
        }

        /* Responsive adjustment */
        @media (max-width: 768px) {
            html {
                scroll-padding-top: 70px;
            }

            #services,
            #about,
            #projects,
            #contact,
            .page-section {
                scroll-margin-top: 70px;
            }
        }

        /* Adjust navbar collapse for mobile */
        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: var(--primary-color);
                padding: 1rem !important;
                margin-top: 0.5rem !important;
                border-radius: 0 0 8px 8px !important;
            }

            .navbar-nav {
                text-align: center;
            }

            .nav-link {
                padding: 0.5rem 0 !important;
            }

            .dropdown-menu {
                text-align: center;
                background-color: rgba(0, 0, 0, 0.2) !important;
                border: none !important;
            }
        }

        /* Masthead with Video Background */
        .masthead {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1a1a2e; /* Fallback color */
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(0, 0, 0, 0.7) 0%,
                rgba(0, 0, 0, 0.5) 50%,
                rgba(53, 52, 52, 0.3) 100%
            );
            z-index: 2;
        }

        /* Services Section */
        .page-section {
            padding: 80px 0;
        }

        .service-card {
            height: 100%;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .service-icon {
            padding: 40px 30px;
            text-align: center;
        }

        .service-icon i {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .service-content {
            padding: 30px;
        }

        /* About Section */
        .core-value-card {
            height: 100%;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .core-value-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .stat-card {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            border: 1px solid #eaeaea;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        /* Contact Section */
        #contact {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        /* Footer */
        .footer {
            background-color: #212529;
            color: white;
            padding: 40px 0;
        }

        /* Modal Styles */
        .portfolio-modal .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: 2px solid #fff;
        }

        .portfolio-modal .modal-title {
            font-weight: 600;
        }

        .portfolio-modal .btn-close {
            filter: brightness(0) invert(1);
        }

        .product-modal-card {
            height: 100%;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .product-modal-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .product-image-container {
            height: 200px;
            overflow: hidden;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .product-image-container:hover img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
        }

        /* Animation Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover Effects */
        .title-animate:hover {
            transform: scale(1.02);
            text-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .subtitle-animate:hover {
            transform: scale(1.05);
            color: #f0f0f0 !important;
            transition: all 0.3s ease;
        }

        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            background-color: #fff;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        /* Sidebar Navigation */
        .masthead-nav {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .nav-services {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-services li {
            position: relative;
        }

        .nav-services a {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 5px 0;
            display: block;
        }

        .nav-services a:hover {
            color: var(--primary-color, #007bff);
            transform: translateY(-2px);
        }

        .nav-services a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color, #007bff);
            transition: width 0.3s ease;
        }

        .nav-services a:hover::after {
            width: 100%;
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

        /* Responsive for sidebar nav */
        @media (max-width: 992px) {
            .nav-services {
                gap: 20px;
            }

            .nav-services a {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .masthead-nav {
                padding: 10px 0;
            }

            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-services {
                justify-content: center;
                gap: 15px;
            }

            .nav-services a {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .nav-services {
                gap: 10px;
            }

            .nav-services a {
                font-size: 0.75rem;
            }

            .nav-contact-btn {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
        }

        /* TYPEWRITER STYLE */
        #typewriter {
            font-weight: 400;
        }

        .cursor {
            display: inline-block;
            margin-left: 3px;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%,100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .typing-line {
            display: inline-block;
            overflow: hidden;
            border-right: 3px solid white;
            white-space: nowrap;
            width: 0;
            animation: typing 3s steps(60, end) forwards,
                    blink 0.8s infinite;
        }

        .delay-1 {
            animation-delay: 3s;
        }

        .delay-2 {
            animation-delay: 6s;
        }

        @keyframes typing {
            from { width: 0 }
            to { width:100% }
        }

        /* Text animations */
        .title-animate {
            animation: fadeUp 1.2s ease forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive masthead */
        @media (max-width: 768px) {
            .masthead {
                min-height: 80vh;
            }

            .masthead .display-4 {
                font-size: 2rem;
            }

            .masthead .lead {
                width: 100% !important;
                font-size: 1rem;
            }
        }

        /*client carousel*/
        .carousel-inner {
            display: flex;
        }

        .carousel-item {
            transition: transform 10s ease-in-out;
        }

        /* Team Carousel Styles */
        .team-carousel-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 20px 0;
        }

        .team-carousel-track {
            display: flex;
            gap: 30px;
            width: max-content;
            animation: scrollTeam 30s linear infinite;
        }

        /* Pause animation on container hover */
        .team-carousel-container:hover .team-carousel-track {
            animation-play-state: paused;
        }

        /* Individual Team Member Card */
        .team-member-card {
            flex: 0 0 280px;
            height: 350px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
            transition: transform 0.5s ease;
        }

        /* Simple zoom effect on hover */
        .team-member-card:hover {
            transform: scale(1.05);
        }

        /* Profile Photo Background */
        .member-photo-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: 1;
            transition: transform 0.7s ease;
        }

        .team-member-card:hover .member-photo-background {
            transform: scale(1.1);
        }

        .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
            z-index: 2;
        }

        /* Default background when no photo */
        .default-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .default-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
        }

        .member-initial {
            font-size: 4rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            display: block;
            margin-bottom: 10px;
        }

        /* Member Info Overlay */
        .member-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3;
            text-align: center;
            color: white;
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            border-top: 2px solid var(--primary-color);
            transition: all 0.5s ease;
        }

        .team-member-card:hover .member-info-overlay {
            opacity: 0;
            visibility: hidden;
        }

        .member-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
        }

        .member-position {
            font-size: 0.9rem;
            color: var(--primary-color);
            font-weight: 500;
            background: rgba(255,255,255,0.9);
            padding: 6px 18px;
            border-radius: 20px;
            display: inline-block;
        }

        /* Scroll Animation */
        @keyframes scrollTeam {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-member-card {
                flex: 0 0 220px;
                height: 300px;
            }

            .member-name {
                font-size: 1.1rem;
            }

            .member-position {
                font-size: 0.8rem;
            }

            .member-initial {
                font-size: 3rem;
            }
        }

        @media (max-width: 576px) {
            .team-member-card {
                flex: 0 0 200px;
                height: 280px;
            }
        }

        /* Form Validation Styles */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .is-invalid ~ .invalid-feedback {
            display: block;
        }

        /* Loading spinner */
        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: -0.125em;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: .75s linear infinite spinner-border;
        }

        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }

        /* Enhanced form styles */
        #contactForm .form-control {
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
        }

        #contactForm .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(1, 101, 99, 0.1);
            outline: none;
        }

        #contactForm .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        #contactForm .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        #contactForm textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Submit button styles */
        #submitBtn {
            background: linear-gradient(135deg, var(--primary-color) 0%, #016563 100%);
            border: none;
            padding: 12px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        #submitBtn:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(1, 101, 99, 0.3);
        }

        #submitBtn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Loading animation */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        .loading-pulse {
            animation: pulse 1.5s infinite;
        }

        /* Form group hover effects */
        .form-group {
            position: relative;
            transition: all 0.3s ease;
        }

        .form-group.focused label {
            color: var(--primary-color);
            transform: translateY(-5px);
            font-size: 0.9rem;
        }

        /* Smooth dropdown animation */
        .projects-dropdown {
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .dropdown-show {
            display: block !important;
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
                max-height: 0;
            }
            to {
                opacity: 1;
                transform: translateY(0);
                max-height: 2000px;
            }
        }

        /* Card hover effects */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        /* ===== CAROUSEL ===== */
        .continuous-carousel {
            overflow: hidden;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            gap: 24px;
            width: max-content;
            animation: scroll 30s linear infinite;
            scroll-behavior: smooth;
        }

        /* Pause on hover */
        .continuous-carousel:hover .carousel-track {
            animation-play-state: paused;
        }

        /* CARD */
        .carousel-card {
            position: relative;
            min-width: 420px;
            height: 280px;
            border-radius: 22px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .carousel-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .carousel-card:hover img {
            transform: scale(1.05);
        }

        /* Badge */
        .badge-label {
            position: absolute;
            bottom: 14px;
            left: 14px;
            background: rgba(0,0,0,.6);
            color: #fff;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 14px;
        }

        /* Animation */
        @keyframes scroll {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .carousel-card {
                min-width: 280px;
                height: 220px;
            }
        }

        /* Project Card and Modal Styles */
        .project-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
        }

        /* Modal Carousel Styles */
        .modal-carousel-container {
            width: 100%;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .modal-carousel-track {
            display: flex;
            gap: 20px;
            width: max-content;
            animation: modalScroll 30s linear infinite;
        }

        .modal-carousel-container:hover .modal-carousel-track {
            animation-play-state: paused;
        }

        .modal-carousel-card {
            position: relative;
            min-width: 500px;
            height: 350px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .modal-carousel-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .modal-carousel-card:hover img {
            transform: scale(1.05);
        }

        @keyframes modalScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Modal adjustments */
        .portfolio-modal .modal-body {
            padding: 2rem;
        }

        .portfolio-modal .lead {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 1rem;
        }

        .portfolio-modal .text-muted i {
            font-size: 1.2rem;
        }

        /* Project info section */
        .project-info-section {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid var(--primary-color);
        }

        /* Footer Image Styles */
        .footer-image {
            max-height: 60px;
            width: auto;
            max-width: 100%;
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0.9;
            object-fit: contain;
        }

        .footer-image:hover {
            transform: translateY(-3px);
            opacity: 1;
        }

        .image-container {
            background-color: transparent;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            width: 100%;
        }

        .accreditation-title {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Responsive adjustments for footer */
        @media (max-width: 768px) {
            .footer-image {
                max-height: 50px;
            }

            .image-container {
                height: 70px;
                padding: 5px;
            }

            .accreditation-title {
                text-align: center !important;
                margin-top: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .footer-image {
                max-height: 45px;
            }

            .image-container {
                height: 65px;
            }
        }

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

        /* Office Carousel - CONSTANT ROTATION */
        .office-carousel {
            overflow: hidden;
            width: 100%;
        }

        .office-carousel .carousel-track {
            display: flex;
            gap: 24px;
            width: max-content;
            animation: scrollOffice 40s linear infinite;
            /* This ensures NO RESET - just constant smooth scrolling */
            will-change: transform;
        }

        /* Pause on hover - optional, remove if you don't want pause */
        .office-carousel:hover .carousel-track {
            animation-play-state: paused;
        }

        @keyframes scrollOffice {
            0% {
                transform: translateX(0);
            }
            100% {
                /* This moves exactly half the width (one full set) */
                transform: translateX(calc(-50% - 12px)); /* -12px accounts for half the gap */
            }
        }

        /* Ensure cards don't shrink */
        .office-carousel .carousel-card {
            flex: 0 0 auto;
            width: 420px; /* Fixed width to ensure consistency */
        }

        @media (max-width: 768px) {
            .office-carousel .carousel-card {
                width: 280px;
            }
        }

        /* reCAPTCHA Styles */
        .g-recaptcha {
            margin: 15px 0;
            display: flex;
            justify-content: center;
        }

        .recaptcha-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
            text-align: center;
        }

        @media (max-width: 400px) {
            .g-recaptcha {
                transform: scale(0.9);
                transform-origin: center;
            }
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--primary-color); min-height: 60px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#page-top" style="height: 60px; padding: 0;">
                <img src="{{ asset('homepage/file/assets/navlogo.png') }}" alt="Archtech Industries Logo" style="max-height: 70px; margin-top: 5px; width: auto;">
            </a>

            <button class="navbar-toggler p-1 px-2 border-1 border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link px-3" href="#services">Services</a></li>

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
                            <li><a class="dropdown-item" href="{{ Route('tools-lifting.index') }}">Tools & lifting equipment</a></li>
                            <li><hr class="dropdown-divider"></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link px-3" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#projects">Projects</a></li>

                    <a href="#contact" class="nav-contact-btn">Contact us</a>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead with Video Background -->
    <masthead class="masthead">
        <!-- Video Background -->
        <div class="video-background">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('homepage/file/assets/img/background-vid/background.mp4') }}" type="video/mp4">
                <!-- Add fallback text in case video doesn't load -->
                Your browser does not support the video tag.
            </video>
            <!-- Dark overlay to ensure text readability -->
            <div class="video-overlay"></div>
        </div>

        <div class="container position-relative" style="z-index: 3;">
            <h1 class="display-4 fw-bold mb-2 text-white title-animate">
                Archtech Industries
            </h1>
            <p class="lead mb-5 text-white" style="width: 60%;">
                <span id="typewriter"></span><span class="cursor">|</span>
            </p>
        </div>
    </masthead>

    <!-- Services Section -->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-4">Our Services & Product Line</h2>
                <p class="text-muted mb-5">We deliver integrated protection systems and construction services with precision engineering and uncompromising quality.</p>
            </div>

            <div class="row g-4">
                <!-- Fire Protection -->
                <div class="row align-items-center g-3">
                    <!-- Project Image -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('homepage/file/fire-img.jpg') }}"
                            alt="Completed Project"
                            class="img-fluid rounded-1 shadow-sm"
                            style="width:600px; height:400px; object-fit:cover;">
                    </div>
                    <!-- Content -->
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-2">
                            Fire Protection Systems
                        </h2>
                        <div class="">
                            <ul class="list-unstyled">
                                <h6 class="mb-2">Design-Supply-Installation & Preventive Maintenance</h6>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fire Detectors & Alarm Systems</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fluoro-K Fire Suppression System</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>FM-200 Fire Suppression System</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>C02 Fire Suppression System</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>VESDA/ASD Early Detection Device</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Kitchen Hood Fire Suppression Systems</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sprinkler System</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Pre-action Fire Suppression System</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fire Pump and Jockey Pump</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Electrical Works -->
                <div class="row align-items-center g-5">
                    <!-- Content (LEFT) -->
                    <div class="col-lg-6 order-1 order-lg-1">
                        <h2 class="fw-bold mb-2">
                            Civil & Construction Works
                        </h2>
                        <div class="">
                            <ul class="list-unstyled">
                                <h6 class="mb-2">Design and Build</h6>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Exterior and Interior Residential and Commercial Spaces</li>
                               <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Structural for Commericial and Residential Buildings</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Project Image (RIGHT) -->
                    <div class="col-lg-6 text-center order-2 order-lg-2">
                        <img src="{{ asset('homepage/file/assets/civil.jpg') }}"
                            alt="Completed Project"
                            class="img-fluid rounded-1 shadow-sm"
                            style="width:600px; height:400px; object-fit:cover;">
                    </div>
                </div>

                <!-- Mechanical Works -->
                <div class="row align-items-center g-3">
                    <!-- Project Image -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('homepage/file/assets/mechanical.jpg') }}"
                             alt="Completed Project"
                             class="img-fluid rounded-1 shadow-sm"
                             style="width:600px; height:400px; object-fit:cover;">
                    </div>
                    <!-- Content -->
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-2">
                            Mechanical Works
                        </h2>
                        <div class="">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>PACU</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Smoke Control</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Smoke Extraction</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Plumbing Works</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Air Conditioning installation</li>
                               <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Preventive Maintenance</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Electrical Works -->
                <div class="row align-items-center g-5">
                    <!-- Content (LEFT) -->
                    <div class="col-lg-6 order-1 order-lg-1">
                        <h2 class="fw-bold mb-2">
                            Electrical Works
                        </h2>
                        <div class="">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Electrical Installations</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Harmonic Filter</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Power Quality Analysis</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>SVGm Static var generator for power factor correction</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Electrical Preventive Maintenance</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Project Image (RIGHT) -->
                    <div class="col-lg-6 text-center order-2 order-lg-2">
                        <img src="{{ asset('homepage/file/assets/electrical.png') }}"
                            alt="Completed Project"
                            class="img-fluid rounded-1 shadow-sm"
                            style="width:600px; height:400px; object-fit:cover;">
                    </div>
                </div>

                <!-- Auxiliary Works -->
                <div class="row align-items-center g-3">
                    <!-- Project Image -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('homepage/file/assets/auxiliary.jpg') }}"
                             alt="Completed Project"
                             class="img-fluid rounded-1 shadow-sm"
                             style="width:600px; height:400px; object-fit:cover;">
                    </div>
                    <!-- Content -->
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-2">
                            Auxilliary Works
                        </h2>
                        <div class="">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Structured cabling (CAT6, fiber optics, patch panels, racks)</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Telephone and intercom wiring</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>CCTV and security system cabling</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Public Address (PA) / Background Music (BGM) systems</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fire alarm and detection cabling</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Building Management System (BMS) connections</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="page-section bg-light" id="about">
        <div class="container">
            <div class="text-center mb-2">
                <h2 class="fw-bold mb-4">ABOUT US</h2>
            </div>

            <!-- Company Intro -->
            <div class="bg-white rounded-4 p-4 mb-2">
                <div class="row align-items-center">
                    <div class="">
                        <p class="lead">
                        <strong class="text-bold">ARCHTECH INDUSTRIES</strong> is a proud Filipino-owned engineering firm delivering comprehensive infrastructure solutions with headquarters in Davao City.We specialize in comprehensive Fire Protection Systems, while also providing expertise in architectural, civil, mechanical, electrical, and plumbing services.
                        The company was founded by three dedicated engineers with extensive experience in the construction and building management industry, driven by a shared vision to deliver reliable, innovative, and high-quality solutions to clients across various sectors.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission, Vision, Values -->
            <div class="row g-4">
                <!-- Mission -->
                <div class="col-lg-4">
                    <div class="core-value-card">
                        <i class="fas fa-bullseye fa-2x text-danger mb-3"></i>
                        <h4 class="fw-bold mb-3">Our Mission</h4>
                        <p class="text-muted mb-3">
                            Our main mission is to provide clients high quality
                            products and services that is reliable, safe, affordable
                            backed with after care services.</p>
                    </div>
                </div>

                <!-- Vision -->
                <div class="col-lg-4">
                    <div class="core-value-card">
                        <i class="fas fa-eye fa-2x text-info mb-3"></i>
                        <h4 class="fw-bold mb-3">Our Vision</h4>
                        <p class="text-muted mb-3">
                            We thrive to become the industry leader of engineering
                            solutions, construction services who provides sustainability
                            and cost-effective solutions. </p>
                    </div>
                </div>

                <!-- Core Values -->
                <div class="col-lg-4">
                    <div class="core-value-card">
                        <i class="fas fa-star fa-2x text-success mb-3"></i>
                        <h4 class="fw-bold mb-3">Core Values</h4>
                        <p class="text-muted mb-3">
                            Excellence is our virtue by positioning first the needs
                            of our clients through technology, infrastructure and
                            People.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="text-center p-5 mt-5 text-white rounded-1" style="background: rgb(1, 101, 99);">
                <h3 class="fw-bold mb-4">Our Team</h3>

                <div class="team-carousel-container">
                    <div class="team-carousel-track" id="teamCarouselTrack">
                        @php
                            // Fetch active team members excluding the admin seeder (assuming ID 1)
                            $teamMembers = App\Models\User::where('is_active', true)
                                ->where('role', 'admin')
                                ->where('id', '!=', 1)
                                ->orderBy('position')
                                ->orderBy('name')
                                ->get();

                            // If no team members found, create dummy data
                            if ($teamMembers->isEmpty()) {
                                $teamMembers = collect([
                                    (object)['name' => 'Team Member 1', 'position' => 'Position 1', 'profile_picture' => null],
                                    (object)['name' => 'Team Member 2', 'position' => 'Position 2', 'profile_picture' => null],
                                ]);
                            }

                            // Duplicate items for seamless infinite scroll
                            $duplicatedMembers = collect($teamMembers)->merge($teamMembers);
                        @endphp

                        @foreach($duplicatedMembers as $member)
                            <div class="team-member-card">
                                @if($member->profile_picture)
                                    <div class="member-photo-background"
                                         style="background-image: url('{{ asset('storage/' . $member->profile_picture) }}');">
                                        <div class="photo-overlay"></div>
                                    </div>
                                @else
                                    <div class="member-photo-background default-bg">
                                        <div class="photo-overlay"></div>
                                        <div class="default-content">
                                            <span class="member-initial">
                                                {{ substr($member->name, 0, 1) }}
                                            </span>
                                            <h5 class="member-name">{{ $member->name }}</h5>
                                        </div>
                                    </div>
                                @endif

                                <div class="member-info-overlay">
                                    <h5 class="member-name">{{ $member->name }}</h5>
                                    <p class="member-position">{{ $member->position }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Accomplished Projects Section -->
<section class="page-section" id="projects">
    <div class="container text-center" style="margin-top: 30px;">

        <h2 class="fw-bold mb-4">
            Our Office
        </h2>
        <!-- Office Carousel - CONSTANT ROTATION, NO RESET -->
        <div class="continuous-carousel office-carousel mb-4">
            <div class="carousel-track" id="officeCarouselTrack">
                <!-- Original 5 images -->
                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img1.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img2.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img3.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img4.jpg') }}" alt="Office">
                    <span class="badge-label">Office Lounge</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img5.jpg') }}" alt="Office">
                    <span class="badge-label">Office Table</span>
                </div>

                <!-- EXACT SAME SET duplicated for seamless infinite loop -->
                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img1.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img2.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img3.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img4.jpg') }}" alt="Office">
                    <span class="badge-label">Office Lounge</span>
                </div>

                <div class="carousel-card">
                    <img src="{{ asset('homepage/file/assets/img5.jpg') }}" alt="Office">
                    <span class="badge-label">Office</span>
                </div>
            </div>
        </div>

        <h2 class="fw-bold mb-4">
            Accomplished Projects
        </h2>

        @php
            // Fetch featured/published projects from database
            $featuredProjects = App\Models\Project::where('is_published', true)
                ->where('status', 'completed')
                ->latest()
                ->take(6)
                ->get();

            // Get remaining projects for dropdown
            $remainingProjects = App\Models\Project::where('is_published', true)
                ->where('status', 'completed')
                ->latest()
                ->skip(6)
                ->take(6)
                ->get();

            // Combine all projects for modal generation
            $allProjects = $featuredProjects->merge($remainingProjects);
        @endphp

        <div class="row g-4">
            <!-- Project Cards from Database -->
            @forelse($featuredProjects as $project)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm project-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                        @if($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}"
                                class="card-img-top"
                                alt="{{ $project->title }}"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=400"
                                class="card-img-top"
                                alt="Default project image"
                                style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body" style="background-color: #00a28a">
                            <h5 class="card-title text-start text-white">{{ $project->title }}</h5>
                            @if($project->location)
                                <p class="card-text text-start text-white-50">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $project->location }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback sample projects if no database entries -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{asset('homepage/file/assets/project1.jpg')}}"
                            class="card-img-top"
                            alt="Project 1"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body" style="background-color: #00a28a">
                            <h5 class="card-title text-start text-white">SUPPLY & INSTALLATION OF FM-200 FIRE SUPPRESSION SYSTEM</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a"
                            class="card-img-top"
                            alt="Project 2"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body" style="background-color: #00a28a">
                            <h5 class="card-title text-start text-white">SUPPLY & INSTALLATION OF CONVENTIONAL FDAS FOR 2 STOREY COMMERCIAL BUILDING</h5>
                            <p class="card-text text-start text-white-50">LOCATION: POLOG, CONSOLACION, CEBU</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511"
                            class="card-img-top"
                            alt="Project 3"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body" style="background-color: #00a28a">
                            <h5 class="card-title text-start text-white">ONE (1) YEAR COMPREHENSIVE PREVENTIVE MAINTENANCE OF FM-200 FIRE SUPPRESSION SYSTEM</h5>
                            <p class="card-text text-start text-white-50">LOCATION: CYBERZONE TOWER 2, CEBU BUSSINES PARK, CEBU CITY</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        @if($remainingProjects->count() > 0)
            <!-- View More Button -->
            <button class="btn btn-primary px-4 py-2 w-25" id="viewMoreBtn" style="margin-top: 30px;">
                View More ({{ $remainingProjects->count() }} more)
            </button>

            <!-- Hidden Projects Section -->
            <div class="projects-dropdown mt-4" id="projectsDropdown" style="display: none;">
                <div class="row g-4">
                    @foreach($remainingProjects as $project)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm project-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                                @if($project->featured_image)
                                    <img src="{{ asset('storage/' . $project->featured_image) }}"
                                        class="card-img-top"
                                        alt="{{ $project->title }}"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=400"
                                        class="card-img-top"
                                        alt="Default project image"
                                        style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body" style="background-color: #00a28a">
                                    <h5 class="card-title text-start text-white">{{ $project->title }}</h5>
                                    @if($project->location)
                                        <p class="card-text text-start text-white-50">
                                            <i class="fas fa-map-marker-alt me-2"></i>{{ $project->location }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Close Button -->
                <button class="btn btn-outline-primary mt-4" id="viewLessBtn">
                    View Less
                </button>
            </div>
        @endif

        <!-- Project Modals (Generated for ALL projects) with Blur Effect -->
        @if(isset($allProjects) && $allProjects->count() > 0)
            @foreach($allProjects as $project)
                <!-- Project Modal with Continuous Carousel and Blur Effect -->
                <div class="modal fade portfolio-modal" id="projectModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <!-- Gallery Carousel (Continuous Scroll) -->
                                    @if($project->gallery_images && count($project->gallery_images) > 0)
                                        <div class="modal-carousel-container mb-4">
                                            <div class="modal-carousel-track" id="modalCarouselTrack{{ $project->id }}">
                                                @foreach($project->gallery_images as $image)
                                                    <div class="modal-carousel-card">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                             alt="Gallery image">
                                                    </div>
                                                @endforeach
                                                <!-- Duplicate for seamless loop -->
                                                @foreach($project->gallery_images as $image)
                                                    <div class="modal-carousel-card">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                             alt="Gallery image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <!-- Fallback if no gallery images -->
                                        <div class="text-center py-5 bg-light rounded mb-4">
                                            <i class="fas fa-images fa-4x text-muted mb-3"></i>
                                            <p class="text-muted">No gallery images available for this project.</p>
                                        </div>
                                    @endif

                                    <!-- Project Info - Below the carousel -->
                                    <div class="project-info-section">
                                        @if($project->description)
                                            <p class="lead mb-3">{{ $project->description }}</p>
                                        @endif

                                        @if($project->location)
                                            <p class="text-muted mb-0">
                                                <i class="fas fa-map-marker-alt me-2" style="color: var(--primary-color);"></i>
                                                <strong>Location:</strong> {{ $project->location }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Contact Us</h2>
                <p class="text-muted">Get in touch with our team for inquiries and consultations</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <!-- Explicit token field for extra safety -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                <div class="invalid-feedback">Please enter your name.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div class="col-12 mb-3">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                                <div class="invalid-feedback">Please enter a subject.</div>
                            </div>

                            <div class="col-12 mb-3">
                                <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                                <div class="invalid-feedback">Please enter your message.</div>
                            </div>

                            <!-- reCAPTCHA -->
                            <div class="col-12 mb-3">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                <div class="invalid-feedback recaptcha-feedback" style="display: none;">Please complete the reCAPTCHA verification.</div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5" id="submitBtn">
                                <span id="submitText">Send Message</span>
                                <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Updated Footer with All Accreditation Images -->
    <footer class="bg-dark text-light pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="row align-items-center text-center text-md-start">

                    <!-- Contact -->
                    <div class="col-md-5 mb-4 mb-md-0">
                        <h6 class="fw-semibold">Contact Us</h6>
                        <p class="small text-muted mb-1">
                            <i class="fa-solid fa-location-dot"></i>
                            Yellow Bell Lower Cayam St. RLJB Purok 18, Colon,
                            City of Naga, Cebu Philippines
                        </p>
                        <p class="small text-muted mb-1">
                            <i class="fa-solid fa-phone"></i> +63 969 193 8522
                        </p>
                        <p class="small text-muted mb-1">
                            <i class="fa-solid fa-at"></i> jophetbaruel.archtechphil@gmail.com
                        </p>
                        <p class="small text-muted">
                            <i class="fa-brands fa-facebook"></i> Archtech Industries
                        </p>
                    </div>


                    <!-- Accreditation / Social Images -->
                    <div class="col-md-7 d-flex justify-content-md-end justify-content-end align-items-end gap-2 flex-wrap">

                        <img src="{{ asset('homepage/file/assets/logo/nfpa.png') }}"
                             alt="Fire Logo"
                             class="img-fluid"
                             style="max-height: 80px;">

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/pcab.gif') }}"
                                 alt="PCAB" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/buro.png') }}"
                                 alt="Bureau" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/com.png') }}"
                                 alt="COM" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/naga.png') }}"
                                 alt="Naga" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/dole.png') }}"
                                 alt="DOLE" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                        <a href="#" class="bg-white rounded-circle p-1 shadow-sm">
                            <img src="{{ asset('homepage/file/assets/logo/phil.png') }}"
                                 alt="Philippines" width="70" height="70" class="img-fluid rounded-circle">
                        </a>

                    </div>

                </div>


                            <!-- Quick Links -->
                            <div class="col-md-2 mb-4">
                                <h2 class="fw-semibold">Our Brands</h2>
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold">A</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">ABB</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ACT</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ADT</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AIKOH</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AMAG</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AMEREX</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ANSUL</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">APOLLO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AS ONE</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ASSA ABLOY</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ATTOM</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AUDAC</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">AXIS</a></li>
                                    <h6 class="fw-semibold mt-3">B</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">BOSCH</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">BRADY</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">BRISTOL</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">BRIVO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">BUCKEYE</a></li>
                                </ul>
                            </div>
                            <!-- Support -->
                            <div class="col-md-2 mt-4">
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold mt-4">C</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">CAMPBELL</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CFCOOPER</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CIRCUTOR</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CLECO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CODIPRO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CONTEC</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">CROSSMAN</a></li>

                                    <h6 class="fw-semibold mt-3">D</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">DBC</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">DSPA</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">DSX</a></li>

                                    <h6 class="fw-semibold mt-3">F</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">FIREDETEC</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">FLUKE</a></li>

                                    <h6 class="fw-semibold mt-3">G</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">GALLAGHER</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">GENESIS</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">GIACOMINI</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">GROSVENOR</a></li>
                                </ul>
                            </div>
                            <!-- Support -->
                            <div class="col-md-2 mt-4">
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold mt-4">H</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">HD FIRE PROTECTION</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HID</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HI-FOG</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HIOKI</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HITACHI</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HONEYWELL</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">HKP</a></li>

                                    <h6 class="fw-semibold mt-3">I</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">IDENTICARD</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">IMPRO TECHNOLOGIES</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">INDALA</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">INNERRANGE</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ISONAS</a></li>

                                    <h6 class="fw-semibold mt-3">J</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">JANUS</a></li>
                                </ul>
                            </div>
                             <!-- Support -->
                            <div class="col-md-2 mt-4">
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold mt-3">K</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">KIDDE FIRE SYSTEM</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">KIKUSUI</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">KONE</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">KYB</a></li>

                                    <h6 class="fw-semibold mt-3">L</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">LEHAVOT</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">LOCKWOOD</a></li>

                                    <h6 class="fw-semibold mt-3">M</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">MITUTOYO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">MSA</a></li>

                                    <h6 class="fw-semibold mt-3">N</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">NITCHI</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">NITTAN</a></li>

                                    <h6 class="fw-semibold mt-3">P</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">PAC</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">PAXTON</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">PRESCO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">PROTECTOWIRE</a></li>
                                </ul>
                            </div>

                             <!-- Support -->
                             <div class="col-md-2 mt-4">
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold mt-3">R</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">RION</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">ROSSLARE</a></li>

                                    <h6 class="fw-semibold mt-3">S</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">SALICRU</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SALTO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SCHINDLER</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SCHLAGE</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SHIMADZU</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SIFER</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SIEMENS</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SLIDESLEDGE</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SOTRA</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">STANLEY BLACK & DECKER</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">SYSTEMHOUSE SOLUTION</a></li>

                                </ul>
                            </div>

                               <!-- Support -->
                               <div class="col-md-2 mt-4">
                                <ul class="list-unstyled">
                                    <h6 class="fw-semibold mt-3">T</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">TECOM</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">TOA</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">TRUSCO</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">TTK</a></li>
                                    <li><a href="#" class="text-decoration-none text-muted">TYCO</a></li>

                                    <h6 class="fw-semibold mt-3">V</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">VICTAULIC</a></li>

                                    <h6 class="fw-semibold mt-3">3</h6>
                                    <li><a href="#" class="text-decoration-none text-muted">3M</a></li>
                                </ul>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Add this to your existing DOMContentLoaded event listener or create a new one
    document.addEventListener('DOMContentLoaded', function() {
        // Create blur backdrop element if it doesn't exist
        if (!document.querySelector('.modal-blur-backdrop')) {
            const blurBackdrop = document.createElement('div');
            blurBackdrop.className = 'modal-blur-backdrop';
            document.body.appendChild(blurBackdrop);
        }

        // Track currently open modals
        let openModalsCount = 0;

        // Function to show/hide blur backdrop based on open modals
        function updateBlurBackdrop() {
            const blurBackdrop = document.querySelector('.modal-blur-backdrop');
            if (!blurBackdrop) return;

            if (openModalsCount > 0) {
                blurBackdrop.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                blurBackdrop.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        // Handle all project modals
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

        // Typewriter effect
        const texts = [
            "We specialize in comprehensive fire protection systems, while also providing expertise in architectural, civil, mechanical, electrical and plumbing services.",
            "Prevention is always better than recovery. That's why we focus on proactive fire protection you can trust every day.",
            "From concept to completion, every detail matters. We design with precision to ensure lasting quality and impact.",
            "Strong infrastructure creates smarter buildings. We install dependable auxiliary systems that enhance security and efficiency."
        ];

        const speed = 40;      // typing speed
        const eraseSpeed = 25; // erase speed
        const delayBetween = 1500; // delay before erase
        let textIndex = 0;
        let charIndex = 0;
        const typewriter = document.getElementById("typewriter");

        function type() {
            if (charIndex < texts[textIndex].length) {
                typewriter.textContent += texts[textIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, speed);
            } else {
                setTimeout(erase, delayBetween);
            }
        }

        function erase() {
            if (charIndex > 0) {
                typewriter.textContent = texts[textIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(erase, eraseSpeed);
            } else {
                textIndex++;
                if (textIndex >= texts.length) textIndex = 0;
                setTimeout(type, speed);
            }
        }

        // Start typewriter
        type();

        // View More/Less functionality for projects
        const viewMoreBtn = document.getElementById('viewMoreBtn');
        const viewLessBtn = document.getElementById('viewLessBtn');
        const projectsDropdown = document.getElementById('projectsDropdown');

        if (viewMoreBtn) {
            viewMoreBtn.addEventListener('click', function() {
                projectsDropdown.style.display = 'block';
                setTimeout(() => {
                    projectsDropdown.classList.add('dropdown-show');
                }, 10);
                viewMoreBtn.style.display = 'none';
            });
        }

        if (viewLessBtn) {
            viewLessBtn.addEventListener('click', function() {
                projectsDropdown.classList.remove('dropdown-show');
                setTimeout(() => {
                    projectsDropdown.style.display = 'none';
                    viewMoreBtn.style.display = 'inline-block';
                }, 500);
            });
        }

        // Pause carousels on hover
        document.querySelectorAll('.modal-carousel-container').forEach(container => {
            container.addEventListener('mouseenter', function() {
                this.querySelector('.modal-carousel-track').style.animationPlayState = 'paused';
            });
            container.addEventListener('mouseleave', function() {
                this.querySelector('.modal-carousel-track').style.animationPlayState = 'running';
            });
        });

        // Contact form submission with reCAPTCHA
        const contactForm = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitSpinner = document.getElementById('submitSpinner');

        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Check if reCAPTCHA is completed
                const recaptchaResponse = grecaptcha ? grecaptcha.getResponse() : '';

                if (!recaptchaResponse) {
                    document.querySelector('.recaptcha-feedback').style.display = 'block';
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Verification Required',
                        text: 'Please complete the reCAPTCHA verification.',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    return;
                } else {
                    document.querySelector('.recaptcha-feedback').style.display = 'none';
                }

                // Validate form
                const formData = new FormData(this);
                let isValid = true;

                this.querySelectorAll('input[required], textarea[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please fill in all required fields',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    return;
                }

                // Email validation
                const emailInput = this.querySelector('input[name="email"]');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailInput.value.trim())) {
                    emailInput.classList.add('is-invalid');
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a valid email address',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    return;
                }

                // Add reCAPTCHA response to form data
                formData.append('g-recaptcha-response', recaptchaResponse);

                // Show loading state
                Swal.fire({
                    title: 'Sending Message...',
                    text: 'Please wait while we send your message.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Disable submit button
                submitBtn.disabled = true;
                submitText.textContent = 'Sending...';
                submitSpinner.classList.remove('d-none');

                // Get CSRF token
                const token = document.querySelector('input[name="_token"]').value;

                // Send AJAX request
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 419) {
                            throw new Error('Session expired. Please refresh the page and try again.');
                        }
                        if (response.status === 422) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Validation failed');
                            });
                        }
                        return response.json().then(data => {
                            throw new Error(data.message || 'Server error occurred');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.close();

                    submitBtn.disabled = false;
                    submitText.textContent = 'Send Message';
                    submitSpinner.classList.add('d-none');

                    if (data.success) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: data.alert_title || 'Success!',
                            text: data.alert_message || data.message || 'Your message has been sent successfully.',
                            showConfirmButton: true,
                            timer: 5000
                        }).then(() => {
                            contactForm.reset();
                            // Reset reCAPTCHA
                            if (grecaptcha) {
                                grecaptcha.reset();
                            }
                        });
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.alert_title || 'Error!',
                            text: data.alert_message || data.message || 'Failed to send your message. Please try again.',
                            showConfirmButton: true
                        }).then(() => {
                            // Reset reCAPTCHA on error
                            if (grecaptcha) {
                                grecaptcha.reset();
                            }
                        });
                    }
                })
                .catch(error => {
                    Swal.close();

                    submitBtn.disabled = false;
                    submitText.textContent = 'Send Message';
                    submitSpinner.classList.add('d-none');

                    // Reset reCAPTCHA on error
                    if (grecaptcha) {
                        grecaptcha.reset();
                    }

                    let errorMessage = 'Failed to send your message. Please try again.';

                    if (error.message) {
                        errorMessage = error.message;
                    }

                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        showConfirmButton: true
                    });

                    console.error('Error:', error);
                });
            });

            // Real-time validation
            contactForm.querySelectorAll('input, textarea').forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });

                if (input.name === 'email') {
                    input.addEventListener('blur', function() {
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (this.value.trim() && !emailPattern.test(this.value.trim())) {
                            this.classList.add('is-invalid');
                        }
                    });
                }
            });
        }

        // Team carousel functionality
        const track = document.getElementById('teamCarouselTrack');
        if (track) {
            const teamMembersCount = {{ isset($teamMembers) ? $teamMembers->count() : 0 }};
            if (teamMembersCount > 0) {
                const cardWidth = 280;
                const gap = 30;
                const totalWidth = (cardWidth * teamMembersCount) + (gap * (teamMembersCount - 1));

                const style = document.createElement('style');
                style.innerHTML = `
                    @keyframes scrollTeam {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-${totalWidth}px); }
                    }
                `;
                document.head.appendChild(style);
            }
        }

        // Individual card pause on hover
        document.querySelectorAll('.team-member-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const track = this.closest('.team-carousel-track');
                if (track) {
                    track.style.animationPlayState = 'paused';
                }
            });

            card.addEventListener('mouseleave', function() {
                const track = this.closest('.team-carousel-track');
                if (track) {
                    track.style.animationPlayState = 'running';
                }
            });
        });

        // Simple scroll handler for homepage
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const hash = this.getAttribute('href');
                if (hash === '#') return;

                const element = document.querySelector(hash);
                if (element) {
                    const navbar = document.querySelector('.navbar');
                    const navbarHeight = navbar ? navbar.offsetHeight : 80;
                    const elementPosition = element.getBoundingClientRect().top + window.scrollY;
                    const offsetPosition = elementPosition - navbarHeight - 20;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without reload
                    history.pushState(null, null, hash);
                }
            });
        });

        // Check if URL has hash on page load
        if (window.location.hash) {
            const hash = window.location.hash;
            const element = document.querySelector(hash);

            if (element) {
                // Wait for page to fully load
                setTimeout(function() {
                    const navbar = document.querySelector('.navbar');
                    const navbarHeight = navbar ? navbar.offsetHeight : 80;
                    const elementPosition = element.getBoundingClientRect().top + window.scrollY;
                    const offsetPosition = elementPosition - navbarHeight - 20;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }, 500);
            }
        }

        // Office carousel - ensure proper animation
        const officeTrack = document.getElementById('officeCarouselTrack');
        if (officeTrack) {
            // Calculate total width for proper animation
            const cards = officeTrack.querySelectorAll('.carousel-card');
            if (cards.length > 0) {
                const cardWidth = cards[0].offsetWidth + 24; // width + gap
                const totalWidth = cardWidth * (cards.length / 2); // half because we duplicated for seamless loop

                // Add custom animation for this specific carousel if needed
                const style = document.createElement('style');
                style.innerHTML = `
                    #officeCarouselTrack {
                        animation: scrollOffice 30s linear infinite;
                    }
                    @keyframes scrollOffice {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-${totalWidth}px); }
                    }
                `;
                document.head.appendChild(style);
            }
        }
    });
    </script>
</body>
</html>
