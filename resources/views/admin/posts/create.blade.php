<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <!-- Favicon for browser tab - shows on all devices -->
    <link rel="icon" type="image/x-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}" />
    <!-- Apple Touch Icon for iOS devices when adding to home screen -->
    <link rel="apple-touch-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}">
    <!-- Microsoft Tiles for Windows -->
    <meta name="msapplication-TileImage" content="{{ asset('homepage/file/assets/faviconlogo.png') }}">
    <meta name="msapplication-TileColor" content="#084433">
    <!-- Theme color for mobile browser UI -->
    <meta name="theme-color" content="#084433">

    <title>Create New Post - Archtech Admin</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --archtech-primary: #084433;
            --archtech-secondary: #5DB996;
            --archtech-light: #118B50;
            --archtech-dark: #063325;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 0px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Mobile Header with Logo */
        .mobile-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            z-index: 998;
            padding: 0 15px;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .mobile-header-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-header-logo img {
            height: 40px;
            width: auto;
        }

        .mobile-header-logo span {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .mobile-header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .mobile-header-actions i {
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
        }

        /* Mobile Sidebar Toggle */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 999;
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            transform: scale(1.05);
        }

        .sidebar-toggle.active {
            left: calc(var(--sidebar-width) + 15px);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .admin-sidebar {
            background: linear-gradient(180deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
            width: var(--sidebar-width);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
            width: 100%;
        }

        /* Mobile Styles - EXACTLY like dashboard.blade.php */
        @media (max-width: 992px) {
            .mobile-header {
                display: flex;
            }

            .sidebar-toggle {
                display: flex;
                top: 10px;
                left: 10px;
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .admin-sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
                top: 60px;
                height: calc(100vh - 60px);
            }

            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
                padding: 20px 15px;
                padding-top: 80px;
            }

            .admin-main.sidebar-open {
                margin-left: 0;
            }

            .admin-header {
                padding: 15px;
                margin-top: 0;
            }

            .admin-header > div {
                flex-direction: column;
                gap: 15px;
            }

            .admin-header h1 {
                font-size: 1.5rem;
            }

            .btn-archtech, .btn-archtech-outline {
                width: 100%;
                text-align: center;
                margin: 5px 0;
            }

            .admin-user-info {
                padding: 10px;
            }

            .user-avatar {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .btn-group {
                flex-direction: row;
                justify-content: flex-start;
            }

            .btn-group a, .btn-group button {
                flex: 1;
                text-align: center;
                padding: 8px;
            }

            .no-posts {
                padding: 30px 15px;
            }

            .no-posts i {
                font-size: 3rem;
            }

            .no-posts h3 {
                font-size: 1.3rem;
            }

            .alert {
                padding: 12px;
                font-size: 0.95rem;
            }

            .admin-header > div {
                text-align: center;
            }

            .admin-header .text-muted {
                display: inline-block;
                margin-bottom: 10px;
            }

            .btn-archtech {
                width: 100%;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .mobile-header-logo span {
                display: none;
            }

            .mobile-header-logo img {
                height: 35px;
            }

            .admin-main {
                padding: 15px 10px;
                padding-top: 75px;
            }

            .admin-header {
                padding: 12px;
            }

            .admin-header h1 {
                font-size: 1.3rem;
            }

            .admin-header p {
                font-size: 0.9rem;
            }

            .admin-header .text-muted {
                display: block;
                margin-bottom: 10px;
            }

            .filters {
                padding: 15px;
            }

            .filter-select, .search-input, .search-btn {
                padding: 8px 12px;
                font-size: 0.95rem;
            }

            .badge {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .btn-group a, .btn-group button {
                padding: 6px;
                font-size: 0.85rem;
            }

            .admin-user-info .user-name,
            .admin-user-info small {
                display: none;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                margin-bottom: 0;
            }

            .brand-options {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }

            .category-options-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            }
        }

        /* Rest of your existing styles remain the same */
        .admin-header {
            background: white;
            padding: 20px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-left: 4px solid var(--archtech-primary);
        }

        .btn-archtech {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-archtech:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3);
        }

        .btn-archtech-outline {
            background: transparent;
            color: var(--archtech-primary);
            border: 2px solid var(--archtech-primary);
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-archtech-outline:hover {
            background: var(--archtech-primary);
            color: white;
            transform: translateY(-2px);
        }

        .admin-logo {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
        }

        .admin-logo img {
            height: 60px;
            max-width: 100%;
        }

        .sidebar-nav {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar-nav-inner {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nav-main {
            flex: 1;
        }

        .nav-link-admin {
            color: rgba(255, 255, 255, 0.8);
            padding: 15px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            position: relative;
        }

        .nav-link-admin:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }

        .nav-link-admin.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--archtech-secondary);
        }

        .admin-user-info {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            flex-shrink: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 2px rgba(93, 185, 150, 0.5);
        }

        .user-name {
            color: white;
            font-weight: 600;
            margin-bottom: 3px;
            word-break: break-word;
        }

        .logout-form {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 15px;
            padding-bottom: 5px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 3px 0;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
        }

        .logout-btn:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        /* Admin Cards */
        .admin-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(8, 68, 51, 0.1);
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .admin-card-header {
            border-bottom: 2px solid rgba(8, 68, 51, 0.1);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .admin-card-title {
            color: var(--archtech-primary);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        /* Form Controls */
        .form-control {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px 15px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--archtech-primary);
            box-shadow: 0 0 0 0.2rem rgba(8, 68, 51, 0.25);
            outline: none;
        }

        .form-select {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px 15px;
            width: 100%;
            background-color: white;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            border-color: var(--archtech-primary);
            box-shadow: 0 0 0 0.2rem rgba(8, 68, 51, 0.25);
            outline: none;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-label {
            font-weight: 600;
            color: var(--archtech-primary);
            margin-bottom: 8px;
            display: block;
        }

        .form-check {
            margin-bottom: 10px;
            padding-left: 0;
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
            margin-top: 0;
        }

        .form-check-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.875rem;
        }

        /* Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-lg-8, .col-lg-4 {
            padding-right: 15px;
            padding-left: 15px;
            box-sizing: border-box;
        }

        .col-lg-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .d-grid {
            display: grid;
        }

        .gap-2 {
            gap: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .me-2 {
            margin-right: 10px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-success {
            background: #198754;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #212529;
        }

        .badge-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 5px;
        }

        .btn-group a, .btn-group button {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
            border: 1px solid;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-group a:hover, .btn-group button:hover {
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        .btn-outline-primary:hover {
            background: #0d6efd;
            color: white;
        }

        .btn-outline-success {
            border-color: #198754;
            color: #198754;
        }

        .btn-outline-success:hover {
            background: #198754;
            color: white;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Category-Brand relationship styling */
        .category-brand-relationship {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            background: #f8f9fa;
            margin-bottom: 20px;
        }

        .brand-section {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 3px solid var(--archtech-primary);
        }

        .brand-section.active {
            display: block;
        }

        .brand-sub-section {
            margin-top: 15px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 3px solid var(--archtech-light);
            display: none;
        }

        .brand-sub-section.active {
            display: block;
        }

        .brand-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .brand-option {
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .brand-option:hover {
            background: #e9ecef;
            border-color: var(--archtech-primary);
        }

        .brand-option.selected {
            background: var(--archtech-primary);
            color: white;
            border-color: var(--archtech-primary);
        }

        .category-selection-section {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 3px solid var(--archtech-primary);
        }

        .category-selection-section.active {
            display: block;
        }

        .category-options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .category-option-item {
            padding: 12px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            background: #f8f9fa;
            font-weight: 500;
        }

        .category-option-item:hover {
            background: #e9ecef;
            border-color: var(--archtech-primary);
        }

        .category-option-item.selected {
            background: var(--archtech-primary);
            color: white;
            border-color: var(--archtech-primary);
        }

        .category-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .category-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .category-item:hover {
            border-color: var(--archtech-primary);
            background: rgba(8, 68, 51, 0.02);
        }

        .category-item input[type="radio"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
        }

        .category-name {
            font-weight: 500;
            color: var(--archtech-primary);
        }

        .status-options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .status-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            transition: all 0.2s ease;
        }

        .status-item:hover {
            border-color: var(--archtech-primary);
            background: rgba(8, 68, 51, 0.02);
        }

        .status-item input[type="radio"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
        }

        .status-name {
            font-weight: 500;
            color: var(--archtech-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-note {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 5px;
            font-style: italic;
        }

        /* Main category header style for nested categories */
        .main-category-header {
            grid-column: 1 / -1;
            font-weight: bold;
            color: var(--archtech-primary);
            margin-top: 10px;
            margin-bottom: 5px;
            padding: 8px;
            background: #e9ecef;
            border-radius: 5px;
            font-size: 1.1rem;
            border-left: 3px solid var(--archtech-primary);
        }

        .subcategory {
            margin-left: 15px;
            font-size: 0.95em;
            background: #ffffff;
            border-left: 2px solid var(--archtech-light);
        }

        /* SweetAlert2 Mobile Styles */
        @media (max-width: 480px) {
            .swal2-popup {
                font-size: 0.9rem !important;
                padding: 15px !important;
                width: 90% !important;
            }

            .swal2-title {
                font-size: 1.3rem !important;
            }

            .swal2-actions {
                flex-direction: column !important;
                gap: 10px !important;
            }

            .swal2-actions button {
                width: 100% !important;
                margin: 0 !important;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Header with Logo - EXACTLY like dashboard.blade.php -->
    <div class="mobile-header">
        <div class="mobile-header-logo">
            <img src="{{ asset('homepage/file/assets/faviconlogo.png') }}" alt="Archtech">
            <span>Archtech Admin</span>
        </div>
        <div class="mobile-header-actions">
            <i class="fas fa-search" id="mobileSearchToggle"></i>
            <i class="fas fa-user-circle" id="mobileUserMenu"></i>
        </div>
    </div>

    <!-- Mobile Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-container">
        <!-- Sidebar - EXACTLY like dashboard.blade.php -->
        <div class="admin-sidebar" id="adminSidebar">
            <div class="admin-logo">
                <a href="{{ route('admin.dashboard') }}" class="d-block">
                    <img src="{{ asset('homepage/file/assets/img/navbar-logo.png') }}" alt="Archtech Admin">
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-nav-inner">
                    <div class="nav-main">
                        <a class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>

                        <a class="nav-link-admin {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Blog Posts</span>
                        </a>
                            <!-- NEW: Projects Menu Item - Just below Blog Posts -->
                        <a class="nav-link-admin {{ request()->routeIs('admin.projects.*') && !request()->routeIs('admin.projects.trash') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                            <i class="fas fa-project-diagram"></i>
                            <span>Projects</span>
                        </a>
                        <a class="nav-link-admin {{ request()->routeIs('admin.team.*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Team Members</span>
                        </a>

                        <a class="nav-link-admin {{ request()->routeIs('admin.posts.trash') ? 'active' : '' }}" href="{{ route('admin.posts.trash') }}">
                            <i class="fas fa-trash"></i>
                            <span>Recently Deleted</span>
                        </a>
                        <a class="nav-link-admin {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </div>

                    <div class="logout-form">
                        <a class="nav-link-admin" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            <span>View Website</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="admin-user-info">
                <a href="{{ route('admin.settings') }}" class="d-block" style="text-decoration: none;">
                    <div class="user-avatar" id="sidebar-avatar" style="background-image: url('{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '' }}')">
                        @if(!Auth::user()->profile_picture)
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                </a>

                <div style="margin-top: 5px;">
                    <div class="user-name">
                        {{ Auth::user()->name }}
                    </div>
                    <small style="color: rgba(255, 255, 255, 0.7); display: block; margin-top: 2px;">
                        {{ Auth::user()->position ?? 'No position set' }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="admin-main" id="adminMain">
            <!-- Header -->
            <div class="admin-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="color: #084433; margin: 0 0 5px 0;">Create New Post</h1>
                        <p class="text-muted" style="margin: 0;">Create engaging content for your blog</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ now()->format('F j, Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="admin-card">
                <div class="admin-card-header mb-4">
                    <h3 class="admin-card-title">
                        <i class="fas fa-plus-circle me-2"></i>Post Details
                    </h3>
                </div>

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Post Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    Post Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}"
                                       placeholder="Enter post title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category & Brand Selection -->
                            <div class="category-brand-relationship mb-4">
                                <h4 class="form-label mb-3">Category & Brand</h4>

                                <!-- Category Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Select Category <span class="text-danger">*</span></label>
                                    <div class="category-options">
                                        @foreach(['Fire Protection', 'Mechanical', 'Electrical', 'Material Handling', 'Tools and Lifting Equipment', 'Auxilliary'] as $category)
                                        <div class="category-item">
                                            <input class="form-check-input category-radio" type="radio"
                                                   name="category" value="{{ $category }}"
                                                   id="cat{{ $loop->index }}"
                                                   data-category="{{ strtolower(str_replace(' ', '_', $category)) }}"
                                                   {{ old('category') == $category ? 'checked' : '' }}>
                                            <label class="category-name" for="cat{{ $loop->index }}">
                                                {{ $category }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('category')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Fire Protection Brand Selection -->
                                <div id="fireProtectionBrands" class="brand-section">
                                    <label class="form-label">Fire Protection Brands <span class="text-danger">*</span></label>
                                    <div class="brand-options">
                                        @php
                                            $fireProtectionBrands = [
                                                'HD Fire' => [
                                                    'Alarm Valve',
                                                    'Flexible Sprinkler Drops',
                                                    'Water Spray Nozzle',
                                                    'Custom Engineered Systems',
                                                    'Foam Equipment & Device',
                                                    'Foam Proportioning Systems',
                                                    'Deluge Valves & Systems',
                                                    'Foam Concentrates',
                                                    'Pre Action Fire Protection',
                                                    'Sprinklers & Accessories'
                                                ],
                                                'Kidde' => [
                                                    'Gaseous Suppression - Clean Agent',
                                                    'Detection & Control System',
                                                    'Room Integrity Test',
                                                    'Water Suppression System'
                                                ],
                                                'Buckeye' => [
                                                    'Fire Extinguishers',
                                                    'Fire Suppression Systems'
                                                ],
                                                'Lehavot' => [
                                                    'Fire Extinguishers',
                                                    'Fire Suppression Equipment'
                                                ],
                                                'Nittan' => [
                                                    'Fire Detectors',
                                                    'Fire Alarm Systems'
                                                ],
                                                'Honeywell' => [
                                                    'Fire Alarm Systems',
                                                    'Gas Detection',
                                                    'Fire Suppression'
                                                ],
                                                'Protectowire' => [
                                                    'Linear Heat Detection',
                                                    'Fire Alarm Systems'
                                                ],
                                                'Bristol' => [
                                                    'Fire Alarm Equipment'
                                                ],
                                                'Eaton' => [
                                                    'Fire Pumps',
                                                    'Electrical Fire Protection'
                                                ],
                                                'Pentair' => [
                                                    'End Suction Pumps',
                                                    'In-Line Pumps',
                                                    'Split Case Pumps',
                                                    'Vertical Multi-Stage Pumps',
                                                    'Vertical Turbine Pumps',
                                                    'End Suction Fire Pumps',
                                                    'Split Case Fire Pumps',
                                                    'Vertical Turbine Fire Pumps'
                                                ],
                                                'Ansul' => [
                                                    'Fire Suppression Systems',
                                                    'Fire Extinguishers'
                                                ],
                                                'Amerex' => [
                                                    'Fire Extinguishers',
                                                    'Fire Suppression'
                                                ],
                                                'Tyco' => [
                                                    'Fire Sprinklers',
                                                    'Fire Suppression Systems'
                                                ],
                                                'Rotarex' => [
                                                    'Gas Control Equipment',
                                                    'Fire Suppression'
                                                ],
                                                'Viking' => [
                                                    'Fire Sprinkler' => [
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
                                                    'Valves & Systems' => [
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
                                                    'Foam Systems' => [
                                                        'High Expansion Foam Systems',
                                                        'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
                                                        'Shared Foam System Components',
                                                        'View All Foam Products'
                                                    ],
                                                    'Special Hazards' => [
                                                        'Oxeo Clean Agent Extinguishing System',
                                                        'Ignitable Liquid Storage Protection',
                                                        'View All Special Hazards'
                                                    ],
                                                    'Piping Systems' => [
                                                        'BlazeMaster® CPVC Pipe & Fittings',
                                                        'InstaSeal® Welded Outlet Systems',
                                                        'View All Piping Systems'
                                                    ],
                                                    'Electricals' => [
                                                        'Release Control Panels',
                                                        'Detection and Control Solutions',
                                                        'View All Electrical Products'
                                                    ]
                                                ]
                                            ];
                                        @endphp

                                        @foreach($fireProtectionBrands as $brand => $categories)
                                        <div class="brand-option"
                                             data-value="{{ $brand }}"
                                             data-categories='@json($categories)'>
                                            {{ $brand }}
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="fireProtectionCategories" class="category-selection-section" style="display: none; margin-top: 15px;">
                                        <label class="form-label">Product Category <span class="text-danger">*</span></label>
                                        <p class="brand-note">Select a product category. This will be added to tags.</p>
                                        <div class="category-options-grid" id="fireProtectionCategoryOptions">
                                            <!-- Categories will be populated here based on brand selection -->
                                        </div>
                                        <input type="hidden" id="selectedFireProtectionCategory" name="fire_protection_category" value="{{ old('fire_protection_category') }}">
                                    </div>
                                </div>

                                <!-- Mechanical Category Selection -->
                                <div id="mechanicalCategories" class="category-selection-section">
                                    <label class="form-label">Mechanical Product Category <span class="text-danger">*</span></label>
                                    <p class="brand-note">Select the product category. This will automatically fill the tags field.</p>
                                    <div class="category-options-grid">
                                        <div class="category-option-item" data-value="Fuel tanks" data-category-type="mechanical">
                                            Fuel Tanks
                                        </div>
                                        <div class="category-option-item" data-value="Fire pumps" data-category-type="mechanical">
                                            Fire Pumps
                                        </div>
                                        <div class="category-option-item" data-value="Pumps group" data-category-type="mechanical">
                                            Pumps Group
                                        </div>
                                        <div class="category-option-item" data-value="Diesel engines" data-category-type="mechanical">
                                            Diesel Engines
                                        </div>
                                        <div class="category-option-item" data-value="Accessories" data-category-type="mechanical">
                                            Accessories
                                        </div>
                                    </div>
                                    <input type="hidden" id="selectedMechanicalCategory" name="mechanical_category" value="{{ old('mechanical_category') }}">
                                    @error('mechanical_category')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Electrical Category Selection -->
                                <div id="electricalCategories" class="category-selection-section">
                                    <label class="form-label">Electrical Product Category <span class="text-danger">*</span></label>
                                    <p class="brand-note">Select the product category. This will automatically fill the tags field.</p>
                                    <div class="category-options-grid">
                                        <div class="category-option-item" data-value="Clamp Meters" data-category-type="electrical">
                                            Clamp Meters
                                        </div>
                                        <div class="category-option-item" data-value="Digital Multimeters" data-category-type="electrical">
                                            Digital Multimeters
                                        </div>
                                        <div class="category-option-item" data-value="Electrical Testers" data-category-type="electrical">
                                            Electrical Testers
                                        </div>
                                        <div class="category-option-item" data-value="Power Factor Controllers" data-category-type="electrical">
                                            Power Factor Controllers
                                        </div>
                                        <div class="category-option-item" data-value="Harmonic Filters" data-category-type="electrical">
                                            Harmonic Filters
                                        </div>
                                    </div>
                                    <input type="hidden" id="selectedElectricalCategory" name="electrical_category" value="{{ old('electrical_category') }}">
                                    @error('electrical_category')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Material Handling Category Selection -->
                                <div id="materialHandlingCategories" class="category-selection-section">
                                    <label class="form-label">Material Handling Product Category <span class="text-danger">*</span></label>
                                    <p class="brand-note">Select the product category. This will automatically fill the tags field.</p>
                                    <div class="category-options-grid">
                                        <div class="category-option-item" data-value="Forklifts" data-category-type="material_handling">
                                            Forklifts
                                        </div>
                                        <div class="category-option-item" data-value="Pallet Trucks" data-category-type="material_handling">
                                            Pallet Trucks
                                        </div>
                                        <div class="category-option-item" data-value="Pallet Jacks" data-category-type="material_handling">
                                            Pallet Jacks
                                        </div>
                                        <div class="category-option-item" data-value="Reach Trucks" data-category-type="material_handling">
                                            Reach Trucks
                                        </div>
                                        <div class="category-option-item" data-value="Order Pickers" data-category-type="material_handling">
                                            Order Pickers
                                        </div>
                                        <div class="category-option-item" data-value="Lifting Jacks" data-category-type="material_handling">
                                            Lifting Jacks
                                        </div>
                                        <div class="category-option-item" data-value="Offshore & Marine" data-category-type="material_handling">
                                            Offshore & Marine
                                        </div>
                                        <div class="category-option-item" data-value="PPE" data-category-type="material_handling">
                                            PPE
                                        </div>
                                        <div class="category-option-item" data-value="Shelving Systems" data-category-type="material_handling">
                                            Shelving Systems
                                        </div>
                                        <div class="category-option-item" data-value="Racking Systems" data-category-type="material_handling">
                                            Racking Systems
                                        </div>
                                        <div class="category-option-item" data-value="Material Handling Equipment" data-category-type="material_handling">
                                            General Equipment
                                        </div>
                                    </div>
                                    <input type="hidden" id="selectedMaterialHandlingCategory" name="material_handling_category" value="{{ old('material_handling_category') }}">
                                    @error('material_handling_category')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tools & Lifting Category Selection -->
                                <div id="toolsLiftingCategories" class="category-selection-section">
                                    <label class="form-label">Tools & Lifting Product Category <span class="text-danger">*</span></label>
                                    <p class="brand-note">Select the product category. This will automatically fill the tags field.</p>
                                    <div class="category-options-grid">
                                        <div class="category-option-item" data-value="Power Tools" data-category-type="tools_lifting">
                                            Power Tools
                                        </div>
                                        <div class="category-option-item" data-value="Hand Tools" data-category-type="tools_lifting">
                                            Hand Tools
                                        </div>
                                        <div class="category-option-item" data-value="Lifting Equipment" data-category-type="tools_lifting">
                                            Lifting Equipment
                                        </div>
                                        <div class="category-option-item" data-value="Lifting Shackles" data-category-type="tools_lifting">
                                            Lifting Shackles
                                        </div>
                                        <div class="category-option-item" data-value="Webbing Sling" data-category-type="tools_lifting">
                                            Webbing Sling
                                        </div>
                                        <div class="category-option-item" data-value="Concrete & Masonry" data-category-type="tools_lifting">
                                            Concrete & Masonry
                                        </div>
                                        <div class="category-option-item" data-value="Grinders" data-category-type="tools_lifting">
                                            Grinders
                                        </div>
                                        <div class="category-option-item" data-value="Drills" data-category-type="tools_lifting">
                                            Drills
                                        </div>
                                        <div class="category-option-item" data-value="Saws" data-category-type="tools_lifting">
                                            Saws
                                        </div>
                                        <div class="category-option-item" data-value="Sanders" data-category-type="tools_lifting">
                                            Sanders
                                        </div>
                                        <div class="category-option-item" data-value="Socket & Sets" data-category-type="tools_lifting">
                                            Socket & Sets
                                        </div>
                                        <div class="category-option-item" data-value="Cutting Tools" data-category-type="tools_lifting">
                                            Cutting Tools
                                        </div>
                                        <div class="category-option-item" data-value="PPE" data-category-type="tools_lifting">
                                            PPE
                                        </div>
                                        <div class="category-option-item" data-value="Tools & Equipment" data-category-type="tools_lifting">
                                            General Equipment
                                        </div>
                                    </div>
                                    <input type="hidden" id="selectedToolsLiftingCategory" name="tools_lifting_category" value="{{ old('tools_lifting_category') }}">
                                    @error('tools_lifting_category')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Auxiliary Brand Selection -->
                                <div id="auxiliaryBrands" class="brand-section">
                                    <label class="form-label">Auxiliary Brands <span class="text-danger">*</span></label>

                                    <!-- Auxiliary Category Selection -->
                                    <div class="mb-3">
                                        <label class="form-label">Select Auxiliary Category</label>
                                        <div class="category-options">
                                            <div class="category-item">
                                                <input class="form-check-input auxiliary-category-radio" type="radio"
                                                       name="auxiliary_category" value="cctv"
                                                       id="auxCatCCTV"
                                                       data-category="cctv"
                                                       {{ old('auxiliary_category') == 'cctv' ? 'checked' : '' }}>
                                                <label class="category-name" for="auxCatCCTV">
                                                    CCTV Brands
                                                </label>
                                            </div>
                                            <div class="category-item">
                                                <input class="form-check-input auxiliary-category-radio" type="radio"
                                                       name="auxiliary_category" value="access_control"
                                                       id="auxCatAccessControl"
                                                       data-category="access_control"
                                                       {{ old('auxiliary_category') == 'access_control' ? 'checked' : '' }}>
                                                <label class="category-name" for="auxCatAccessControl">
                                                    Access Control Brands
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CCTV Brands -->
                                    <div id="cctvBrands" class="brand-sub-section">
                                        <label class="form-label">CCTV Brands</label>
                                        <div class="brand-options">
                                            @foreach(['Dahua'] as $brand)
                                            <div class="brand-option" data-value="{{ $brand }}" data-categories='["CCTV Cameras", "DVRs", "NVRs", "CCTV Accessories"]'>
                                                {{ $brand }}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Access Control Brands -->
                                    <div id="accessControlBrands" class="brand-sub-section">
                                        <label class="form-label">Access Control Brands</label>
                                        <div class="brand-options">
                                            @foreach([
                                                'Zkteco' => ['Access Control Systems', 'Biometric Readers', 'Time Attendance', 'Access Control Accessories'],
                                                'HID Global' => ['Access Control Readers', 'Access Control Cards', 'Access Control Software'],
                                                'Honeywell' => ['Access Control Panels', 'Access Control Readers', 'Security Management'],
                                                'HIKVision' => ['Access Control Systems', 'Video Intercom', 'Access Control Readers']
                                            ] as $brand => $categories)
                                            <div class="brand-option"
                                                 data-value="{{ $brand }}"
                                                 data-categories='@json($categories)'>
                                                {{ $brand }}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden input for brand selection -->
                                <input type="hidden" id="selectedBrand" name="brand" value="{{ old('brand') }}">

                                @error('brand')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-4">
                                <label for="content" class="form-label">
                                    Content <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('content') is-invalid @enderror"
                                          id="content" name="content" rows="10"
                                          placeholder="Write your post content here..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Name -->
                            <div class="mb-4">
                                <label for="product_name" class="form-label">
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                       id="product_name" name="product_name"
                                       value="{{ old('product_name') }}"
                                       placeholder="Enter product name" required>
                                @error('product_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Name of the product featured in this post.</small>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Publish Status -->
                            <div class="admin-card mb-4">
                                <div class="admin-card-header">
                                    <h4 class="admin-card-title mb-0">
                                        <i class="fas fa-paper-plane me-2"></i>Publish
                                    </h4>
                                </div>
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="status-options">
                                            <div class="status-item">
                                                <input class="form-check-input" type="radio" name="is_published"
                                                       id="statusDraft" value="0" checked>
                                                <label class="status-name" for="statusDraft">
                                                    <i class="fas fa-save"></i>
                                                    Save as Draft
                                                </label>
                                            </div>
                                            <div class="status-item">
                                                <input class="form-check-input" type="radio" name="is_published"
                                                       id="statusPublished" value="1">
                                                <label class="status-name" for="statusPublished">
                                                    <i class="fas fa-check-circle"></i>
                                                    Publish
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Publish Date -->
                                    <div class="mb-3">
                                        <label for="published_at" class="form-label">Publish Date</label>
                                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                                               id="published_at" name="published_at"
                                               value="{{ old('published_at') }}">
                                        @error('published_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Leave blank to publish immediately or schedule for future.</small>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn-archtech">
                                            <i class="fas fa-paper-plane me-2"></i>Create Post
                                        </button>
                                        <button type="submit" name="draft" value="1" class="btn-archtech-outline">
                                            <i class="fas fa-save me-2"></i>Save Draft
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="admin-card mb-4">
                                <div class="admin-card-header">
                                    <h4 class="admin-card-title mb-0">
                                        <i class="fas fa-image me-2"></i>Featured Image
                                    </h4>
                                </div>
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label for="featured_image" class="form-label">Upload Image</label>
                                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                               id="featured_image" name="featured_image"
                                               accept="image/*">
                                        @error('featured_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="imagePreview" class="text-center mt-3" style="display: none;">
                                        <img id="previewImage" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                    <small class="text-muted">Recommended size: 1200x630px. Max file size: 2MB.</small>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="admin-card">
                                <div class="admin-card-header">
                                    <h4 class="admin-card-title mb-0">
                                        <i class="fas fa-tags me-2"></i>Tags
                                    </h4>
                                </div>
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tags <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                               id="tagsInput" name="tags" placeholder="Enter tags separated by commas"
                                               value="{{ old('tags') }}" required>
                                        @error('tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">For Mechanical, Electrical, Material Handling, Tools & Lifting, and Auxiliary products, the category will be auto-filled as the first tag.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar Functionality - EXACTLY like dashboard.blade.php
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('adminMain');
            const mobileSearchToggle = document.getElementById('mobileSearchToggle');
            const mobileUserMenu = document.getElementById('mobileUserMenu');

            function closeSidebar() {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
                sidebarToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            function openSidebar() {
                sidebar.classList.add('mobile-open');
                overlay.classList.add('active');
                sidebarToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (sidebar.classList.contains('mobile-open')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Mobile header actions
            if (mobileSearchToggle) {
                mobileSearchToggle.addEventListener('click', function() {
                    // You can implement search functionality here
                    console.log('Search clicked');
                });
            }

            if (mobileUserMenu) {
                mobileUserMenu.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        openSidebar();
                    } else {
                        window.location.href = "{{ route('admin.settings') }}";
                    }
                });
            }

            // Close sidebar when clicking on a nav link (mobile)
            const navLinks = document.querySelectorAll('.nav-link-admin');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    closeSidebar();
                    document.body.style.overflow = '';
                }
            });

            // Prevent closing when clicking inside sidebar
            sidebar.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Active link highlighting
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link-admin').forEach(link => {
                if (link.getAttribute('href') === currentPath ||
                    link.href.includes(currentPath) && currentPath !== '/') {
                    link.classList.add('active');
                }
            });

            // Auto-dismiss alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Category and brand selection logic
            const categoryRadios = document.querySelectorAll('.category-radio');
            const auxiliaryCategoryRadios = document.querySelectorAll('.auxiliary-category-radio');
            const brandOptions = document.querySelectorAll('.brand-option');
            const brandSections = document.querySelectorAll('.brand-section');
            const brandSubSections = document.querySelectorAll('.brand-sub-section');

            // Fire Protection elements
            const fireProtectionCategoriesSection = document.getElementById('fireProtectionCategories');
            const fireProtectionCategoryOptions = document.getElementById('fireProtectionCategoryOptions');
            const selectedFireProtectionCategoryInput = document.getElementById('selectedFireProtectionCategory');

            // Mechanical elements
            const mechanicalCategorySection = document.getElementById('mechanicalCategories');
            const mechanicalCategoryOptions = document.querySelectorAll('#mechanicalCategories .category-option-item');
            const selectedMechanicalCategoryInput = document.getElementById('selectedMechanicalCategory');

            // Electrical elements
            const electricalCategorySection = document.getElementById('electricalCategories');
            const electricalCategoryOptions = document.querySelectorAll('#electricalCategories .category-option-item');
            const selectedElectricalCategoryInput = document.getElementById('selectedElectricalCategory');

            // Material Handling elements
            const materialHandlingCategorySection = document.getElementById('materialHandlingCategories');
            const materialHandlingCategoryOptions = document.querySelectorAll('#materialHandlingCategories .category-option-item');
            const selectedMaterialHandlingCategoryInput = document.getElementById('selectedMaterialHandlingCategory');

            // Tools & Lifting elements
            const toolsLiftingCategorySection = document.getElementById('toolsLiftingCategories');
            const toolsLiftingCategoryOptions = document.querySelectorAll('#toolsLiftingCategories .category-option-item');
            const selectedToolsLiftingCategoryInput = document.getElementById('selectedToolsLiftingCategory');

            // Tags input
            const tagsInput = document.getElementById('tagsInput');

            // Function to update tags with category
            function updateTagsWithCategory(category, categoryType) {
                if (!tagsInput) return;

                let currentTags = tagsInput.value;
                let tagsArray = currentTags.split(',').map(tag => tag.trim());

                const mechanicalCategories = ['Fuel tanks', 'Fire pumps', 'Pumps group', 'Diesel engines', 'Accessories'];
                const electricalCategories = ['Clamp Meters', 'Digital Multimeters', 'Electrical Testers', 'Power Factor Controllers', 'Harmonic Filters'];
                const materialHandlingCategories = [
                    'Forklifts', 'Pallet Trucks', 'Pallet Jacks', 'Reach Trucks', 'Order Pickers',
                    'Lifting Jacks', 'Offshore & Marine', 'PPE', 'Shelving Systems', 'Racking Systems', 'Material Handling Equipment'
                ];
                const toolsLiftingCategories = [
                    'Power Tools', 'Hand Tools', 'Lifting Equipment', 'Lifting Shackles', 'Webbing Sling',
                    'Concrete & Masonry', 'Grinders', 'Drills', 'Saws', 'Sanders', 'Socket & Sets',
                    'Cutting Tools', 'PPE', 'Tools & Equipment'
                ];
                const auxiliaryCategories = ['CCTV', 'Access Control'];
                const fireProtectionCategories = [
                    'Alarm Valve', 'Flexible Sprinkler Drops', 'Water Spray Nozzle', 'Custom Engineered Systems',
                    'Foam Equipment & Device', 'Foam Proportioning Systems', 'Deluge Valves & Systems',
                    'Foam Concentrates', 'Pre Action Fire Protection', 'Sprinklers & Accessories',
                    'Gaseous Suppression - Clean Agent', 'Detection & Control System', 'Room Integrity Test', 'Water Suppression System',
                    'Fire Extinguishers', 'Fire Suppression Systems', 'Fire Detectors', 'Fire Alarm Systems',
                    'Gas Detection', 'Linear Heat Detection', 'Fire Pumps', 'End Suction Pumps', 'In-Line Pumps',
                    'Split Case Pumps', 'Vertical Multi-Stage Pumps', 'Vertical Turbine Pumps', 'End Suction Fire Pumps',
                    'Split Case Fire Pumps', 'Vertical Turbine Fire Pumps', 'CCTV Cameras', 'DVRs', 'NVRs',
                    'CCTV Accessories', 'Access Control Systems', 'Biometric Readers', 'Time Attendance',
                    'Access Control Accessories', 'Access Control Readers', 'Access Control Cards',
                    'Access Control Software', 'Access Control Panels', 'Security Management', 'Video Intercom',

                    // Viking Main Categories
                    'Fire Sprinkler', 'Valves & Systems', 'Foam Systems', 'Special Hazards', 'Piping Systems', 'Electricals',

                    // Viking Subcategories
                    'Standard Coverage - Standard Response', 'Standard Coverage - Quick Response', 'Extended Coverage Sprinklers',
                    'Storage Sprinklers', 'Special Sprinklers', 'Residential Sprinklers', 'Dry Barrel Sprinklers',
                    'Sprinkler Accessories', 'Spray Nozzles', 'View All Sprinklers',
                    'EasyPac Riser Assemblies', 'Wet Pipe Systems', 'Dry Pipe Systems', 'Deluge & Preaction Systems',
                    'Data Center Upgradeable Systems', 'Flow Control & Pressure Regulation', 'Firecycle® Systems',
                    'Accessories', 'View All Valves & Systems',
                    'High Expansion Foam Systems', 'Low Expansion Synthetic Fluorine Free Foam (SFFF) Systems',
                    'Shared Foam System Components', 'View All Foam Products',
                    'Oxeo Clean Agent Extinguishing System', 'Ignitable Liquid Storage Protection', 'View All Special Hazards',
                    'BlazeMaster® CPVC Pipe & Fittings', 'InstaSeal® Welded Outlet Systems', 'View All Piping Systems',
                    'Release Control Panels', 'Detection and Control Solutions', 'View All Electrical Products'
                ];

                if (categoryType === 'mechanical') {
                    tagsArray = tagsArray.filter(tag => !mechanicalCategories.includes(tag) && !fireProtectionCategories.includes(tag));
                } else if (categoryType === 'electrical') {
                    tagsArray = tagsArray.filter(tag => !electricalCategories.includes(tag) && !fireProtectionCategories.includes(tag));
                } else if (categoryType === 'material_handling') {
                    tagsArray = tagsArray.filter(tag => !materialHandlingCategories.includes(tag) && !fireProtectionCategories.includes(tag));
                } else if (categoryType === 'tools_lifting') {
                    tagsArray = tagsArray.filter(tag => !toolsLiftingCategories.includes(tag) && !fireProtectionCategories.includes(tag));
                } else if (categoryType === 'auxiliary') {
                    tagsArray = tagsArray.filter(tag => !auxiliaryCategories.includes(tag) && !fireProtectionCategories.includes(tag));
                } else if (categoryType === 'fire_protection') {
                    tagsArray = tagsArray.filter(tag => !fireProtectionCategories.includes(tag));
                }

                if (category && category.trim() !== '') {
                    tagsArray.unshift(category);
                }

                tagsInput.value = tagsArray.join(', ');
            }

            // Handle main category selection
            categoryRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    brandSections.forEach(section => {
                        section.classList.remove('active');
                    });

                    brandSubSections.forEach(section => {
                        section.style.display = 'none';
                    });

                    if (fireProtectionCategoriesSection) {
                        fireProtectionCategoriesSection.style.display = 'none';
                    }
                    if (mechanicalCategorySection) {
                        mechanicalCategorySection.classList.remove('active');
                    }
                    if (electricalCategorySection) {
                        electricalCategorySection.classList.remove('active');
                    }
                    if (materialHandlingCategorySection) {
                        materialHandlingCategorySection.classList.remove('active');
                    }
                    if (toolsLiftingCategorySection) {
                        toolsLiftingCategorySection.classList.remove('active');
                    }

                    document.getElementById('selectedBrand').value = '';

                    document.querySelectorAll('.brand-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    document.querySelectorAll('.category-option-item').forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    if (selectedFireProtectionCategoryInput) selectedFireProtectionCategoryInput.value = '';
                    if (selectedMechanicalCategoryInput) selectedMechanicalCategoryInput.value = '';
                    if (selectedElectricalCategoryInput) selectedElectricalCategoryInput.value = '';
                    if (selectedMaterialHandlingCategoryInput) selectedMaterialHandlingCategoryInput.value = '';
                    if (selectedToolsLiftingCategoryInput) selectedToolsLiftingCategoryInput.value = '';

                    auxiliaryCategoryRadios.forEach(radio => {
                        radio.checked = false;
                    });

                    const category = this.dataset.category;
                    if (category === 'fire_protection') {
                        document.getElementById('fireProtectionBrands').classList.add('active');
                    } else if (category === 'mechanical') {
                        if (mechanicalCategorySection) {
                            mechanicalCategorySection.classList.add('active');
                        }
                    } else if (category === 'electrical') {
                        if (electricalCategorySection) {
                            electricalCategorySection.classList.add('active');
                        }
                    } else if (category === 'material_handling') {
                        if (materialHandlingCategorySection) {
                            materialHandlingCategorySection.classList.add('active');
                        }
                    } else if (category === 'tools_and_lifting_equipment') {
                        if (toolsLiftingCategorySection) {
                            toolsLiftingCategorySection.classList.add('active');
                        }
                    } else if (category === 'auxilliary') {
                        document.getElementById('auxiliaryBrands').classList.add('active');
                    }
                });
            });

           // Handle brand selection for Fire Protection - UPDATED to properly handle nested categories
const fireProtectionBrandOptions = document.querySelectorAll('#fireProtectionBrands .brand-option');
fireProtectionBrandOptions.forEach(option => {
    option.addEventListener('click', function() {
        const brandValue = this.dataset.value;

        // Parse the categories data
        let categories;
        try {
            categories = JSON.parse(this.dataset.categories);
            console.log('Brand selected:', brandValue, 'Categories:', categories); // Debug log
        } catch (e) {
            console.error('Error parsing categories:', e);
            categories = [];
        }

        // Remove selected class from all brand options
        fireProtectionBrandOptions.forEach(opt => {
            opt.classList.remove('selected');
        });

        // Add selected class to clicked brand
        this.classList.add('selected');
        document.getElementById('selectedBrand').value = brandValue;

        // Clear previously selected category
        if (selectedFireProtectionCategoryInput) {
            selectedFireProtectionCategoryInput.value = '';
        }

        // Clear category options
        if (fireProtectionCategoryOptions) {
            fireProtectionCategoryOptions.innerHTML = '';
        }

        // Show categories section if we have categories
        if (fireProtectionCategoriesSection && categories) {
            // Check if categories is an object with keys (nested structure)
            if (typeof categories === 'object' && categories !== null && !Array.isArray(categories)) {
                // It's a nested object structure (like Viking)
                fireProtectionCategoriesSection.style.display = 'block';

                // Get all main categories
                const mainCategories = Object.keys(categories);

                mainCategories.forEach(mainCategory => {
                    // Create main category header
                    const mainCategoryHeader = document.createElement('div');
                    mainCategoryHeader.className = 'main-category-header';
                    mainCategoryHeader.textContent = mainCategory;
                    fireProtectionCategoryOptions.appendChild(mainCategoryHeader);

                    // Get subcategories for this main category
                    const subCategories = categories[mainCategory];

                    // Check if subCategories is an array
                    if (Array.isArray(subCategories)) {
                        subCategories.forEach(subCategory => {
                            const categoryDiv = document.createElement('div');
                            categoryDiv.className = 'category-option-item subcategory';
                            categoryDiv.dataset.value = subCategory;
                            categoryDiv.dataset.mainCategory = mainCategory;
                            categoryDiv.textContent = subCategory;
                            fireProtectionCategoryOptions.appendChild(categoryDiv);
                        });
                    } else {
                        console.warn('Subcategories is not an array for', mainCategory, subCategories);
                    }
                });
            }
            // Check if categories is an array (simple structure like other brands)
            else if (Array.isArray(categories) && categories.length > 0) {
                fireProtectionCategoriesSection.style.display = 'block';

                categories.forEach(category => {
                    // Check if category is a string
                    if (typeof category === 'string') {
                        const categoryDiv = document.createElement('div');
                        categoryDiv.className = 'category-option-item';
                        categoryDiv.dataset.value = category;
                        categoryDiv.textContent = category;
                        fireProtectionCategoryOptions.appendChild(categoryDiv);
                    }
                });
            }
            // If categories is empty or invalid
            else {
                fireProtectionCategoriesSection.style.display = 'none';
            }

            // Add click handlers to all category options
            fireProtectionCategoryOptions.querySelectorAll('.category-option-item').forEach(catOption => {
                catOption.addEventListener('click', function() {
                    // Remove selected class from all category options
                    fireProtectionCategoryOptions.querySelectorAll('.category-option-item').forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    // Add selected class to clicked category
                    this.classList.add('selected');

                    const categoryValue = this.dataset.value;

                    if (selectedFireProtectionCategoryInput) {
                        selectedFireProtectionCategoryInput.value = categoryValue;
                    }

                    // Get the main category for context if it's a subcategory
                    const mainCategory = this.dataset.mainCategory || '';

                    // Create tag value
                    let tagValue;
                    if (mainCategory) {
                        // For nested categories (Viking), include the main category
                        tagValue = mainCategory + ' - ' + categoryValue;
                    } else {
                        // For simple categories (other brands)
                        tagValue = categoryValue;
                    }

                    console.log('Category selected:', tagValue); // Debug log
                    updateTagsWithCategory(tagValue, 'fire_protection');
                });
            });
        } else {
            fireProtectionCategoriesSection.style.display = 'none';
        }
    });
});

            // Handle auxiliary category selection
            auxiliaryCategoryRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    brandSubSections.forEach(section => {
                        section.style.display = 'none';
                    });

                    if (this.value === 'cctv') {
                        document.getElementById('cctvBrands').style.display = 'block';
                        updateTagsWithCategory('CCTV', 'auxiliary');
                    } else if (this.value === 'access_control') {
                        document.getElementById('accessControlBrands').style.display = 'block';
                        updateTagsWithCategory('Access Control', 'auxiliary');
                    }

                    document.querySelectorAll('.brand-option').forEach(option => {
                        option.classList.remove('selected');
                    });
                    document.getElementById('selectedBrand').value = '';
                });
            });

            // Handle auxiliary brand selection
            const auxiliaryBrandOptions = document.querySelectorAll('#cctvBrands .brand-option, #accessControlBrands .brand-option');
            auxiliaryBrandOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const brandValue = this.dataset.value;

                    const parentSection = this.closest('.brand-options');
                    if (parentSection) {
                        parentSection.querySelectorAll('.brand-option').forEach(opt => {
                            opt.classList.remove('selected');
                        });
                    }

                    this.classList.add('selected');
                    document.getElementById('selectedBrand').value = brandValue;

                    const selectedAuxCategory = document.querySelector('input[name="auxiliary_category"]:checked');
                    if (selectedAuxCategory) {
                        const auxCategory = selectedAuxCategory.value === 'cctv' ? 'CCTV' : 'Access Control';
                        updateTagsWithCategory(auxCategory, 'auxiliary');
                    }
                });
            });

            // Handle mechanical category selection
            mechanicalCategoryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const categoryValue = this.dataset.value;

                    mechanicalCategoryOptions.forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    this.classList.add('selected');

                    if (selectedMechanicalCategoryInput) {
                        selectedMechanicalCategoryInput.value = categoryValue;
                    }

                    updateTagsWithCategory(categoryValue, 'mechanical');
                });
            });

            // Handle electrical category selection
            electricalCategoryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const categoryValue = this.dataset.value;

                    electricalCategoryOptions.forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    this.classList.add('selected');

                    if (selectedElectricalCategoryInput) {
                        selectedElectricalCategoryInput.value = categoryValue;
                    }

                    updateTagsWithCategory(categoryValue, 'electrical');
                });
            });

            // Handle material handling category selection
            materialHandlingCategoryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const categoryValue = this.dataset.value;

                    materialHandlingCategoryOptions.forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    this.classList.add('selected');

                    if (selectedMaterialHandlingCategoryInput) {
                        selectedMaterialHandlingCategoryInput.value = categoryValue;
                    }

                    updateTagsWithCategory(categoryValue, 'material_handling');
                });
            });

            // Handle tools & lifting category selection
            toolsLiftingCategoryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const categoryValue = this.dataset.value;

                    toolsLiftingCategoryOptions.forEach(opt => {
                        opt.classList.remove('selected');
                    });

                    this.classList.add('selected');

                    if (selectedToolsLiftingCategoryInput) {
                        selectedToolsLiftingCategoryInput.value = categoryValue;
                    }

                    updateTagsWithCategory(categoryValue, 'tools_lifting');
                });
            });

            // Form validation
            document.querySelector('form').addEventListener('submit', function(e) {
                const selectedCategory = document.querySelector('input[name="category"]:checked');

                if (!selectedCategory) {
                    e.preventDefault();
                    alert('Please select a category');
                    return;
                }

                const category = selectedCategory.dataset.category;

                if (category === 'fire_protection') {
                    const selectedBrand = document.getElementById('selectedBrand').value;
                    if (!selectedBrand || selectedBrand.trim() === '') {
                        e.preventDefault();
                        alert('Please select a brand');
                        return;
                    }

                    const selectedCategory = document.getElementById('selectedFireProtectionCategory')?.value;
                    if (!selectedCategory || selectedCategory.trim() === '') {
                        e.preventDefault();
                        alert('Please select a product category');
                        return;
                    }
                } else if (category === 'mechanical') {
                    const selectedMechanicalCategory = document.getElementById('selectedMechanicalCategory').value;
                    if (!selectedMechanicalCategory || selectedMechanicalCategory.trim() === '') {
                        e.preventDefault();
                        alert('Please select a Mechanical product category');
                        return;
                    }
                } else if (category === 'electrical') {
                    const selectedElectricalCategory = document.getElementById('selectedElectricalCategory')?.value;
                    if (!selectedElectricalCategory || selectedElectricalCategory.trim() === '') {
                        e.preventDefault();
                        alert('Please select an Electrical product category');
                        return;
                    }
                } else if (category === 'material_handling') {
                    const selectedMaterialHandlingCategory = document.getElementById('selectedMaterialHandlingCategory')?.value;
                    if (!selectedMaterialHandlingCategory || selectedMaterialHandlingCategory.trim() === '') {
                        e.preventDefault();
                        alert('Please select a Material Handling product category');
                        return;
                    }
                } else if (category === 'tools_and_lifting_equipment') {
                    const selectedToolsLiftingCategory = document.getElementById('selectedToolsLiftingCategory')?.value;
                    if (!selectedToolsLiftingCategory || selectedToolsLiftingCategory.trim() === '') {
                        e.preventDefault();
                        alert('Please select a Tools & Lifting product category');
                        return;
                    }
                } else {
                    const selectedBrand = document.getElementById('selectedBrand').value;
                    if (!selectedBrand || selectedBrand.trim() === '') {
                        e.preventDefault();
                        alert('Please select a brand');
                        return;
                    }
                }

                if (category === 'auxilliary') {
                    const selectedAuxCategory = document.querySelector('input[name="auxiliary_category"]:checked');
                    if (!selectedAuxCategory) {
                        e.preventDefault();
                        alert('Please select an auxiliary category (CCTV or Access Control)');
                        return;
                    }

                    const selectedBrand = document.getElementById('selectedBrand').value;
                    if (!selectedBrand || selectedBrand.trim() === '') {
                        e.preventDefault();
                        alert('Please select an auxiliary brand');
                        return;
                    }
                }
            });

            // Set default publish date to now if publishing
            const publishedAtInput = document.getElementById('published_at');
            const statusPublishedRadio = document.getElementById('statusPublished');

            if (statusPublishedRadio) {
                statusPublishedRadio.addEventListener('change', function() {
                    if (this.checked && !publishedAtInput.value) {
                        const now = new Date();
                        const localDateTime = now.toISOString().slice(0, 16);
                        publishedAtInput.value = localDateTime;
                    }
                });
            }

            // Featured image preview
            const featuredImageInput = document.getElementById('featured_image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');

            if (featuredImageInput) {
                featuredImageInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            imagePreview.style.display = 'block';
                        }

                        reader.readAsDataURL(this.files[0]);
                    } else {
                        imagePreview.style.display = 'none';
                    }
                });
            }

            // SweetAlert2 notification
            @if(session('success'))
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ route("admin.posts.index") }}';
                });
            @endif
        });
    </script>

    <style>
        /* Custom SweetAlert2 Styles */
        .swal-title {
            color: #084433 !important;
            font-weight: 600 !important;
        }

        .swal-popup {
            border-radius: 10px !important;
            padding: 20px !important;
        }

        .swal-confirm-btn {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal-confirm-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
        }

        .swal-cancel-btn {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal-cancel-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3) !important;
        }
    </style>
</body>
</html>
