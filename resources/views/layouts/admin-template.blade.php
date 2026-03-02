<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Archtech Admin')</title>
    <style>
        /* Copy all the CSS styles from the posts index page here */
        :root {
            --archtech-primary: #084433;
            --archtech-secondary: #5DB996;
            --archtech-light: #118B50;
            --archtech-dark: #063325;
        }
        /* ... all the CSS styles ... */
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Header -->
            <div class="admin-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1 style="color: #084433; margin: 0 0 5px 0;">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-muted" style="margin: 0;">@yield('page-subtitle', 'Admin Panel')</p>
                    </div>
                    <div style="text-align: right;">
                        <span class="text-muted" style="margin-right: 15px;">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ now()->format('F j, Y') }}
                        </span>
                        @yield('header-action')
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

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @stack('scripts')
</body>
</html>
