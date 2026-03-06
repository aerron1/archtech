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

    <title>Blog Posts - Archtech Admin</title>
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

            .posts-table {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 8px;
            }

            .posts-table table {
                min-width: 700px;
            }

            .admin-user-info {
                padding: 10px;
            }

            .user-avatar {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .posts-table + div {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .posts-table + div > div:last-child {
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

            .posts-table table {
                min-width: 650px;
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
        }

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
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
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

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-published {
            background: #198754;
            color: white;
        }

        .badge-draft {
            background: #6c757d;
            color: white;
        }

        .badge-pending {
            background: #ffc107;
            color: #212529;
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

        .filters {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filter-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            min-width: 200px;
            background-color: white;
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

                        <a class="nav-link-admin {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
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
            <div class="admin-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="color: #084433; margin: 0 0 5px 0;">Blog Posts</h1>
                        <p class="text-muted" style="margin: 0;">Manage your blog content</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted" style="margin-right: 15px;">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ now()->format('F j, Y') }}
                        </span>
                        <a href="{{ route('admin.posts.create') }}" class="btn-archtech">
                            <i class="fas fa-plus me-1"></i> Create New Post
                        </a>
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

            <!-- Filters -->
            <div class="filters">
                <div class="filter-group">
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="scheduled">Scheduled</option>
                    </select>

                    <select class="filter-select" id="authorFilter">
                        <option value="">All Authors</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="search-input" id="searchInput" placeholder="Search posts...">
                    <button class="search-btn" id="searchBtn">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>

            <!-- Posts Table -->
            <div class="posts-table">
                @if($posts->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <strong>{{ Str::limit($post->title, 50) }}</strong>
                                    @if($post->excerpt)
                                        <br>
                                        <small class="text-muted">{{ Str::limit($post->excerpt, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; flex-shrink: 0;">
                                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                        </div>
                                        <div style="min-width: 0;">
                                            <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $post->user->name }}</div>
                                            <small class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $post->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if(!$post->is_published)
                                        <span class="badge badge-draft">
                                            <i class="fas fa-save me-1"></i> Draft
                                        </span>
                                    @elseif($post->published_at && $post->published_at->isFuture())
                                        <span class="badge badge-pending">
                                            <i class="fas fa-clock me-1"></i> Scheduled
                                        </span>
                                        <br>
                                        <small>{{ $post->published_at->format('M d, Y') }}</small>
                                    @else
                                        <span class="badge badge-published">
                                            <i class="fas fa-check-circle me-1"></i> Published
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>Created:</strong>
                                        {{ $post->created_at->format('M d, Y') }}
                                    </div>
                                    @if($post->published_at)
                                        <div>
                                            <strong>Published:</strong>
                                            {{ $post->published_at->format('M d, Y') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn-outline-primary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn-outline-success" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-outline-danger delete-post" title="Delete" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-posts text-center">
                        <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>
                        <h3 style="color: #084433;">No posts found</h3>
                        <p class="text-muted mb-4">Start by creating your first blog post.</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn-archtech">
                            <i class="fas fa-plus me-2"></i>Create Your First Post
                        </a>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; flex-wrap: wrap; gap: 15px;">
                <div class="text-muted">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                </div>
                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                    @if($posts->onFirstPage())
                        <span class="btn-archtech-outline" style="opacity: 0.5; cursor: not-allowed;">
                            <i class="fas fa-arrow-left"></i> Previous
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="btn-archtech-outline">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    @endif

                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="btn-archtech-outline">
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
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar Functionality
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
                    const filters = document.querySelector('.filters');
                    if (filters) {
                        filters.scrollIntoView({ behavior: 'smooth' });
                        setTimeout(() => {
                            document.getElementById('searchInput')?.focus();
                        }, 500);
                    }
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

            // Filter functionality
            const statusFilter = document.getElementById('statusFilter');
            const authorFilter = document.getElementById('authorFilter');
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');

            function applyFilters() {
                const status = statusFilter.value;
                const author = authorFilter.value;
                const search = searchInput.value;

                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                if (status) params.set('status', status);
                else params.delete('status');

                if (author) params.set('author', author);
                else params.delete('author');

                if (search) params.set('search', search);
                else params.delete('search');

                params.delete('page');

                window.location.href = url.pathname + '?' + params.toString();
            }

            if (statusFilter) statusFilter.addEventListener('change', applyFilters);
            if (authorFilter) authorFilter.addEventListener('change', applyFilters);
            if (searchBtn) searchBtn.addEventListener('click', applyFilters);
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') applyFilters();
                });
            }

            // Set current filter values from URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') && statusFilter) {
                statusFilter.value = urlParams.get('status');
            }
            if (urlParams.get('author') && authorFilter) {
                authorFilter.value = urlParams.get('author');
            }
            if (urlParams.get('search') && searchInput) {
                searchInput.value = urlParams.get('search');
            }

            // Active link highlighting
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link-admin').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // SweetAlert2 Delete Confirmation
            const deleteButtons = document.querySelectorAll('.delete-post');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.dataset.postId;
                    const postTitle = this.dataset.postTitle;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Move "${postTitle}" to trash? You can restore it later.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, move to trash!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        backdrop: `
                            rgba(8,68,51,0.2)
                            left top
                            no-repeat
                        `,
                        customClass: {
                            title: 'swal-title',
                            popup: 'swal-popup',
                            confirmButton: 'swal-confirm-btn',
                            cancelButton: 'swal-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${postId}`).submit();
                        }
                    });
                });
            });
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

        @media (max-width: 992px) {
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
            .admin-header {
                padding: 15px;
            }

            .admin-header h1 {
                font-size: 1.3rem;
            }

            .posts-table td > div {
                font-size: 0.85rem;
            }

            .badge {
                font-size: 0.7rem;
                padding: 3px 6px;
            }

            .btn-group a, .btn-group button {
                padding: 6px 8px;
                font-size: 0.8rem;
            }
        }
    </style>
</body>
</html>
