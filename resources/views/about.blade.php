@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">About Archtech</h1>

            <div class="prose prose-lg max-w-none">
                <p class="text-xl text-gray-600 mb-6">
                    Welcome to Archtech, a modern blogging platform built with Laravel.
                </p>

                <p class="mb-4">
                    Archtech is designed to be a simple, clean, and efficient blogging system
                    where authors can share their thoughts and readers can discover interesting content.
                </p>

                <p class="mb-4">
                    Our platform focuses on providing a seamless reading experience without
                    the need for user accounts or logins. All content is freely accessible
                    to everyone.
                </p>

                <p>
                    For authors and administrators, we provide a secure, separate admin panel
                    to manage all blog content effectively.
                </p>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Features</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Clean, responsive design</li>
                        <li>No login required for readers</li>
                        <li>Secure admin panel for content management</li>
                        <li>Featured images for posts</li>
                        <li>Automatic slug generation</li>
                        <li>Scheduled publishing</li>
                        <li>Search engine optimized URLs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
