@extends('layouts.frontend')

@section('title', $post->meta_title ?? $post->title)
@section('description', $post->meta_description ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#5EDFFF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#E0B973]/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="fade-in-on-scroll">
                <!-- Breadcrumb -->
                <nav class="mb-6 text-sm">
                    <ol class="flex items-center space-x-2 text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-white transition-colors">News</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li class="text-white">{{ Str::limit($post->title, 30) }}</li>
                    </ol>
                </nav>

                <!-- Category Badge -->
                @if($post->category)
                    <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}" 
                       class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md text-white text-sm font-semibold rounded-lg mb-4 hover:bg-white/20 transition-colors">
                        {{ $post->category->name }}
                    </a>
                @endif

                <!-- Title -->
                <h1 class="heading-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    {{ $post->title }}
                </h1>

                <!-- Meta -->
                <div class="flex flex-wrap items-center gap-6 text-gray-300 text-sm">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                    @if($post->user)
                        <div class="flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span>{{ $post->user->name }}</span>
                        </div>
                    @endif
                    @if($post->tags->count() > 0)
                        <div class="flex items-center gap-2 flex-wrap">
                            <i data-lucide="tag" class="w-5 h-5"></i>
                            @foreach($post->tags as $tag)
                                <span class="px-2 py-1 bg-white/10 rounded text-xs">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content Section -->
    <section class="py-16 bg-gradient-to-b from-white to-gray-50 section-overlap section-transition">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <article class="lg:col-span-2 fade-in-on-scroll">
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl shadow-xl p-8 md:p-12 border-2 border-white/50">
                        <!-- Featured Image -->
                        @if($post->featured_image)
                            <div class="mb-8 rounded-xl overflow-hidden image-scale-hover">
                                <img src="{{ Storage::url($post->featured_image) }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-auto">
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! $post->content !!}
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="heading-display-2 font-semibold text-[#142F32] mb-4">Share this post</h3>
                            <div class="flex items-center gap-3">
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-[#142F32]/10 hover:bg-[#142F32] text-[#142F32] hover:text-white rounded-lg flex items-center justify-center transition-colors">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-[#142F32]/10 hover:bg-[#142F32] text-[#142F32] hover:text-white rounded-lg flex items-center justify-center transition-colors">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                   target="_blank"
                                   class="w-10 h-10 bg-[#142F32]/10 hover:bg-[#142F32] text-[#142F32] hover:text-white rounded-lg flex items-center justify-center transition-colors">
                                    <i data-lucide="linkedin" class="w-5 h-5"></i>
                                </a>
                                <button onclick="navigator.clipboard.writeText('{{ request()->url() }}')" 
                                        class="w-10 h-10 bg-[#142F32]/10 hover:bg-[#142F32] text-[#142F32] hover:text-white rounded-lg flex items-center justify-center transition-colors">
                                    <i data-lucide="link" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 space-y-6 slide-up-on-scroll">
                    <!-- Back to Posts -->
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50">
                        <a href="{{ route('posts.index') }}" 
                           class="btn-lift inline-flex items-center w-full justify-center px-6 py-3 bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all">
                            <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                            Back to All Posts
                        </a>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                        <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50">
                            <h3 class="heading-display-2 font-semibold text-[#142F32] mb-4">Related Posts</h3>
                            <div class="space-y-4">
                                @foreach($relatedPosts as $relatedPost)
                                    <a href="{{ route('posts.show', $relatedPost->slug) }}" 
                                       class="block group">
                                        <div class="flex gap-3">
                                            @if($relatedPost->featured_image)
                                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0 image-scale-hover">
                                                    <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                                         alt="{{ $relatedPost->title }}" 
                                                         class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <h4 class="text-sm font-semibold text-[#142F32] group-hover:text-[#5EDFFF] transition-colors line-clamp-2">
                                                    {{ $relatedPost->title }}
                                                </h4>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $relatedPost->published_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
