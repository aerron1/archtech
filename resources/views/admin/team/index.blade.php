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

    <title>Team Members - Archtech Admin</title>
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

            .filter-group {
                flex-direction: column;
                gap: 10px;
            }

            .filter-select, .search-input, .search-btn {
                width: 100%;
                min-width: auto;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
            }

            .table-container table {
                min-width: 900px;
            }

            .admin-user-info {
                padding: 10px;
            }

            .user-avatar {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .table-container + div {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .table-container + div > div:last-child {
                justify-content: center;
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

            .no-members {
                padding: 30px 15px;
            }

            .no-members i {
                font-size: 3rem;
            }

            .no-members h3 {
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

            .btn-group {
                flex-direction: column;
                gap: 5px;
            }

            .btn-group a, .btn-group button {
                width: 100%;
                text-align: center;
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

            .table-container table {
                min-width: 800px;
            }

            .table-container th {
                padding: 12px 8px;
                font-size: 0.9rem;
            }

            .table-container td {
                padding: 12px 8px;
                font-size: 0.9rem;
            }

            .badge {
                padding: 4px 8px;
                font-size: 0.75rem;
            }

            .btn-group a, .btn-group button {
                padding: 6px;
                font-size: 0.85rem;
            }

            .table-container td > div {
                font-size: 0.85rem;
            }

            .table-container td > div > div > div {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
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

        /* TABLE STYLES */
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
        }

        .table-container td {
            padding: 15px;
            border-top: 1px solid rgba(8, 68, 51, 0.1);
        }

        .table-container tbody tr:hover {
            background-color: rgba(8, 68, 51, 0.03);
        }

        /* BADGES */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-active {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%);
            color: white;
        }

        .badge-inactive {
            background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
            color: white;
        }

        .badge-admin {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
        }

        .badge-editor {
            background: linear-gradient(135deg, #0dcaf0 0%, #0baccc 100%);
            color: white;
        }

        .badge-viewer {
            background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
            color: white;
        }

        /* BUTTON GROUPS */
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

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background: #ffc107;
            color: #212529;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
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

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }

        /* ALERTS */
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

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
        }

        /* SIDEBAR STYLES */
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

        /* FORM STYLES FOR CREATE/EDIT */
        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #084433;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--archtech-primary);
            box-shadow: 0 0 0 3px rgba(8, 68, 51, 0.1);
        }

        .select-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-size: 1rem;
            background: white;
            cursor: pointer;
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

        .swal-enable-btn {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal-enable-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3) !important;
        }

        .swal-disable-btn {
            background: linear-gradient(135deg, #6c757d 0%, #545b62 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal-disable-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3) !important;
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
            <div class="admin-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="color: #084433; margin: 0 0 5px 0;">Team Members</h1>
                        <p class="text-muted" style="margin: 0;">Manage your team accounts and permissions</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted" style="margin-right: 15px;">
                            <i class="fas fa-users me-1"></i>
                            {{ $users->count() }} Members
                        </span>
                        <!-- Only seeder admin can add new members -->
                        @if(Auth::user()->isSeederAdmin())
                            <a href="{{ route('admin.team.create') }}" class="btn-archtech">
                                <i class="fas fa-user-plus me-1"></i> Add New Member
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Flash Messages - These will be hidden and replaced by SweetAlert -->
            @if(session('success'))
                <div class="alert alert-success" style="display: none;">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add this after the flash messages section -->
            @if($users->where('is_active', false)->count() > 0)
                <div class="alert alert-warning" style="display: none;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Note:</strong> {{ $users->where('is_active', false)->count() }}
                    {{ Str::plural('account', $users->where('is_active', false)->count()) }}
                    are disabled and cannot login.
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="display: none;">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Team Members Table -->
            <div class="table-container">
                @if($users->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Member</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; background-size: cover; background-position: center; background-image: url('{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : '' }}');">
                                            @if(!$user->profile_picture)
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <div>{{ $user->name }}</div>
                                            @if($user->id == auth()->id())
                                                <small class="text-muted">(You)</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge badge-admin">
                                            <i class="fas fa-crown me-1"></i> Admin
                                        </span>
                                    @elseif($user->role == 'editor')
                                        <span class="badge badge-editor">
                                            <i class="fas fa-edit me-1"></i> Editor
                                        </span>
                                    @else
                                        <span class="badge badge-viewer">
                                            <i class="fas fa-eye me-1"></i> Viewer
                                        </span>
                                    @endif
                                    @if($user->isSeederAdmin())
                                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                            <i class="fas fa-shield-alt"></i> Seeder Admin
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($user->position)
                                        <span class="badge" style="background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%); color: white;">
                                            <i class="fas fa-briefcase me-1"></i> {{ $user->position }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge badge-active">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge badge-inactive">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @php
                                            $isSeederAdmin = Auth::user()->isSeederAdmin();
                                            $isCurrentUser = $user->id == auth()->id();
                                        @endphp

                                        <!-- Show edit button for:
                                            1. Seeder admin (can edit everyone)
                                            2. Current user (can edit themselves) -->
                                        @if($isSeederAdmin || $isCurrentUser)
                                            <a href="{{ route('admin.team.edit', $user) }}" class="btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        <!-- Toggle Status Button (Only for seeder admin and not for seeder admin account itself) -->
                                        @if($isSeederAdmin && !$user->isSeederAdmin())
                                            @if($user->is_active)
                                                <button type="button" class="btn-outline-secondary disable-user"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}"
                                                        title="Disable Account">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>
                                                <form id="disable-form-{{ $user->id }}" action="{{ route('admin.team.toggle-status', $user) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            @else
                                                <button type="button" class="btn-outline-success enable-user"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}"
                                                        title="Enable Account">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                                <form id="enable-form-{{ $user->id }}" action="{{ route('admin.team.toggle-status', $user) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            @endif
                                        @endif

                                        <!-- Delete Button (Only for seeder admin, not for themselves, and not for seeder admin account) -->
                                        @if($isSeederAdmin && $user->id != auth()->id() && !$user->isSeederAdmin())
                                            <button type="button" class="btn-outline-danger delete-user"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.team.destroy', $user) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                        <!-- No actions for regular users viewing other users -->
                                        @if(!$isSeederAdmin && !$isCurrentUser)
                                            <span class="text-muted" style="font-size: 0.8rem;">
                                                <i class="fas fa-ban"></i> No actions
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-members text-center" style="padding: 50px;">
                        <i class="fas fa-users fa-4x text-muted mb-4"></i>
                        <h3 style="color: #084433;">No team members found</h3>
                        <p class="text-muted mb-4">Start by adding your first team member.</p>
                        @if(Auth::user()->isSeederAdmin())
                            <a href="{{ route('admin.team.create') }}" class="btn-archtech">
                                <i class="fas fa-user-plus me-2"></i>Add First Member
                            </a>
                        @endif
                    </div>
                @endif
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

            // ============================================
            // SWEETALERT FOR FLASH MESSAGES
            // ============================================

            @if(session('alert_type') && session('alert_title') && session('alert_message'))
                Swal.fire({
                    position: 'center',
                    icon: '{{ session("alert_type") }}',
                    title: '{{ session("alert_title") }}',
                    text: '{{ session("alert_message") }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#084433',
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'swal-title',
                        confirmButton: 'swal-cancel-btn'
                    }
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#084433',
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
                    confirmButtonColor: '#084433',
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        title: 'swal-title',
                        confirmButton: 'swal-cancel-btn'
                    }
                });
            @endif

            // ============================================
            // DISABLE USER CONFIRMATION
            // ============================================
            const disableButtons = document.querySelectorAll('.disable-user');
            disableButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;

                    Swal.fire({
                        title: 'Disable Account?',
                        text: `Are you sure you want to disable "${userName}"? They will not be able to login.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#6c757d',
                        cancelButtonColor: '#084433',
                        confirmButtonText: 'Yes, disable!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        backdrop: `
                            rgba(8,68,51,0.2)
                            left top
                            no-repeat
                        `,
                        customClass: {
                            title: 'swal-title',
                            confirmButton: 'swal-disable-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`disable-form-${userId}`).submit();
                        }
                    });
                });
            });

            // ============================================
            // ENABLE USER CONFIRMATION
            // ============================================
            const enableButtons = document.querySelectorAll('.enable-user');
            enableButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;

                    Swal.fire({
                        title: 'Enable Account?',
                        text: `Are you sure you want to enable "${userName}"? They will be able to login again.`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#084433',
                        confirmButtonText: 'Yes, enable!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        backdrop: `
                            rgba(8,68,51,0.2)
                            left top
                            no-repeat
                        `,
                        customClass: {
                            title: 'swal-title',
                            confirmButton: 'swal-enable-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`enable-form-${userId}`).submit();
                        }
                    });
                });
            });

            // ============================================
            // DELETE USER CONFIRMATION
            // ============================================
            const deleteButtons = document.querySelectorAll('.delete-user');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;

                    Swal.fire({
                        title: 'Delete Account?',
                        text: `Are you sure you want to delete "${userName}"? This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#084433',
                        confirmButtonText: 'Yes, delete!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        backdrop: `
                            rgba(8,68,51,0.2)
                            left top
                            no-repeat
                        `,
                        customClass: {
                            title: 'swal-title',
                            confirmButton: 'swal-confirm-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${userId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
