<!-- resources/views/admin/dashboard.blade.php -->

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

    <title>Dashboard - Archtech Admin</title>
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

        /* SweetAlert2 Custom Styles */
        .swal2-popup {
            border-radius: 10px !important;
            padding: 20px !important;
        }

        .swal2-title {
            color: #084433 !important;
            font-weight: 600 !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #084433 0%, #063325 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3) !important;
        }

        .swal2-cancel {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-cancel:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
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

        /* Dashboard specific styles */
        .stat-card-sm {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border-left: 3px solid var(--archtech-primary);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .stat-icon-sm {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-icon-sm.bg-primary {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
        }

        .stat-icon-sm.bg-success {
            background: linear-gradient(135deg, #198754 0%, #136a43 100%);
        }

        .stat-icon-sm.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        }

        .stat-icon-sm.bg-info {
            background: linear-gradient(135deg, #0dcaf0 0%, #0baccc 100%);
        }

        .stat-number-sm {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--archtech-primary);
            line-height: 1;
        }

        .stat-label-sm {
            color: #666;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }

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

        .list-group {
            border-radius: 8px;
            overflow: hidden;
        }

        .list-group-item {
            padding: 12px 15px;
            border: none;
            border-bottom: 1px solid rgba(8, 68, 51, 0.1);
            background: white;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-archtech {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-archtech thead {
            background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
            color: white;
        }

        .table-archtech th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border: none;
            white-space: nowrap;
        }

        .table-archtech td {
            padding: 15px;
            border-top: 1px solid rgba(8, 68, 51, 0.1);
        }

        .table-archtech tbody tr:hover {
            background-color: rgba(8, 68, 51, 0.03);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -15px;
        }

        .col {
            padding: 15px;
            box-sizing: border-box;
        }

        .col-xl-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-lg-8 {
            flex: 0 0 66.6667%;
            max-width: 66.6667%;
        }

        .col-lg-4 {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }

        @media (max-width: 992px) {
            .col-xl-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-lg-8, .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .col-xl-3, .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-icon-primary {
            border: 1px solid #0d6efd;
            color: #0d6efd;
            background: none;
        }

        .btn-icon-primary:hover {
            background: #0d6efd;
            color: white;
        }

        .btn-icon-success {
            border: 1px solid #198754;
            color: #198754;
            background: none;
        }

        .btn-icon-success:hover {
            background: #198754;
            color: white;
        }

        .btn-icon-danger {
            border: 1px solid #dc3545;
            color: #dc3545;
            background: none;
        }

        .btn-icon-danger:hover {
            background: #dc3545;
            color: white;
        }

        /* New chart styles */
        .trend-badge {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .trend-badge i {
            font-size: 0.9rem;
        }

        .growth-indicator {
            color: #28a745;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .growth-indicator i {
            font-size: 1rem;
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

                        <!-- Projects Menu Item -->
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
                        <h1 style="color: #084433; margin: 0 0 5px 0;">Dashboard</h1>
                        <p class="text-muted" style="margin: 0;">Welcome to Archtech Admin Panel</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted" style="margin-right: 15px;">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ now()->format('F j, Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Flash Messages (Hidden - we'll use SweetAlert instead) -->
            @if(session('success'))
                <div class="alert alert-success" style="display: none;">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="display: none;">{{ session('error') }}</div>
            @endif

            <!-- Contact Submissions Chart - IMPROVED DESIGN -->
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="admin-card-title mb-0">
                            <i class="fas fa-chart-line me-2" style="color: var(--archtech-primary);"></i>Contact Growth Overview
                        </h3>
                        <p class="text-muted mb-0 mt-1">Monthly contact submissions trend</p>
                    </div>
                    <div class="d-flex gap-3 mt-2 mt-sm-0">
                        <div class="text-center px-3">
                            <span class="d-block text-muted small">Total Contacts</span>
                            <span class="h4 mb-0 fw-bold" style="color: var(--archtech-primary);">{{ $totalContacts ?? 0 }}</span>
                        </div>
                        <div class="text-center px-3 border-start">
                            <span class="d-block text-muted small">This Month</span>
                            <span class="h4 mb-0 fw-bold" style="color: #198754;">{{ $contactsThisMonth ?? 0 }}</span>
                        </div>
                        @php
                            $growth = 0;
                            if(isset($contactCounts) && count($contactCounts) >= 2) {
                                $lastMonth = $contactCounts[count($contactCounts)-2] ?? 0;
                                $currentMonth = $contactCounts[count($contactCounts)-1] ?? 0;
                                if($lastMonth > 0) {
                                    $growth = round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
                                }
                            }
                        @endphp
                        @if($growth > 0)
                            <div class="text-center px-3 border-start">
                                <span class="d-block text-muted small">Growth</span>
                                <span class="trend-badge">
                                    <i class="fas fa-arrow-up"></i> {{ $growth }}%
                                </span>
                            </div>
                        @elseif($growth < 0)
                            <div class="text-center px-3 border-start">
                                <span class="d-block text-muted small">Change</span>
                                <span class="trend-badge" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                    <i class="fas fa-arrow-down"></i> {{ abs($growth) }}%
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="admin-card-body">
                    <!-- Chart Container -->
                    <div style="position: relative; height: 350px; width: 100%;">
                        <canvas id="contactChart"></canvas>
                    </div>

                    <!-- Chart Legend and Summary -->
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
                        <div class="d-flex gap-4">
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background: linear-gradient(135deg, #084433 0%, #0a5a4a 100%); border-radius: 4px; margin-right: 8px;"></div>
                                <span class="small fw-medium">Monthly Submissions</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div style="width: 16px; height: 16px; background: linear-gradient(135deg, #fd7e14 0%, #ff9f4b 100%); border-radius: 4px; margin-right: 8px;"></div>
                                <span class="small fw-medium">Growth Trend</span>
                            </div>
                        </div>
                        <div class="growth-indicator mt-2 mt-sm-0">
                            <i class="fas fa-chart-line"></i>
                            <span>Trending: <strong>{{ $growth > 0 ? 'Upward' : ($growth < 0 ? 'Downward' : 'Stable') }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compact Statistics Section -->
            <div class="row">


            <!-- Main Content Area -->
            <div class="row">
                <!-- Left Column - Quick Actions & Recent Posts & Recent Projects -->
                <div class="col col-lg-8 mb-4">
                    <!-- Quick Actions -->
                    <div class="admin-card mb-4">
                        <div class="admin-card-header">
                            <h3 class="admin-card-title mb-0">
                                <i class="fas fa-rocket me-2"></i>Quick Actions
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.posts.create') }}" class="btn-archtech w-100 py-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Create New Post
                                </a>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.projects.create') }}" class="btn-archtech w-100 py-3 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #6610f2 0%, #520dc2 100%);">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Create New Project
                                </a>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.posts.index') }}" class="btn-archtech-outline w-100 py-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-list me-2"></i>
                                    Manage All Posts
                                </a>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.projects.index') }}" class="btn-archtech-outline w-100 py-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-list me-2"></i>
                                    Manage All Projects
                                </a>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.team.create') }}" class="btn-archtech-outline w-100 py-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user-plus me-2"></i>
                                    Add New User
                                </a>
                            </div>
                            <div class="col col-md-6 mb-3">
                                <a href="{{ route('admin.team.index') }}" class="btn-archtech-outline w-100 py-3 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users me-2"></i>
                                    Manage Team
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="admin-card mb-4">
                        <div class="admin-card-header d-flex justify-content-between align-items-center">
                            <h3 class="admin-card-title mb-0">
                                <i class="fas fa-history me-2"></i>Recent Posts
                            </h3>
                            <a href="{{ route('admin.posts.index') }}" class="btn-archtech-outline btn-sm">
                                View All
                            </a>
                        </div>

                        @if(isset($recentPosts) && $recentPosts->count() > 0)
                            <div class="table-responsive">
                                <table class="table-archtech">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentPosts as $post)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <strong class="mb-1">{{ Str::limit($post->title, 40) }}</strong>
                                                    <small class="text-muted">By {{ $post->user->name ?? 'Unknown' }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($post->is_published && $post->published_at <= now())
                                                    <span class="badge badge-success">Published</span>
                                                @elseif($post->is_published && $post->published_at > now())
                                                    <span class="badge badge-warning">Scheduled</span>
                                                @else
                                                    <span class="badge badge-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($post->published_at)
                                                    <span class="text-small">{{ $post->published_at->format('M d, Y') }}</span>
                                                @else
                                                    <span class="text-muted text-small">No date set</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('posts.show', $post) }}" target="_blank" class="btn-icon btn-icon-primary" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn-icon btn-icon-success" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn-icon btn-icon-danger delete-post-btn" title="Delete"
                                                            data-post-id="{{ $post->id }}"
                                                            data-post-title="{{ $post->title }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-post-form-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display: none;">
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
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-3">No posts found. Create your first post!</p>
                                <a href="{{ route('admin.posts.create') }}" class="btn-archtech">
                                    <i class="fas fa-plus me-2"></i>Create First Post
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Recent Projects -->
                    <div class="admin-card">
                        <div class="admin-card-header d-flex justify-content-between align-items-center">
                            <h3 class="admin-card-title mb-0">
                                <i class="fas fa-project-diagram me-2" style="color: #6610f2;"></i>Recent Projects
                            </h3>
                            <a href="{{ route('admin.projects.index') }}" class="btn-archtech-outline btn-sm">
                                View All
                            </a>
                        </div>

                        @if(isset($recentProjects) && $recentProjects->count() > 0)
                            <div class="table-responsive">
                                <table class="table-archtech">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title / Location</th>
                                            <th>Status</th>
                                            <th>Featured</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentProjects as $project)
                                        <tr>
                                            <td>
                                                @if($project->featured_image)
                                                    <img src="{{ asset('storage/' . $project->featured_image) }}"
                                                         alt="{{ $project->title }}"
                                                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                                                @else
                                                    <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-image text-muted" style="font-size: 12px;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <strong class="mb-1">{{ Str::limit($project->title, 30) }}</strong>
                                                    <small class="text-muted">
                                                        <i class="fas fa-map-marker-alt me-1" style="font-size: 10px;"></i>
                                                        {{ Str::limit($project->location, 25) }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($project->status == 'completed')
                                                    <span class="badge" style="background: #198754; color: white;">Completed</span>
                                                @elseif($project->status == 'ongoing')
                                                    <span class="badge" style="background: #ffc107; color: #212529;">Ongoing</span>
                                                @else
                                                    <span class="badge" style="background: #6c757d; color: white;">Planned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($project->is_featured)
                                                    <span class="badge" style="background: #6610f2; color: white;">
                                                        <i class="fas fa-star me-1"></i>Featured
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($project->project_date)
                                                    {{ $project->project_date->format('M Y') }}
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                                       class="btn-icon btn-icon-success"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                            class="btn-icon btn-icon-danger delete-project"
                                                            title="Delete"
                                                            data-project-id="{{ $project->id }}"
                                                            data-project-title="{{ $project->title }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <form id="delete-project-form-{{ $project->id }}"
                                                          action="{{ route('admin.projects.destroy', $project) }}"
                                                          method="POST"
                                                          style="display: none;">
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
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-3">No projects found. Create your first project!</p>
                                <a href="{{ route('admin.projects.create') }}" class="btn-archtech" style="background: linear-gradient(135deg, #6610f2 0%, #520dc2 100%);">
                                    <i class="fas fa-plus me-2"></i>Create First Project
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column - System Info & Updated Stats -->
                <div class="col col-lg-4 mb-4">
                    <!-- Quick Stats - Updated with Project Stats -->
                    <div class="admin-card mb-4">
                        <div class="admin-card-header">
                            <h3 class="admin-card-title mb-0">
                                <i class="fas fa-chart-bar me-2"></i>Quick Stats
                            </h3>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-newspaper me-2 text-primary"></i>Total Posts</span>
                                <strong>{{ $totalPosts ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-envelope me-2" style="color: var(--archtech-primary);"></i>Total Contacts</span>
                                <strong>{{ $totalContacts ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-project-diagram me-2" style="color: #6610f2;"></i>Total Projects</span>
                                <strong>{{ $totalProjects ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-check-circle me-2 text-success"></i>Completed Projects</span>
                                <strong>{{ $completedProjects ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-spinner me-2 text-warning"></i>Ongoing Projects</span>
                                <strong>{{ $ongoingProjects ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-star me-2" style="color: #fd7e14;"></i>Featured Projects</span>
                                <strong>{{ $featuredProjects ?? 0 }}</strong>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-calendar-alt me-2 text-info"></i>Posts this month</span>
                                <strong>{{ $postsThisMonth ?? 0 }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity - Updated with Project Activities -->
                    <div class="admin-card">
                        <div class="admin-card-header">
                            <h3 class="admin-card-title mb-0">
                                <i class="fas fa-bell me-2"></i>Recent Activity
                            </h3>
                        </div>
                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @if(isset($recentActivities) && count($recentActivities) > 0)
                                @foreach($recentActivities as $activity)
                                <div class="list-group-item">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="fas fa-{{ $activity['icon'] ?? 'circle' }}" style="color: {{
                                                $activity['color'] == 'success' ? '#198754' :
                                                ($activity['color'] == 'primary' ? '#0d6efd' :
                                                ($activity['color'] == 'info' ? '#0dcaf0' :
                                                ($activity['color'] == 'warning' ? '#ffc107' :
                                                ($activity['color'] == 'project' ? '#6610f2' : '#6c757d'))))
                                            }};"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="text-muted">{{ $activity['time'] ?? 'Just now' }}</small>
                                                @if(isset($activity['badge']))
                                                    <span class="badge" style="background: {{
                                                        $activity['badge_type'] == 'success' ? '#198754' :
                                                        ($activity['badge_type'] == 'primary' ? '#0d6efd' :
                                                        ($activity['badge_type'] == 'info' ? '#0dcaf0' :
                                                        ($activity['badge_type'] == 'warning' ? '#ffc107' :
                                                        ($activity['badge_type'] == 'project' ? '#6610f2' : '#6c757d'))))
                                                    }}; color: white; font-size: 10px;">
                                                        {{ $activity['badge'] }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="mb-0 text-small">{{ $activity['message'] ?? 'No activity' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-bell-slash fa-2x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No recent activity</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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

            // SweetAlert2 notification for success
            @if(session('success'))
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#fff',
                    customClass: {
                        title: 'swal2-title',
                        popup: 'swal2-popup'
                    }
                });
            @endif

            // SweetAlert2 notification for error
            @if(session('error'))
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                    timer: 3000,
                    background: '#fff',
                    customClass: {
                        title: 'swal2-title',
                        popup: 'swal2-popup',
                        confirmButton: 'swal2-confirm'
                    }
                });
            @endif

            // SweetAlert2 Delete Confirmation for Posts
            const postDeleteButtons = document.querySelectorAll('.delete-post-btn');
            postDeleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.dataset.postId;
                    const postTitle = this.dataset.postTitle;

                    Swal.fire({
                        title: 'Move to Trash?',
                        text: `Are you sure you want to move "${postTitle}" to trash? You can restore it later.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#084433',
                        confirmButtonText: 'Yes, move to trash!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        customClass: {
                            title: 'swal2-title',
                            popup: 'swal2-popup',
                            confirmButton: 'swal2-confirm',
                            cancelButton: 'swal2-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: 'Moving to Trash...',
                                text: 'Please wait...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Submit the form
                            document.getElementById(`delete-post-form-${postId}`).submit();
                        }
                    });
                });
            });

            // SweetAlert2 Delete Confirmation for Projects
            const projectDeleteButtons = document.querySelectorAll('.delete-project');
            projectDeleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const projectId = this.dataset.projectId;
                    const projectTitle = this.dataset.projectTitle;

                    Swal.fire({
                        title: 'Move to Trash?',
                        text: `Are you sure you want to move "${projectTitle}" to trash? You can restore it later.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6610f2',
                        confirmButtonText: 'Yes, move to trash!',
                        cancelButtonText: 'Cancel',
                        background: '#fff',
                        customClass: {
                            title: 'swal2-title',
                            popup: 'swal2-popup',
                            confirmButton: 'swal2-confirm',
                            cancelButton: 'swal2-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: 'Moving to Trash...',
                                text: 'Please wait...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Submit the form
                            document.getElementById(`delete-project-form-${projectId}`).submit();
                        }
                    });
                });
            });

            // Auto-dismiss alerts after 5 seconds (fallback)
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // Initialize Contact Chart with improved design
            initializeContactChart();
        });

        function initializeContactChart() {
            const ctx = document.getElementById('contactChart');
            if (!ctx) return;

            // Get data from PHP
            const months = @json($months ?? []);
            const contactCounts = @json($contactCounts ?? []);

            // Calculate average and trend
            const average = contactCounts.length > 0
                ? (contactCounts.reduce((a, b) => a + b, 0) / contactCounts.length).toFixed(1)
                : 0;

            // Create gradient for bars
            const ctx2 = ctx.getContext('2d');
            const gradient = ctx2.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, '#084433');
            gradient.addColorStop(0.6, '#0a5a4a');
            gradient.addColorStop(1, '#118B50');

            // Create gradient for trend line area
            const gradientArea = ctx2.createLinearGradient(0, 0, 0, 400);
            gradientArea.addColorStop(0, 'rgba(253, 126, 20, 0.2)');
            gradientArea.addColorStop(0.7, 'rgba(253, 126, 20, 0.05)');
            gradientArea.addColorStop(1, 'rgba(253, 126, 20, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Monthly Submissions',
                            data: contactCounts,
                            type: 'bar',
                            backgroundColor: gradient,
                            hoverBackgroundColor: '#0a6e5a',
                            borderRadius: 8,
                            barPercentage: 0.6,
                            categoryPercentage: 0.7,
                            order: 2
                        },
                        {
                            label: 'Trend Line',
                            data: contactCounts,
                            type: 'line',
                            borderColor: '#fd7e14',
                            borderWidth: 3,
                            pointBackgroundColor: '#fd7e14',
                            pointBorderColor: 'white',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: '#ff9f4b',
                            pointHoverBorderColor: 'white',
                            pointHoverBorderWidth: 3,
                            fill: true,
                            backgroundColor: gradientArea,
                            tension: 0.4,
                            order: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.9)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(8, 68, 51, 0.5)',
                            borderWidth: 2,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y + ' submission' + (context.parsed.y !== 1 ? 's' : '');
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false,
                            },
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return value;
                                },
                                font: {
                                    size: 11,
                                    weight: '500'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Number of Submissions',
                                color: '#666',
                                font: {
                                    size: 11,
                                    weight: '500'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    weight: '500'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Month',
                                color: '#666',
                                font: {
                                    size: 11,
                                    weight: '500'
                                }
                            }
                        }
                    },
                    onClick: function(event, items) {
                        if (items && items.length > 0) {
                            const index = items[0].index;
                            const month = months[index];
                            const count = contactCounts[index];

                            Swal.fire({
                                title: month,
                                html: `
                                    <div style="text-align: center;">
                                        <div style="font-size: 3.5rem; color: var(--archtech-primary); font-weight: bold; margin: 10px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                                            ${count}
                                        </div>
                                        <div style="color: #666; font-size: 1.1rem;">
                                            contact submission${count !== 1 ? 's' : ''}
                                        </div>
                                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                                            <div class="growth-indicator" style="justify-content: center;">
                                                <i class="fas fa-chart-line" style="color: #fd7e14;"></i>
                                                <span style="color: #666;">${index > 0 ? (count > contactCounts[index-1] ? '↑ Higher than previous' : (count < contactCounts[index-1] ? '↓ Lower than previous' : '↔ Same as previous')) : 'Starting point'}</span>
                                            </div>
                                        </div>
                                    </div>
                                `,
                                icon: 'info',
                                confirmButtonColor: 'var(--archtech-primary)',
                                confirmButtonText: 'OK',
                                background: '#fff',
                                customClass: {
                                    popup: 'swal2-popup',
                                    title: 'swal2-title',
                                    confirmButton: 'swal2-confirm'
                                }
                            });
                        }
                    }
                }
            });
        }
    </script>

    <style>
        /* Custom SweetAlert2 Styles */
        .swal2-title {
            color: #084433 !important;
            font-weight: 600 !important;
        }

        .swal2-popup {
            border-radius: 10px !important;
            padding: 20px !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #084433 0%, #063325 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3) !important;
        }

        .swal2-cancel {
            background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important;
            border: none !important;
            border-radius: 5px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
        }

        .swal2-cancel:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
        }

        /* Loading spinner styles */
        .swal2-loading {
            border-color: var(--archtech-primary) !important;
        }

        /* Chart responsive styles */
        @media (max-width: 768px) {
            .admin-card-header {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .admin-card-header > div:last-child {
                width: 100%;
                justify-content: space-between !important;
                margin-top: 10px;
            }

            .admin-card-header .text-center {
                flex: 1;
                padding: 5px !important;
            }

            .admin-card-header .h4 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .admin-card-header .h4 {
                font-size: 1rem;
            }

            .admin-card-header .small {
                font-size: 0.7rem;
            }

            #contactChart {
                height: 280px !important;
            }

            .trend-badge {
                font-size: 0.75rem;
                padding: 3px 10px;
            }

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
</body>
</html>
