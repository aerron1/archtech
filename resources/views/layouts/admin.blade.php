<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Archtech Admin Dashboard</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('homepage/file/assets/faviconlogo.png') }}" />

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('homepage/file/css/styles.css') }}" rel="stylesheet" />

        <!-- Admin Custom CSS -->
        <style>
            :root {
                --archtech-primary: #084433;
                --archtech-secondary: #5DB996;
                --archtech-light: #118B50;
                --archtech-dark: #063325;
            }

            body {
                background-color: #f8f9fa;
                font-family: 'Roboto Slab', serif;
            }

            .admin-sidebar {
                background: linear-gradient(180deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
                color: white;
                min-height: 100vh;
                position: fixed;
                width: 250px;
                z-index: 1000;
                box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            }

            .admin-main {
                margin-left: 250px;
                padding: 20px;
                min-height: 100vh;
            }

            .admin-header {
                background: white;
                padding: 15px 25px;
                border-radius: 10px;
                margin-bottom: 25px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
                border-left: 4px solid var(--archtech-primary);
            }

            .admin-card {
                background: white;
                border-radius: 10px;
                padding: 25px;
                margin-bottom: 25px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                border: 1px solid rgba(8, 68, 51, 0.1);
                transition: all 0.3s ease;
            }

            .admin-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
            }

            .stat-card {
                background: white;
                border-radius: 10px;
                padding: 20px;
                text-align: center;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
                border-top: 4px solid var(--archtech-primary);
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            }

            .stat-number {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--archtech-primary);
                margin: 10px 0;
            }

            .stat-label {
                color: #666;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .stat-icon {
                font-size: 2.5rem;
                color: var(--archtech-secondary);
                margin-bottom: 10px;
            }

            .btn-archtech {
                background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
                color: white;
                border: none;
                padding: 10px 25px;
                border-radius: 5px;
                font-weight: 600;
                transition: all 0.3s ease;
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
            }

            .btn-archtech-outline:hover {
                background: var(--archtech-primary);
                color: white;
                transform: translateY(-2px);
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

            .admin-logo {
                padding: 25px 20px;
                text-align: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .admin-logo img {
                height: 60px;
            }

            .admin-user-info {
                padding: 20px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                text-align: center;
            }

            .user-avatar {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 15px;
                color: white;
                font-size: 1.5rem;
                font-weight: 600;
            }

            .table-archtech {
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
                border: none;
                font-weight: 600;
                padding: 15px;
            }

            .table-archtech td {
                padding: 15px;
                vertical-align: middle;
                border-top: 1px solid rgba(8, 68, 51, 0.1);
            }

            .badge-archtech {
                background: linear-gradient(135deg, var(--archtech-secondary) 0%, var(--archtech-light) 100%);
                color: white;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .badge-draft {
                background: #6c757d;
                color: white;
            }

            .badge-published {
                background: #198754;
                color: white;
            }

            .badge-pending {
                background: #ffc107;
                color: #212529;
            }

            .pagination-archtech .page-link {
                color: var(--archtech-primary);
                border: 1px solid rgba(8, 68, 51, 0.2);
            }

            .pagination-archtech .page-item.active .page-link {
                background: var(--archtech-primary);
                border-color: var(--archtech-primary);
                color: white;
            }

            .alert-archtech {
                border-radius: 8px;
                border: none;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            }

            .alert-archtech-success {
                background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
                border-left: 4px solid #198754;
                color: #0f5132;
            }

            .alert-archtech-danger {
                background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
                border-left: 4px solid #dc3545;
                color: #721c24;
            }

            .alert-archtech-warning {
                background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
                border-left: 4px solid #ffc107;
                color: #856404;
            }

            .alert-archtech-info {
                background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
                border-left: 4px solid #17a2b8;
                color: #0c5460;
            }

            @media (max-width: 768px) {
                .admin-sidebar {
                    width: 70px;
                }

                .admin-main {
                    margin-left: 70px;
                }

                .nav-link-admin span {
                    display: none;
                }

                .admin-logo img {
                    height: 40px;
                }

                .nav-link-admin {
                    justify-content: center;
                    padding: 15px 10px;
                }

                .nav-link-admin i {
                    font-size: 1.2rem;
                }

                .admin-user-info .user-name {
                    display: none;
                }
            }
        </style>

        @stack('styles')
    </head>
    <body>
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="admin-sidebar">
                <div class="admin-logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('homepage/file/assets/img/navbar-logo.png') }}" alt="Archtech Admin">
                    </a>
                </div>

                <nav class="nav flex-column p-3">
                    <a class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>

                    <a class="nav-link-admin {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Blog Posts</span>
                    </a>

                    <a class="nav-link-admin {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                        <i class="fas fa-cogs"></i>
                        <span>Services</span>
                    </a>

                    <a class="nav-link-admin {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                        <i class="fas fa-boxes"></i>
                        <span>Products</span>
                    </a>

                    <a class="nav-link-admin {{ request()->routeIs('admin.team.*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Team Members</span>
                    </a>

                    <a class="nav-link-admin {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>

                    <div class="mt-4 pt-3 border-top border-white-10">
                        <a class="nav-link-admin" href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            <span>View Website</span>
                        </a>

                        <a class="nav-link-admin" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user"></i>
                            <span>My Profile</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="nav-link-admin w-100 text-left" style="background: none; border: none;">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </nav>

                <div class="admin-user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-name text-white fw-bold">
                        {{ Auth::user()->name }}
                    </div>
                    <small class="text-white-50">{{ Auth::user()->email }}</small>
                </div>
            </div>

            <!-- Main Content -->
            <div class="admin-main">
                <!-- Header -->
                <div class="admin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0 fw-bold" style="color: var(--archtech-primary);">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-muted mb-0">@yield('page-subtitle', 'Admin Panel')</p>
                        </div>
                        <div class="text-end">
                            <span class="text-muted me-3">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ now()->format('F j, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="container-fluid p-0">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-archtech alert-archtech-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-archtech alert-archtech-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-archtech alert-archtech-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Admin Custom JS -->
        <script>
            // Auto-hide alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);

                // Active link highlighting
                const currentPath = window.location.pathname;
                document.querySelectorAll('.nav-link-admin').forEach(link => {
                    if (link.href.includes(currentPath)) {
                        link.classList.add('active');
                    }
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>
