@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                            {{ $post->published_at->format('F j, Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>By {{ $post->user->name }}</span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $post->title }}</h1>

                    @if($post->excerpt)
                    <p class="text-xl text-gray-600 italic">{{ $post->excerpt }}</p>
                    @endif
                </header>

                <div class="prose prose-lg max-w-none post-content">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-200">
                    <a href="{{ route('posts.index') }}"
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to all posts
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
