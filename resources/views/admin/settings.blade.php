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

    <title>Settings - Archtech Admin</title>
    <style>
        :root {
            --archtech-primary: #084433;
            --archtech-secondary: #5DB996;
            --archtech-light: #118B50;
            --archtech-dark: #063325;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
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

            .info-grid {
                grid-template-columns: 1fr;
            }

            .picture-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .picture-action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .admin-main {
                padding: 15px 12px;
                padding-top: 75px;
            }

            .admin-header {
                padding: 15px;
            }

            .admin-header h1 {
                font-size: 1.3rem;
            }

            .admin-header p {
                font-size: 0.9rem;
            }

            .admin-card {
                padding: 15px;
            }

            .profile-picture-large {
                width: 150px;
                height: 150px;
                font-size: 3rem;
            }

            .modal {
                max-width: 100%;
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

            .admin-card {
                padding: 12px;
            }

            .admin-card-header {
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            .admin-card-title {
                font-size: 1.1rem;
            }

            .form-control,
            .btn-archtech,
            .btn-archtech-outline,
            .edit-btn {
                padding: 8px 12px;
                font-size: 0.95rem;
            }

            .alert {
                padding: 10px;
                font-size: 0.9rem;
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

            .info-label {
                font-size: 0.8rem;
            }

            .info-value {
                font-size: 0.95rem;
            }

            .status-badge {
                padding: 4px 12px;
                font-size: 0.8rem;
            }

            .profile-picture-large {
                width: 120px;
                height: 120px;
                font-size: 2.5rem;
            }

            .modal-header {
                padding: 15px;
            }

            .modal-body {
                padding: 15px;
            }

            .modal-footer {
                padding: 15px;
            }
        }

        /* Header */
        .admin-header {
            background: white;
            padding: 20px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-left: 4px solid var(--archtech-primary);
        }

        /* Cards */
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-card-title {
            color: var(--archtech-primary);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        /* Sidebar Styles */
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

        /* Buttons */
        .btn-archtech {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-archtech:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3);
            color: white;
        }

        .btn-archtech-outline {
            background: transparent;
            color: var(--archtech-primary);
            border: 2px solid var(--archtech-primary);
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-archtech-outline:hover {
            background: var(--archtech-primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 5px 15px;
            font-size: 0.875rem;
        }

        .edit-btn {
            background: none;
            border: 1px solid var(--archtech-secondary);
            color: var(--archtech-secondary);
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn:hover {
            background: var(--archtech-secondary);
            color: white;
        }

        /* Profile Picture Section */
        .profile-picture-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-picture-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .profile-picture-large {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            font-weight: 600;
            background-size: cover;
            background-position: center;
            margin: 0 auto;
            border: 5px solid white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons for Profile Picture */
        .picture-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .picture-action-btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .picture-action-btn.primary {
            background: var(--archtech-primary);
            color: white;
        }

        .picture-action-btn.success {
            background: var(--archtech-secondary);
            color: white;
        }

        .picture-action-btn.danger {
            background: var(--danger);
            color: white;
        }

        .picture-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #profile-picture-input {
            display: none;
        }

        /* Info Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .info-label {
            color: #666;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            color: var(--archtech-primary);
            font-size: 1rem;
            font-weight: 600;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 15px;
            background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-badge i {
            margin-right: 5px;
        }

        /* Alert */
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: #d4edda;
            border-left: 4px solid var(--success);
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-left: 4px solid var(--danger);
            color: #721c24;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 2px solid rgba(8, 68, 51, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            color: var(--archtech-primary);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            padding: 20px 25px;
            border-top: 2px solid rgba(8, 68, 51, 0.1);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--archtech-primary);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--archtech-secondary);
            box-shadow: 0 0 0 3px rgba(93, 185, 150, 0.1);
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        /* Flex Utilities */
        .d-flex { display: flex; }
        .d-block { display: block; }
        .d-inline { display: inline; }
        .d-inline-block { display: inline-block; }

        .flex-column { flex-direction: column; }
        .flex-shrink-0 { flex-shrink: 0; }
        .flex-grow-1 { flex-grow: 1; }
        .flex-wrap { flex-wrap: wrap; }

        .align-items-center { align-items: center; }
        .align-items-start { align-items: flex-start; }
        .align-items-end { align-items: flex-end; }

        .justify-content-between { justify-content: space-between; }
        .justify-content-center { justify-content: center; }
        .justify-content-end { justify-content: flex-end; }

        /* Width Utilities */
        .w-100 { width: 100%; }

        /* Grid */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -15px;
        }

        .col {
            padding: 15px;
            box-sizing: border-box;
        }

        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        /* Spacing Utilities */
        .mb-0 { margin-bottom: 0; }
        .mb-2 { margin-bottom: 10px; }
        .mb-3 { margin-bottom: 15px; }
        .mb-4 { margin-bottom: 20px; }
        .mb-5 { margin-bottom: 25px; }

        .me-1 { margin-right: 5px; }
        .me-2 { margin-right: 10px; }
        .me-3 { margin-right: 15px; }

        .ms-1 { margin-left: 5px; }
        .ms-2 { margin-left: 10px; }
        .ms-3 { margin-left: 15px; }

        .py-1 { padding-top: 5px; padding-bottom: 5px; }
        .py-2 { padding-top: 10px; padding-bottom: 10px; }
        .py-3 { padding-top: 15px; padding-bottom: 15px; }
        .py-4 { padding-top: 20px; padding-bottom: 20px; }
        .py-5 { padding-top: 50px; padding-bottom: 50px; }

        /* Text Utilities */
        .text-center { text-align: center; }
        .text-muted { color: #6c757d; }
        .text-small { font-size: 0.875rem; }

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
                         <!-- CONTACT SUBMISSIONS - Add this right after Team Members -->
        <a class="nav-link-admin {{ request()->routeIs('admin.contact-submissions.*') ? 'active' : '' }}" href="{{ route('admin.contact-submissions.index') }}">
            <i class="fas fa-envelope"></i>
            <span>Contact Submissions</span>
            @php
                use App\Models\ContactSubmission;
                $unreadCount = ContactSubmission::where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="badge" style="background-color: #ffc107 !important; color: #212529 !important; margin-left: auto; font-size: 0.75rem; padding: 3px 8px; border-radius: 10px;">
                    {{ $unreadCount }} new
                </span>
            @endif
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
            <div class="admin-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2" style="color: #084433;">Settings</h1>
                    <p class="text-muted mb-0">Manage your profile and account settings</p>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-cog me-2 text-muted"></i>
                    <span class="text-muted">{{ now()->format('F j, Y') }}</span>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Profile Picture Section -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title mb-0">
                        <i class="fas fa-user-circle me-2"></i>Profile Picture
                    </h3>
                </div>

                <div class="profile-picture-container">
                    <div class="profile-picture-wrapper">
                        <div class="profile-picture-large" id="main-avatar" style="background-image: url('{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '' }}')">
                            @if(!Auth::user()->profile_picture)
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                    <div class="user-name">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="picture-actions">
                        @if(Auth::user()->profile_picture)
                            <button type="button" class="picture-action-btn primary" onclick="viewProfilePicture()">
                                <i class="fas fa-eye"></i>
                                View Photo
                            </button>
                        @endif

                        <button type="button" class="picture-action-btn success" onclick="document.getElementById('profile-picture-input').click()">
                            <i class="fas fa-upload"></i>
                            Upload New Photo
                        </button>

                        @if(Auth::user()->profile_picture)
                            <button type="button" class="picture-action-btn danger" onclick="removeProfilePicture()">
                                <i class="fas fa-trash"></i>
                                Delete Photo
                            </button>
                        @endif
                    </div>

                    <!-- Hidden forms -->
                    <form id="profile-picture-form" action="{{ route('admin.settings.update-profile-picture') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                        @csrf
                        @method('PUT')
                        <input type="file" id="profile-picture-input" name="profile_picture" accept="image/*" onchange="handleProfilePictureUpload(event)">
                    </form>

                    <form id="remove-picture-form" action="{{ route('admin.settings.remove-profile-picture') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <p class="text-muted text-small mt-3">
                        Recommended: Square image, at least 400x400 pixels. Max file size: 2MB.
                    </p>
                </div>
            </div>

            <!-- Account Information -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Account Information
                    </h3>
                    <button type="button" class="edit-btn" onclick="openEditProfileModal()">
                        <i class="fas fa-edit"></i>
                        Edit
                    </button>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Account Status</div>
                        <div class="d-flex align-items-center">
                            <div class="status-badge">
                                <i class="fas fa-circle" style="color: {{ Auth::user()->is_active ? '#28a745' : '#dc3545' }};"></i>
                                {{ Auth::user()->is_active ? 'Active' : 'Inactive' }}
                            </div>
                        </div>
                        <small class="text-muted">
                            Active since {{ Auth::user()->created_at->format('M d, Y') }}
                        </small>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Position</div>
                        <div class="info-value">{{ Auth::user()->position ?? 'No position set' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Role</div>
                        <div class="info-value">
                            {{ ucfirst(Auth::user()->role) }}
                            @if(Auth::user()->isSeederAdmin())
                                <span class="text-muted text-small">(Seeder Admin)</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Change Password -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="admin-card-title mb-0">
                        <i class="fas fa-key me-2"></i>Change Password
                    </h3>
                </div>

                <form action="{{ route('admin.settings.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="form-control">
                        @error('current_password')
                            <small style="color: var(--danger);">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">New Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @error('password')
                            <small style="color: var(--danger);">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn-archtech-outline">
                        <i class="fas fa-key me-2"></i>Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal-overlay" id="editProfileModal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </h3>
                <button type="button" class="modal-close" onclick="closeEditProfileModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.settings.update-profile') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="edit_name">Full Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <small style="color: var(--danger);">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit_email">Email Address</label>
                        <input type="email" id="edit_email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <small style="color: var(--danger);">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="edit_position">Position</label>
                        <select id="edit_position" name="position" class="form-control">
                            <option value="">Select Position</option>
                            @php
                                $positions = ['CEO', 'CTO', 'Project Manager', 'Developer', 'Designer', 'Content Writer', 'Marketing', 'Sales'];
                                if (defined('App\Models\User::POSITIONS')) {
                                    $positions = App\Models\User::POSITIONS;
                                }
                            @endphp
                            @foreach($positions as $position)
                                <option value="{{ $position }}" {{ Auth::user()->position == $position ? 'selected' : '' }}>
                                    {{ $position }}
                                </option>
                            @endforeach
                        </select>
                        @error('position')
                            <small style="color: var(--danger);">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-archtech-outline" onclick="closeEditProfileModal()">
                        Cancel
                    </button>
                    <button type="submit" class="btn-archtech">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Profile Picture Modal -->
    <div class="modal-overlay" id="viewPictureModal">
        <div class="modal" style="max-width: 600px;">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-image me-2"></i>Profile Picture
                </h3>
                <button type="button" class="modal-close" onclick="closeViewPictureModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body text-center">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                         alt="Profile Picture"
                         style="max-width: 100%; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                @else
                    <div class="profile-picture-large" style="width: 200px; height: 200px; margin: 0 auto;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <p class="text-muted mt-3">No profile picture uploaded</p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-archtech-outline" onclick="closeViewPictureModal()">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar Functionality - EXACTLY like dashboard.blade.php
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
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

            // Check for SweetAlert messages
            @if(session('alert_type') && session('alert_title') && session('alert_message'))
                Swal.fire({
                    position: 'center',
                    icon: '{{ session("alert_type") }}',
                    title: '{{ session("alert_title") }}',
                    text: '{{ session("alert_message") }}',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'swal-title',
                        confirmButton: 'swal-cancel-btn'
                    }
                });
            @endif

            // Also check for regular success messages and convert them to SweetAlert
            @if(session('success'))
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'swal-title',
                        confirmButton: 'swal-cancel-btn'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session("error") }}',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'swal-title',
                        confirmButton: 'swal-cancel-btn'
                    }
                });
            @endif
        });

        // Profile Picture Functions
        function handleProfilePictureUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.match('image.*')) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Invalid File',
                    text: 'Please select an image file (JPEG, PNG, GIF, etc.)',
                    showConfirmButton: true,
                    confirmButtonColor: '#084433',
                    customClass: {
                        confirmButton: 'swal-cancel-btn'
                    }
                });
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'File size should not exceed 2MB',
                    showConfirmButton: true,
                    confirmButtonColor: '#084433',
                    customClass: {
                        confirmButton: 'swal-cancel-btn'
                    }
                });
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                const mainAvatar = document.getElementById('main-avatar');
                const sidebarAvatar = document.getElementById('sidebar-avatar');

                mainAvatar.style.backgroundImage = `url('${e.target.result}')`;
                mainAvatar.textContent = '';

                sidebarAvatar.style.backgroundImage = `url('${e.target.result}')`;
                sidebarAvatar.textContent = '';
            };
            reader.readAsDataURL(file);

            // Show confirmation before upload
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Uploading Profile Picture',
                text: 'Are you sure you want to update your profile picture?',
                showCancelButton: true,
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#198754',
                cancelButtonColor: '#084433',
                customClass: {
                    confirmButton: 'swal-restore-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('profile-picture-form').submit();
                } else {
                    // Reset the file input
                    event.target.value = '';
                }
            });
        }

        function removeProfilePicture() {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Remove Profile Picture',
                text: 'Are you sure you want to remove your profile picture?',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#084433',
                customClass: {
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('remove-picture-form').submit();
                }
            });
        }

        function viewProfilePicture() {
            document.getElementById('viewPictureModal').classList.add('active');
        }

        function closeViewPictureModal() {
            document.getElementById('viewPictureModal').classList.remove('active');
        }

        // Profile Edit Modal Functions
        function openEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('active');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('active');
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            const editModal = document.getElementById('editProfileModal');
            const viewModal = document.getElementById('viewPictureModal');

            if (event.target === editModal) {
                closeEditProfileModal();
            }

            if (event.target === viewModal) {
                closeViewPictureModal();
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditProfileModal();
                closeViewPictureModal();
            }
        });

        // Password form validation with SweetAlert
        const passwordForm = document.querySelector('form[action*="update-password"]');
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                if (!currentPassword) {
                    e.preventDefault();
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Current Password Required',
                        text: 'Please enter your current password',
                        showConfirmButton: true,
                        confirmButtonColor: '#084433',
                        customClass: {
                            confirmButton: 'swal-cancel-btn'
                        }
                    });
                    return;
                }

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Passwords Don\'t Match',
                        text: 'New password and confirmation do not match',
                        showConfirmButton: true,
                        confirmButtonColor: '#084433',
                        customClass: {
                            confirmButton: 'swal-cancel-btn'
                        }
                    });
                    return;
                }
            });
        }
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

        .swal-restore-btn {
            background: linear-gradient(135deg, #198754 0%, #136a43 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal-restore-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3) !important;
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
