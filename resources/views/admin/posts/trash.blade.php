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

    <title>Recently Deleted Posts - Archtech Admin</title>
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

        /* Mobile Styles */
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

            .btn-archtech, .btn-archtech-outline, .btn-danger {
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

            .posts-table {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
            }

            .posts-table table {
                min-width: 900px;
            }

            .bulk-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .bulk-select {
                width: 100%;
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

            .btn-archtech, .btn-danger {
                width: 100%;
                margin-top: 10px;
            }

            .search-box {
                flex-direction: column;
                gap: 10px;
            }

            .search-input, .search-btn, .search-box a {
                width: 100%;
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

            .btn-group {
                flex-direction: column;
                gap: 5px;
            }

            .btn-group a, .btn-group button {
                width: 100%;
                text-align: center;
            }

            .posts-table + div {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .posts-table + div > div:last-child {
                justify-content: center;
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

            .bulk-actions {
                padding: 12px;
            }

            .bulk-actions div:first-child {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .bulk-actions div:last-child {
                flex-direction: column;
                gap: 10px;
            }

            .bulk-select {
                margin: 10px 0;
            }

            .posts-table table {
                min-width: 800px;
            }

            .posts-table th {
                padding: 12px 8px;
                font-size: 0.9rem;
            }

            .posts-table td {
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

            .posts-table td > div {
                font-size: 0.85rem;
            }

            .posts-table td > div > div > div {
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

            .search-box {
                gap: 8px;
            }

            .search-input,
            .search-btn,
            .search-box a {
                padding: 8px 12px;
                font-size: 0.95rem;
            }
        }

        /* Rest of your existing styles */
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

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%);
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

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* POSTS TABLE STYLES */
        .posts-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .posts-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .posts-table th {
            background: linear-gradient(135deg, var(--archtech-dark) 0%, #333 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
        }

        .posts-table td {
            padding: 15px;
            border-top: 1px solid rgba(8, 68, 51, 0.1);
        }

        .posts-table tbody tr:hover {
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

        .badge-deleted {
            background: #dc3545;
            color: white;
        }

        .badge-published {
            background: #198754;
            color: white;
        }

        .badge-draft {
            background: #6c757d;
            color: white;
        }

        /* CHECKBOX */
        .post-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
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

        .btn-outline-success {
            border-color: #198754;
            color: #198754;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .btn-outline-success:hover {
            background: #198754;
            color: white;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
        }

        /* UTILITIES */
        .text-center {
            text-align: center;
        }

        .py-5 {
            padding: 50px 0;
        }

        .text-muted {
            color: #6c757d;
        }

        .no-posts {
            padding: 50px;
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

        /* BULK ACTIONS */
        .bulk-actions {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .bulk-select {
            padding: 8px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            min-width: 150px;
        }

        /* SEARCH */
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .search-btn {
            padding: 10px 20px;
            background: var(--archtech-primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--archtech-dark);
            transform: translateY(-2px);
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
    <!-- Mobile Header with Logo -->
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
        <!-- Sidebar -->
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

                        <a class="nav-link-admin {{ request()->routeIs('admin.posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Blog Posts</span>
                        </a>

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
                        <h1 style="color: #084433; margin: 0 0 5px 0;">Recently Deleted Posts</h1>
                        <p class="text-muted" style="margin: 0;">Posts will be permanently deleted after 30 days</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted" style="margin-right: 15px;">
                            <i class="fas fa-trash-alt me-1"></i>
                            {{ $trashedPosts->total() ?? 0 }} Deleted Posts
                        </span>
                        <a href="{{ route('admin.posts.index') }}" class="btn-archtech-outline" style="margin-right: 10px;">
                            <i class="fas fa-arrow-left me-1"></i> Back to Posts
                        </a>
                        @if($trashedPosts->count() > 0)
                            <button type="button" class="btn-danger" id="emptyTrashBtn">
                                <i class="fas fa-trash-alt me-1"></i> Empty Trash
                            </button>
                            <form id="empty-trash-form" action="{{ route('admin.posts.empty-trash') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
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

            @if($trashedPosts->count() > 0)
                <!-- Warning Alert -->
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> Posts in trash will be automatically deleted after 30 days.
                    You have {{ $trashedPosts->total() }} {{ Str::plural('post', $trashedPosts->total()) }} in trash.
                </div>

                <!-- Search -->
                <form method="GET" action="{{ route('admin.posts.trash') }}" class="search-box">
                    <input type="text"
                           name="search"
                           class="search-input"
                           placeholder="Search deleted posts..."
                           value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i> Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.posts.trash') }}" class="btn-archtech-outline">
                            Clear
                        </a>
                    @endif
                </form>

                <!-- Bulk Actions Form -->
                <form action="{{ route('admin.posts.bulk-action') }}" method="POST" id="bulkForm">
                    @csrf
                    <input type="hidden" name="action" id="bulkAction">
                    <div class="bulk-actions">
                        <div>
                            <input type="checkbox" id="selectAll" class="post-checkbox">
                            <label for="selectAll" style="margin-left: 5px; font-weight: 600;">Select All</label>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                            <span id="selectedCount">0 posts selected</span>
                            <select class="bulk-select" id="actionSelect">
                                <option value="">Bulk Actions</option>
                                <option value="restore">Restore Selected</option>
                                <option value="delete">Delete Permanently</option>
                            </select>
                            <button type="button" class="btn-archtech-outline" id="applyBulkActionBtn">
                                Apply
                            </button>
                        </div>
                    </div>

                    <!-- Posts Table -->
                    <div class="posts-table">
                        <table>
                            <thead>
                                <tr>
                                    <th width="50"></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Deleted By</th>
                                    <th>Deleted At</th>
                                    <th>Original Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trashedPosts as $post)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               name="selected_posts[]"
                                               value="{{ $post->id }}"
                                               class="post-checkbox select-post">
                                    </td>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        <strong>{{ Str::limit($post->title, 50) }}</strong>
                                        @if($post->product_name)
                                            <br>
                                            <small class="text-muted">Product: {{ $post->product_name }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem;">
                                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div>{{ $post->user->name }}</div>
                                                <small class="text-muted">{{ $post->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>Deleted:</strong>
                                            {{ $post->deleted_at->format('M d, Y h:i A') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $post->deleted_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        @if($post->is_published && $post->published_at <= now())
                                            <span class="badge badge-published">
                                                <i class="fas fa-check-circle me-1"></i> Published
                                            </span>
                                        @elseif($post->is_published && $post->published_at > now())
                                            <span class="badge badge-draft">
                                                <i class="fas fa-clock me-1"></i> Scheduled
                                            </span>
                                        @else
                                            <span class="badge badge-draft">
                                                <i class="fas fa-save me-1"></i> Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Restore Button with onclick attribute -->
                                            <button type="button" class="btn-outline-success restore-post"
                                                    onclick="restorePost({{ $post->id }}, '{{ addslashes($post->title) }}')">
                                                <i class="fas fa-trash-restore"></i> Restore
                                            </button>
                                            <form id="restore-form-{{ $post->id }}" action="{{ route('admin.posts.restore', $post->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                            <!-- Delete Permanently Button -->
                                            <button type="button" class="btn-outline-danger delete-permanent"
                                                    onclick="deletePermanently({{ $post->id }}, '{{ addslashes($post->title) }}')">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                            <form id="delete-permanent-form-{{ $post->id }}" action="{{ route('admin.posts.force-delete', $post->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Pagination -->
                @if($trashedPosts->hasPages())
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; flex-wrap: wrap; gap: 15px;">
                    <div class="text-muted">
                        Showing {{ $trashedPosts->firstItem() }} to {{ $trashedPosts->lastItem() }} of {{ $trashedPosts->total() }} deleted posts
                    </div>
                    <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                        @if($trashedPosts->onFirstPage())
                            <span class="btn-archtech-outline" style="opacity: 0.5; cursor: not-allowed;">
                                <i class="fas fa-arrow-left"></i> Previous
                            </span>
                        @else
                            <a href="{{ $trashedPosts->previousPageUrl() }}" class="btn-archtech-outline">
                                <i class="fas fa-arrow-left"></i> Previous
                            </a>
                        @endif

                        @if($trashedPosts->hasMorePages())
                            <a href="{{ $trashedPosts->nextPageUrl() }}" class="btn-archtech-outline">
                                Next <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <span class="btn-archtech-outline" style="opacity: 0.5; cursor: not-allowed;">
                                Next <i class="fas fa-arrow-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="no-posts text-center">
                    <i class="fas fa-trash-alt fa-4x text-muted mb-4"></i>
                    <h3 style="color: #084433;">Trash is empty</h3>
                    <p class="text-muted mb-4">No posts have been deleted yet.</p>
                    <a href="{{ route('admin.posts.index') }}" class="btn-archtech">
                        <i class="fas fa-arrow-left me-2"></i> Back to Posts
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Global functions for restore and delete
        function restorePost(postId, postTitle) {
            Swal.fire({
                title: 'Restore Post?',
                text: `Are you sure you want to restore "${postTitle}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#084433',
                confirmButtonText: 'Yes, restore it!',
                cancelButtonText: 'Cancel',
                background: '#fff',
                customClass: {
                    title: 'swal-title',
                    confirmButton: 'swal-restore-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById(`restore-form-${postId}`);
                    if (form) {
                        form.submit();
                    } else {
                        console.error(`Form restore-form-${postId} not found`);
                        // Fallback: create and submit a form dynamically
                        const fallbackForm = document.createElement('form');
                        fallbackForm.method = 'POST';
                        fallbackForm.action = `{{ url('admin/posts') }}/${postId}/restore`;
                        fallbackForm.style.display = 'none';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        fallbackForm.appendChild(csrfToken);
                        document.body.appendChild(fallbackForm);
                        fallbackForm.submit();
                    }
                }
            });
        }

        function deletePermanently(postId, postTitle) {
            Swal.fire({
                title: 'Delete Permanently?',
                text: `Are you sure you want to permanently delete "${postTitle}"? This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#084433',
                confirmButtonText: 'Yes, delete permanently!',
                cancelButtonText: 'Cancel',
                background: '#fff',
                customClass: {
                    title: 'swal-title',
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById(`delete-permanent-form-${postId}`);
                    if (form) {
                        form.submit();
                    } else {
                        console.error(`Form delete-permanent-form-${postId} not found`);
                        // Fallback: create and submit a form dynamically
                        const fallbackForm = document.createElement('form');
                        fallbackForm.method = 'POST';
                        fallbackForm.action = `{{ url('admin/posts') }}/${postId}/force-delete`;
                        fallbackForm.style.display = 'none';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        fallbackForm.appendChild(csrfToken);
                        fallbackForm.appendChild(methodField);
                        document.body.appendChild(fallbackForm);
                        fallbackForm.submit();
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar Functionality
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

            // Bulk selection functionality
            const selectAll = document.getElementById('selectAll');
            const postCheckboxes = document.querySelectorAll('.select-post');
            const selectedCount = document.getElementById('selectedCount');

            function updateSelectedCount() {
                const selected = document.querySelectorAll('.select-post:checked').length;
                selectedCount.textContent = `${selected} ${selected === 1 ? 'post' : 'posts'} selected`;
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const isChecked = this.checked;
                    postCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    updateSelectedCount();
                });
            }

            postCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });

            // Initialize count
            updateSelectedCount();

            // ============ SWEET ALERT CONFIRMATIONS ============

            // 1. Empty Trash Confirmation
            const emptyTrashBtn = document.getElementById('emptyTrashBtn');
            if (emptyTrashBtn) {
                emptyTrashBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Empty Trash?',
                        text: 'Are you sure you want to permanently delete all posts in trash? This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#084433',
                        confirmButtonText: 'Yes, empty trash!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        customClass: {
                            title: 'swal-title',
                            confirmButton: 'swal-confirm-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('empty-trash-form').submit();
                        }
                    });
                });
            }

            // 4. Bulk Action Confirmation
            const applyBulkActionBtn = document.getElementById('applyBulkActionBtn');
            if (applyBulkActionBtn) {
                applyBulkActionBtn.addEventListener('click', function() {
                    const actionSelect = document.getElementById('actionSelect');
                    const selectedCount = document.querySelectorAll('.select-post:checked').length;
                    const bulkForm = document.getElementById('bulkForm');
                    const bulkAction = document.getElementById('bulkAction');

                    if (selectedCount === 0) {
                        Swal.fire({
                            title: 'No Selection',
                            text: 'Please select at least one post.',
                            icon: 'info',
                            confirmButtonColor: '#084433',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'swal-cancel-btn'
                            }
                        });
                        return;
                    }

                    if (!actionSelect.value) {
                        Swal.fire({
                            title: 'No Action Selected',
                            text: 'Please select a bulk action.',
                            icon: 'info',
                            confirmButtonColor: '#084433',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'swal-cancel-btn'
                            }
                        });
                        return;
                    }

                    const action = actionSelect.value;
                    const actionName = action === 'restore' ? 'restore' : 'permanently delete';
                    const actionColor = action === 'restore' ? '#198754' : '#d33';
                    const actionIcon = action === 'restore' ? 'question' : 'warning';

                    Swal.fire({
                        title: action === 'restore' ? 'Restore Selected Posts?' : 'Delete Selected Posts Permanently?',
                        text: `Are you sure you want to ${actionName} ${selectedCount} ${selectedCount === 1 ? 'post' : 'posts'}?`,
                        icon: actionIcon,
                        showCancelButton: true,
                        confirmButtonColor: actionColor,
                        cancelButtonColor: '#084433',
                        confirmButtonText: action === 'restore' ? 'Yes, restore!' : 'Yes, delete!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        customClass: {
                            title: 'swal-title',
                            confirmButton: action === 'restore' ? 'swal-restore-btn' : 'swal-confirm-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            bulkAction.value = action;
                            bulkForm.submit();
                        }
                    });
                });
            }
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
