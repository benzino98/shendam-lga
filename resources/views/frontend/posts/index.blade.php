@extends('layouts.frontend')

@section('title', 'News & Updates')
@section('description', 'Stay informed with the latest news, announcements, and updates from Shendam Local Government Area.')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#5EDFFF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#E0B973]/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in-on-scroll">
                <h1 class="heading-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    News & <span class="signature-gradient-text">Updates</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                    Stay informed with the latest announcements, news, and updates from Shendam Local Government Area.
                </p>
            </div>
        </div>
    </section>

    <!-- Posts Listing Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50 section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-12 fade-in-on-scroll">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Category Filter -->
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('posts.index') }}" 
                           class="px-4 py-2 rounded-lg font-medium transition-all {{ !request('category') ? 'bg-[#142F32] text-white' : 'bg-white text-[#142F32] hover:bg-gray-100 border border-gray-200' }}">
                            All Posts
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('posts.index', ['category' => $category->slug]) }}" 
                               class="px-4 py-2 rounded-lg font-medium transition-all {{ request('category') === $category->slug ? 'bg-[#142F32] text-white' : 'bg-white text-[#142F32] hover:bg-gray-100 border border-gray-200' }}">
                                {{ $category->name }} ({{ $category->posts_count }})
                            </a>
                        @endforeach
                    </div>

                    <!-- Search -->
                    <form method="GET" action="{{ route('posts.index') }}" class="flex gap-2">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search posts..." 
                               class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent w-full md:w-64">
                        <button type="submit" class="btn-lift px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-all">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-on-scroll">
                    @foreach($posts as $post)
                        <article class="glass-card bg-white/90 backdrop-blur-md rounded-xl overflow-hidden border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item">
                            <!-- Featured Image -->
                            @if($post->featured_image)
                                <div class="image-scale-hover h-48 overflow-hidden">
                                    <img src="{{ Storage::url($post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-[#142F32] to-[#1a3f44] flex items-center justify-center">
                                    <i data-lucide="file-text" class="w-16 h-16 text-white/30"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Category Badge -->
                                @if($post->category)
                                    <a href="{{ route('posts.index', ['category' => $post->category->slug]) }}" 
                                       class="inline-block px-3 py-1 bg-[#142F32]/10 text-[#142F32] text-xs font-semibold rounded-full mb-3 hover:bg-[#142F32]/20 transition-colors">
                                        {{ $post->category->name }}
                                    </a>
                                @endif

                                <!-- Title -->
                                <h2 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-3 group-hover:text-[#5EDFFF] transition-colors">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <!-- Meta -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($post->user)
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="user" class="w-4 h-4"></i>
                                            <span>{{ $post->user->name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Read More -->
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   class="inline-flex items-center text-[#142F32] hover:text-[#5EDFFF] font-semibold text-sm accent-border group/link">
                                    Read More
                                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2 transition-transform group-hover/link:translate-x-1"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 fade-in-on-scroll">
                    {{ $posts->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 fade-in-on-scroll">
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-12 border-2 border-white/50 max-w-md mx-auto">
                        <i data-lucide="file-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                        <h3 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-2">No Posts Found</h3>
                        <p class="text-gray-600">We couldn't find any posts matching your criteria.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
