<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Archtech - @yield('title', 'Blog')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }

        .post-content p {
            margin-bottom: 1.25rem;
            line-height: 1.75;
            color: #374151;
        }

        .post-content h1,
        .post-content h2,
        .post-content h3 {
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #111827;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-800">

<!-- Navigation -->
<nav class="bg-white/80 backdrop-blur border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-center">
            <a href="/" class="text-2xl font-semibold tracking-tight text-gray-900">
                Archtech
            </a>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sm:p-8">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center text-gray-500 text-sm">
            <p class="font-medium text-gray-600">
                © {{ date('Y') }} Archtech
            </p>

        </div>
    </div>
</footer>

</body>
</html>
