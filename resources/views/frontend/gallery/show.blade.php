@extends('layouts.frontend')

@section('title', $gallery->name)
@section('description', $gallery->description ?? 'Photo gallery from Shendam Local Government Area.')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#5EDFFF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#E0B973]/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="fade-in-on-scroll">
                <!-- Breadcrumb -->
                <nav class="mb-6 text-sm">
                    <ol class="flex items-center space-x-2 text-gray-300">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition-colors">Gallery</a></li>
                        <li><i data-lucide="chevron-right" class="w-4 h-4"></i></li>
                        <li class="text-white">{{ Str::limit($gallery->name, 30) }}</li>
                    </ol>
                </nav>

                <!-- Type Badge -->
                @if($gallery->type)
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md text-white text-sm font-semibold rounded-lg mb-4">
                        {{ ucfirst($gallery->type) }}
                    </span>
                @endif

                <!-- Title -->
                <h1 class="heading-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    {{ $gallery->name }}
                </h1>

                <!-- Description -->
                @if($gallery->description)
                    <p class="text-lg text-gray-300 max-w-3xl">
                        {{ $gallery->description }}
                    </p>
                @endif

                <!-- Meta -->
                <div class="flex flex-wrap items-center gap-6 text-gray-300 text-sm mt-6">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                        <span>{{ $gallery->created_at->format('F d, Y') }}</span>
                    </div>
                    @if($gallery->user)
                        <div class="flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span>{{ $gallery->user->name }}</span>
                        </div>
                    @endif
                    @if($gallery->images->count() > 0)
                        <div class="flex items-center gap-2">
                            <i data-lucide="image" class="w-5 h-5"></i>
                            <span>{{ $gallery->images->count() }} {{ Str::plural('image', $gallery->images->count()) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Images Section -->
    <section class="py-16 bg-gradient-to-b from-white to-gray-50 section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8 fade-in-on-scroll">
                <a href="{{ route('gallery.index') }}" 
                   class="btn-lift inline-flex items-center px-6 py-3 bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                    Back to Gallery
                </a>
            </div>

            @if($gallery->images->count() > 0)
                <!-- Images Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 stagger-on-scroll">
                    @foreach($gallery->images as $image)
                        <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl overflow-hidden border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item cursor-pointer" 
                             onclick="openLightbox('{{ Storage::url($image->image_path) }}', '{{ $image->title ?? $gallery->name }}', '{{ $image->description ?? '' }}')">
                            <div class="image-scale-hover aspect-square overflow-hidden">
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $image->alt_text ?? $image->title ?? $gallery->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            @if($image->title)
                                <div class="p-4">
                                    <h3 class="text-sm font-semibold text-[#142F32] group-hover:text-[#5EDFFF] transition-colors line-clamp-2">
                                        {{ $image->title }}
                                    </h3>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 fade-in-on-scroll">
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-12 border-2 border-white/50 max-w-md mx-auto">
                        <i data-lucide="image-off" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
                        <h3 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-2">No Images</h3>
                        <p class="text-gray-600">This gallery doesn't have any images yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeLightbox(event)">
        <div class="max-w-6xl w-full relative" onclick="event.stopPropagation()">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-colors z-10">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <img id="lightbox-image" src="" alt="" class="w-full h-auto rounded-lg">
            <div class="mt-4 text-center text-white">
                <h3 id="lightbox-title" class="text-xl font-semibold mb-2"></h3>
                <p id="lightbox-description" class="text-gray-300"></p>
            </div>
        </div>
    </div>

    <script>
        function openLightbox(imageSrc, title, description) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxTitle = document.getElementById('lightbox-title');
            const lightboxDescription = document.getElementById('lightbox-description');
            
            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title || '';
            lightboxDescription.textContent = description || '';
            
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            // Reinitialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        function closeLightbox(event) {
            if (event && event.target !== event.currentTarget) return;
            
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
