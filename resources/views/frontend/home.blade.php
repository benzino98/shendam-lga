@extends('layouts.frontend')

@section('title', 'Home')
@section('description', 'Official website of Shendam Local Government Area')

@section('content')
    <!-- Hero Section - Enhanced with Animations -->
    <section class="gradient-mesh text-white py-20 lg:py-32 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Geometric shapes - More visible -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#5EDFFF]/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#E0B973]/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <!-- SVG Decorative Elements - More visible -->
            <svg class="absolute top-0 right-0 w-1/2 h-full opacity-20" viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0 L800 300 L0 600 Z" fill="url(#gradient1)" />
                <defs>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#5EDFFF;stop-opacity:0.5" />
                        <stop offset="100%" style="stop-color:#E0B973;stop-opacity:0.3" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <!-- Headline - Fade in on load -->
                    <div class="fade-in">
                        <h1 class="heading-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-[1.1]">
                            Building a Better Future for <span class="signature-gradient-text">Shendam</span>
                        </h1>
                    </div>
                    
                    <!-- Subtext - Slide up -->
                    <div class="slide-up" style="animation-delay: 0.2s;">
                        <p class="text-lg md:text-xl lg:text-2xl text-gray-200 mb-8 leading-relaxed max-w-2xl">
                            Committed to transparent governance, community development, and serving the people of Shendam Local Government Area with excellence and integrity.
                        </p>
                    </div>
                    
                    <!-- CTA Buttons - Enhanced -->
                    <div class="flex flex-col sm:flex-row gap-4 slide-up" style="animation-delay: 0.4s;">
                        <a href="{{ route('about') }}" class="btn-lift inline-flex items-center justify-center px-8 py-4 bg-white text-[#142F32] font-bold text-lg rounded-lg shadow-xl hover:shadow-2xl hover:bg-gray-50 transition-all duration-300 group relative z-20">
                            <span>Learn More</span>
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('documents.index') }}" class="btn-lift inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-md border-2 border-white text-white font-bold text-lg rounded-lg hover:bg-white/20 hover:border-[#5EDFFF] hover:shadow-xl transition-all duration-300 group relative z-20">
                            <span>View Documents</span>
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Content - Stats Cards -->
                <div class="relative z-10">
                    <!-- Glassmorphism Stats Container - More Visible -->
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-8 border-2 border-white/30 shadow-2xl relative z-20">
                        <div class="grid grid-cols-2 gap-6">
                            <!-- Stat 1 -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border-2 border-white/20 card-lift group shadow-lg hover:bg-white/15 transition-all">
                                <div class="text-4xl lg:text-5xl font-bold mb-2 drop-shadow-lg">
                                    <span data-counter="100" data-suffix="+" style="color: #5EDFFF !important;">0+</span>
                                </div>
                                <div class="text-sm text-gray-200 font-medium flex items-center">
                                    <i data-lucide="briefcase" class="w-4 h-4 mr-2 text-white"></i>
                                    Projects Completed
                                </div>
                            </div>
                            
                            <!-- Stat 2 -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border-2 border-white/20 card-lift group shadow-lg hover:bg-white/15 transition-all">
                                <div class="text-4xl lg:text-5xl font-bold mb-2 drop-shadow-lg">
                                    <span data-counter="50" data-suffix="K+" style="color: #E0B973 !important;">0K+</span>
                                </div>
                                <div class="text-sm text-gray-200 font-medium flex items-center">
                                    <i data-lucide="users" class="w-4 h-4 mr-2 text-white"></i>
                                    Citizens Served
                                </div>
                            </div>
                            
                            <!-- Stat 3 -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border-2 border-white/20 card-lift group shadow-lg hover:bg-white/15 transition-all">
                                <div class="text-4xl lg:text-5xl font-bold mb-2 drop-shadow-lg">
                                    <span data-counter="15" data-suffix="+" style="color: #5EDFFF !important;">0+</span>
                                </div>
                                <div class="text-sm text-gray-200 font-medium flex items-center">
                                    <i data-lucide="building-2" class="w-4 h-4 mr-2 text-white"></i>
                                    Departments
                                </div>
                            </div>
                            
                            <!-- Stat 4 -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border-2 border-white/20 card-lift group shadow-lg hover:bg-white/15 transition-all">
                                <div class="text-4xl lg:text-5xl font-bold mb-2 drop-shadow-lg">
                                    <span style="color: #E0B973 !important;">24/7</span>
                                </div>
                                <div class="text-sm text-gray-200 font-medium flex items-center">
                                    <i data-lucide="clock" class="w-4 h-4 mr-2 text-white"></i>
                                    Service Available
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating decorative elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#5EDFFF]/20 rounded-full blur-2xl animate-pulse"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-[#E0B973]/20 rounded-full blur-2xl animate-pulse" style="animation-delay: 1.5s;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wave Divider -->
    <x-section-divider type="wave" color="#f9fafb" />

    <!-- Chairman's Message Section - Trust Element -->
    <section class="py-20 bg-white section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Portrait Image -->
                <div class="fade-in-on-scroll order-2 lg:order-1">
                    <div class="relative">
                        <div class="glass-card bg-gradient-to-br from-[#142F32] to-[#1a3f44] rounded-2xl p-8 border-2 border-white/50 depth-layer-4 overflow-hidden">
                            <!-- Chairman's portrait -->
                            <div class="aspect-square rounded-xl relative overflow-hidden pt-6">
                                <img 
                                    src="{{ asset('Hon Chairman.jpg.jpeg') }}" 
                                    alt="Executive Chairman - Shendam Local Government Area"
                                    class="w-full h-full object-cover"
                                    style="object-position: center top;"
                                    loading="lazy"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>
                            <!-- Decorative elements -->
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#5EDFFF]/20 rounded-full blur-2xl"></div>
                            <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-[#E0B973]/20 rounded-full blur-2xl"></div>
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="slide-up-on-scroll order-1 lg:order-2">
                    <div class="mb-4">
                        <span class="inline-block px-4 py-2 bg-[#142F32]/10 text-[#142F32] font-semibold rounded-full text-sm mb-4">
                            Leadership Message
                        </span>
                    </div>
                    <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-6">
                        A Message from Our <span class="signature-gradient-text">Chairman</span>
                    </h2>
                    <div class="prose prose-lg max-w-none mb-6">
                        <p class="text-lg text-gray-700 leading-relaxed mb-4">
                            "It is with great pleasure that I welcome you to the official website of Shendam Local Government Area. Our commitment to transparent governance, community development, and excellent service delivery remains unwavering."
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed mb-4">
                            We are dedicated to building a better future for all residents of Shendam, fostering sustainable development, and ensuring that every citizen has access to quality services and opportunities for growth.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Together, we will continue to work towards making Shendam a model local government area known for excellence, integrity, and citizen-centered governance."
                        </p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="font-semibold text-[#142F32] text-lg">Executive Chairman</p>
                        <p class="text-gray-600">Shendam Local Government Area</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wave Divider (Flipped) -->
    <x-section-divider type="wave" flip="true" color="#142F32" />

    <!-- Services/Departments Section - Enhanced Glassmorphism -->
    <section class="py-20 bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white relative overflow-hidden section-overlap section-transition">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#5EDFFF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#E0B973]/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 slide-up-on-scroll">
                <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Our Departments & Services</h2>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                    Comprehensive services designed to meet the needs of our community with efficiency and excellence
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-on-scroll">
                @foreach([
                    ['icon' => 'building-2', 'title' => 'Administration', 'desc' => 'Efficient governance and administrative services'],
                    ['icon' => 'dollar-sign', 'title' => 'Finance & Budget', 'desc' => 'Transparent financial management and budget planning'],
                    ['icon' => 'heart', 'title' => 'Health Services', 'desc' => 'Quality healthcare services for all citizens'],
                    ['icon' => 'book-open', 'title' => 'Education', 'desc' => 'Promoting quality education and learning'],
                    ['icon' => 'hammer', 'title' => 'Works & Infrastructure', 'desc' => 'Building and maintaining public infrastructure'],
                    ['icon' => 'map', 'title' => 'Planning & Development', 'desc' => 'Strategic planning for sustainable development'],
                ] as $index => $service)
                <div class="glass-card-dark bg-white/10 backdrop-blur-md rounded-xl p-6 border-2 border-white/20 depth-layer-3 card-lift card-accent-border card-glow group stagger-item">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 icon-hover group-hover:bg-white/30 transition-all icon-bounce">
                        <i data-lucide="{{ $service['icon'] }}" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-semibold mb-3 group-hover:text-[#5EDFFF] transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">{{ $service['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Curve Divider -->
    <x-section-divider type="curve" color="#ffffff" />

    <!-- Quick Access Section - Modern Navigation Cards -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 slide-up-on-scroll">
                <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-4">
                    Quick <span class="signature-gradient-text">Access</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Navigate to key sections and resources with ease
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-on-scroll">
                @foreach([
                    [
                        'route' => route('posts.index'),
                        'icon' => 'newspaper',
                        'title' => 'News & Updates',
                        'description' => 'Stay informed with latest announcements and developments',
                        'color' => 'blue',
                        'gradient' => 'from-blue-500 to-cyan-500'
                    ],
                    [
                        'route' => route('gallery.index'),
                        'icon' => 'images',
                        'title' => 'Photo Gallery',
                        'description' => 'Explore our collection of photos and visual stories',
                        'color' => 'purple',
                        'gradient' => 'from-purple-500 to-pink-500'
                    ],
                    [
                        'route' => route('documents.index'),
                        'icon' => 'file-text',
                        'title' => 'Documents',
                        'description' => 'Access official documents, reports, and publications',
                        'color' => 'green',
                        'gradient' => 'from-green-500 to-emerald-500'
                    ],
                    [
                        'route' => route('about'),
                        'icon' => 'info',
                        'title' => 'About Us',
                        'description' => 'Learn about our history, culture, and governance',
                        'color' => 'amber',
                        'gradient' => 'from-amber-500 to-orange-500'
                    ],
                    [
                        'route' => route('contact'),
                        'icon' => 'mail',
                        'title' => 'Contact Us',
                        'description' => 'Get in touch with our team and departments',
                        'color' => 'indigo',
                        'gradient' => 'from-indigo-500 to-blue-500'
                    ],
                    [
                        'route' => route('documents.index', ['type' => 'budget']),
                        'icon' => 'wallet',
                        'title' => 'Budget & Finance',
                        'description' => 'View budget allocations and financial reports',
                        'color' => 'teal',
                        'gradient' => 'from-teal-500 to-cyan-500'
                    ],
                ] as $index => $link)
                <a href="{{ $link['route'] }}" 
                   class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item relative overflow-hidden block">
                    <!-- Animated gradient background on hover -->
                    <div class="absolute inset-0 bg-gradient-to-br {{ $link['gradient'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-500"></div>
                    
                    <!-- Icon with animated background -->
                    <div class="relative z-10 mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br {{ $link['gradient'] }} rounded-xl flex items-center justify-center icon-hover group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                            <i data-lucide="{{ $link['icon'] }}" class="w-7 h-7 text-white"></i>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative z-10">
                        <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r {{ $link['gradient'] }} transition-all duration-300">
                            {{ $link['title'] }}
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ $link['description'] }}
                        </p>
                        
                        <!-- Arrow indicator -->
                        <div class="flex items-center text-[#142F32] group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r {{ $link['gradient'] }} transition-all duration-300">
                            <span class="text-sm font-semibold mr-2">Explore</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-2"></i>
                        </div>
                    </div>
                    
                    <!-- Decorative corner element -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br {{ $link['gradient'] }} opacity-0 group-hover:opacity-10 rounded-bl-full transition-opacity duration-500"></div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Slant Divider -->
    <x-section-divider type="slant" color="#ffffff" />

    <!-- Ongoing Projects Showcase - Trust Element -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 slide-up-on-scroll">
                <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-4">
                    Ongoing <span class="signature-gradient-text">Projects</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    See the progress we're making in infrastructure, education, healthcare, and community development
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 stagger-on-scroll">
                @foreach([
                    ['icon' => 'road', 'title' => 'Road Infrastructure', 'status' => 'In Progress', 'progress' => 75, 'desc' => 'Construction of major roads and bridges'],
                    ['icon' => 'school', 'title' => 'Education Facilities', 'status' => 'In Progress', 'progress' => 60, 'desc' => 'Renovation and construction of schools'],
                    ['icon' => 'heart-pulse', 'title' => 'Health Centers', 'status' => 'In Progress', 'progress' => 85, 'desc' => 'Upgrading healthcare facilities'],
                    ['icon' => 'droplets', 'title' => 'Water Supply', 'status' => 'In Progress', 'progress' => 90, 'desc' => 'Expanding clean water access'],
                    ['icon' => 'zap', 'title' => 'Power Supply', 'status' => 'Planning', 'progress' => 30, 'desc' => 'Rural electrification project'],
                    ['icon' => 'users', 'title' => 'Community Centers', 'status' => 'In Progress', 'progress' => 50, 'desc' => 'Building community gathering spaces'],
                ] as $project)
                <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-[#142F32]/10 rounded-lg flex items-center justify-center icon-hover group-hover:bg-[#142F32]/20 transition-colors">
                            <i data-lucide="{{ $project['icon'] }}" class="w-6 h-6 text-[#142F32]"></i>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $project['status'] === 'In Progress' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $project['status'] }}
                        </span>
                    </div>
                    <h3 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-2 group-hover:text-[#5EDFFF] transition-colors">
                        {{ $project['title'] }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $project['desc'] }}</p>
                    
                    <!-- Progress Bar -->
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                            <span>Progress</span>
                            <span class="font-semibold">{{ $project['progress'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#5EDFFF] to-[#E0B973] rounded-full progress-bar" data-progress="{{ $project['progress'] }}" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 text-center fade-in-on-scroll">
                <a href="{{ route('gallery.index') }}" class="btn-lift inline-flex items-center px-6 py-3 bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all shadow-lg">
                    View All Projects
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Wave Divider -->
    <x-section-divider type="wave" color="#f9fafb" />

    <!-- Transparency Dashboard Preview - Trust Element -->
    <section class="py-20 bg-white section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 slide-up-on-scroll">
                <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-4">
                    Transparency <span class="signature-gradient-text">Dashboard</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Access key information about our budget, expenditures, and public services
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 fade-in-on-scroll">
                <!-- Budget Card -->
                <div class="glass-card bg-gradient-to-br from-[#142F32] to-[#1a3f44] rounded-xl p-6 border-2 border-white/30 depth-layer-3 card-lift card-glow text-white group">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mb-4 icon-hover">
                        <i data-lucide="wallet" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Annual Budget</h3>
                    <p class="text-3xl font-bold mb-1 text-[#5EDFFF]">₦2.5B</p>
                    <p class="text-sm text-gray-300">Fiscal Year 2024</p>
                    <a href="{{ route('documents.index') }}" class="mt-4 inline-flex items-center text-sm text-white/80 hover:text-white transition-colors">
                        View Details
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>

                <!-- Documents Card -->
                <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group">
                    <div class="w-12 h-12 bg-[#142F32]/10 rounded-lg flex items-center justify-center mb-4 icon-hover group-hover:bg-[#142F32]/20 transition-colors">
                        <i data-lucide="file-text" class="w-6 h-6 text-[#142F32]"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#142F32] mb-2">Public Documents</h3>
                    <p class="text-3xl font-bold mb-1 text-[#142F32]">{{ \App\Models\Document::whereIn('type', ['budget', 'report'])->count() }}+</p>
                    <p class="text-sm text-gray-600">Available for Download</p>
                    <a href="{{ route('documents.index') }}" class="mt-4 inline-flex items-center text-sm text-[#142F32] hover:text-[#5EDFFF] transition-colors accent-border">
                        Browse Documents
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>

                <!-- Services Card -->
                <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 icon-hover group-hover:bg-green-200 transition-colors">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#142F32] mb-2">Active Services</h3>
                    <p class="text-3xl font-bold mb-1 text-[#142F32]">15+</p>
                    <p class="text-sm text-gray-600">Departments</p>
                    <a href="{{ route('about') }}" class="mt-4 inline-flex items-center text-sm text-[#142F32] hover:text-[#5EDFFF] transition-colors accent-border">
                        Learn More
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>

                <!-- Reports Card -->
                <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl p-6 border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 icon-hover group-hover:bg-blue-200 transition-colors">
                        <i data-lucide="bar-chart" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-[#142F32] mb-2">Annual Reports</h3>
                    <p class="text-3xl font-bold mb-1 text-[#142F32]">{{ \App\Models\Document::where('type', 'report')->count() }}+</p>
                    <p class="text-sm text-gray-600">Published Reports</p>
                    <a href="{{ route('documents.index') }}?type=report" class="mt-4 inline-flex items-center text-sm text-[#142F32] hover:text-[#5EDFFF] transition-colors accent-border">
                        View Reports
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section - Enhanced with Glassmorphism -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50 section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="slide-up-on-scroll">
                    <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-6">
                        Key Benefits for Our Community
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Our commitment to excellence drives productivity, reduces costs, and fosters sustainable growth for Shendam Local Government Area.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center icon-hover group-hover:bg-green-200 transition-colors">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="heading-display-2 font-semibold text-[#142F32] mb-2 text-lg">Transparent Governance</h3>
                                <p class="text-gray-700 leading-relaxed">Open and accountable administration with public access to information</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center icon-hover group-hover:bg-green-200 transition-colors">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="heading-display-2 font-semibold text-[#142F32] mb-2 text-lg">Efficient Service Delivery</h3>
                                <p class="text-gray-700 leading-relaxed">Streamlined processes for faster and better public services</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 group">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center icon-hover group-hover:bg-green-200 transition-colors">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="heading-display-2 font-semibold text-[#142F32] mb-2 text-lg">Community Development</h3>
                                <p class="text-gray-700 leading-relaxed">Focused initiatives for sustainable growth and prosperity</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fade-in-on-scroll">
                    <div class="glass-card bg-white/90 backdrop-blur-md rounded-2xl p-8 border-2 border-white/50 depth-layer-4">
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 border border-white/30">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-[#142F32] text-lg">Total Projects</h3>
                                <i data-lucide="trending-up" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div class="text-5xl font-bold text-[#142F32] mb-2">1951+</div>
                            <div class="text-sm text-gray-600">Active development projects</div>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">This Month</span>
                                    <span class="text-green-600 font-semibold">+128 projects</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slant Divider -->
    <x-section-divider type="slant" color="#f9fafb" />

    <!-- Latest News Section - Enhanced with Glassmorphism -->
    @if($latestPosts->count() > 0)
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white section-overlap section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12 slide-up-on-scroll">
                <div>
                    <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] mb-4">Latest News & Updates</h2>
                    <p class="text-lg text-gray-600">Stay informed with the latest announcements and developments</p>
                </div>
                <a href="{{ route('posts.index') }}" class="hidden md:inline-flex items-center px-6 py-3 btn-lift bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all shadow-lg">
                    View All News
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger-on-scroll">
                @foreach($latestPosts as $post)
                <div class="glass-card bg-white/90 backdrop-blur-md rounded-xl overflow-hidden border-2 border-white/50 depth-layer-3 card-lift card-accent-border card-glow group stagger-item">
                    @if($post->featured_image)
                    <div class="h-48 bg-cover bg-center relative overflow-hidden group-hover:scale-110 transition-transform duration-500" style="background-image: url('{{ asset('storage/' . $post->featured_image) }}')">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent group-hover:from-black/50 transition-all duration-300"></div>
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-[#142F32] to-[#1a3f44] relative overflow-hidden group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i data-lucide="newspaper" class="w-16 h-16 text-white/30 group-hover:text-white/50 transition-colors"></i>
                        </div>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2 flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-1 icon-hover"></i>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </div>
                        <h3 class="heading-display-2 text-xl font-semibold text-[#142F32] mb-3 group-hover:text-[#5EDFFF] transition-colors">{{ $post->title }}</h3>
                        <p class="text-gray-700 mb-4 line-clamp-3 leading-relaxed">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-[#142F32] font-semibold hover:text-[#5EDFFF] transition-colors inline-flex items-center group/link accent-border">
                            Read More
                            <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transition-transform group-hover/link:translate-x-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('posts.index') }}" class="btn-lift inline-flex items-center px-6 py-3 bg-[#142F32] text-white font-semibold rounded-lg hover:bg-[#1a3f44] transition-all shadow-lg">
                    View All News
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Wave Divider (Flipped) -->
    <x-section-divider type="wave" flip="true" color="#142F32" />

    <!-- Call to Action Section - Enhanced -->
    <section class="py-20 bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white relative overflow-hidden section-overlap section-transition">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#5EDFFF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#E0B973]/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 fade-in-on-scroll">
            <h2 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold mb-6">From Vision to Reality</h2>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-8">
                Join us in building a better future for Shendam. Access our services, stay informed, and be part of our community's growth.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('documents.index') }}" class="btn-lift inline-flex items-center justify-center px-8 py-4 bg-white text-[#142F32] font-bold text-lg rounded-lg hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl">
                    View Documents
                    <i data-lucide="file-text" class="w-5 h-5 ml-2"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn-lift inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-md border-2 border-white text-white font-bold text-lg rounded-lg hover:bg-white/20 hover:border-[#5EDFFF] transition-all shadow-lg">
                    Contact Us
                    <i data-lucide="mail" class="w-5 h-5 ml-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection



