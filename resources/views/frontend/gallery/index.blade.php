@extends('layouts.frontend')

@section('title', 'Photo Gallery')
@section('description', 'Browse our photo gallery showcasing events, projects, and activities of Shendam Local Government Area.')

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
                    Photo <span class="signature-gradient-text">Gallery</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                    Explore our collection of photos showcasing events, projects, and activities of Shendam Local Government Area.
                </p>
            </div>
        </div>
    </section>

    <!-- Gallery Listing Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50 section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-on-scroll">
                    @foreach($galleries as $gallery)
                        <article class="glass-card bg-white/90 backdrop-blur-md rounded-xl overflow-hidden border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item">
                            <!-- Gallery Cover Image -->
                            @if($gallery->images->count() > 0)
                                <div class="image-scale-hover h-64 overflow-hidden relative">
                                    <img src="{{ Storage::url($gallery->images->first()->image_path) }}" 
                                         alt="{{ $gallery->name }}" 
                                         class="w-full h-full object-cover">
                                    <!-- Image Count Badge -->
                                    <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-2">
                                        <i data-lucide="image" class="w-4 h-4"></i>
                                        {{ $gallery->images->count() }}
                                    </div>
                                </div>
                            @else
                                <div class="h-64 bg-gradient-to-br from-[#142F32] to-[#1a3f44] flex items-center justify-center">
                                    <i data-lucide="images" class="w-16 h-16 text-white/30"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Type Badge -->
                                @if($gallery->type)
                                    <span class="inline-block px-3 py-1 bg-[#142F32]/10 text-[#142F32] text-xs font-semibold rounded-full mb-3">
                                        {{ ucfirst($gallery->type) }}
                                    </span>
                                @endif

                                <!-- Title -->
                                <h2 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-3 group-hover:text-[#5EDFFF] transition-colors">
                                    <a href="{{ route('gallery.show', $gallery->slug) }}" class="hover:underline">
                                        {{ $gallery->name }}
                                    </a>
                                </h2>

                                <!-- Description -->
                                @if($gallery->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $gallery->description }}
                                    </p>
                                @endif

                                <!-- Meta -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4"></i>
                                        <span>{{ $gallery->created_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($gallery->user)
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="user" class="w-4 h-4"></i>
                                            <span>{{ $gallery->user->name }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- View Gallery -->
                                <a href="{{ route('gallery.show', $gallery->slug) }}" 
                                   class="btn-lift inline-flex items-center w-full justify-center px-6 py-3 bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all">
                                    View Gallery
                                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 fade-in-on-scroll">
                    {{ $galleries->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 fade-in-on-scroll">
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-12 border-2 border-white/50 max-w-md mx-auto">
                        <i data-lucide="images" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                        <h3 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-2">No Galleries Found</h3>
                        <p class="text-gray-600">We don't have any galleries available at the moment.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
