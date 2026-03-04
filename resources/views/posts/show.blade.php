@extends('layouts.app')

@section('title', $post->title)

@section('content')
<style>
    .custom-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: var(--primary);
        color: white;
        font-weight: 600;
        border-radius: 9999px;
        box-shadow: 0 4px 6px -1px rgba(1, 101, 99, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .custom-back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(1, 101, 99, 0.4);
        background: var(--primary-dark);
    }

    .custom-back-btn i {
        font-size: 0.875rem;
        transition: transform 0.3s ease;
    }

    .custom-back-btn:hover i {
        transform: translateX(-3px);
    }

    .custom-back-btn::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50px;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transform: skewX(-12deg) translateX(-30px);
        transition: transform 0.5s ease;
    }

    .custom-back-btn:hover::after {
        transform: skewX(-12deg) translateX(100px);
    }
</style>

<div class="min-h-screen flex items-center justify-center py-12">
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($post->featured_image)
            <div class="h-96 overflow-hidden">
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover">
            </div>
            @endif

            <div class="p-8">
                <header class="mb-8">
                    <div class="flex items-center justify-center text-sm text-gray-500 mb-4">
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                            {{ $post->published_at->format('F j, Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>By {{ $post->user->name }}</span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">{{ $post->title }}</h1>

                    @if($post->excerpt)
                    <p class="text-xl text-gray-600 italic text-center max-w-2xl mx-auto">{{ $post->excerpt }}</p>
                    @endif
                </header>

                <div class="prose prose-lg max-w-none post-content">
                    <div class="max-w-3xl mx-auto">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>

                <!-- Back to all posts button - FIXED VERSION -->
                <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                    <a href="{{ route('posts.index') }}" class="custom-back-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to all posts</span>
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
