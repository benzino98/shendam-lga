<nav class="bg-[#142F32] text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo - Signature Brand Element -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group/logo transition-all duration-300 hover:scale-105">
                    <div class="relative signature-logo">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#5EDFFF] via-[#142F32] to-[#E0B973] rounded-xl flex items-center justify-center group-hover/logo:shadow-lg group-hover/logo:shadow-[#5EDFFF]/50 transition-all duration-300 border-2 border-white/20 group-hover/logo:border-[#5EDFFF]/50">
                            <span class="text-lg font-bold text-white tracking-tight">SLG</span>
                        </div>
                        <!-- Glow effect on hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-xl opacity-0 group-hover/logo:opacity-20 blur-xl transition-opacity duration-300 -z-10"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold heading-display tracking-tight">Shendam LGA</span>
                        <span class="text-xs text-gray-300 font-medium -mt-1">Local Government Area</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('home') ? 'active text-[#5EDFFF]' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('about') ? 'active text-[#5EDFFF]' : '' }}">
                    About
                </a>
                <a href="{{ route('posts.index') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('posts.*') ? 'active text-[#5EDFFF]' : '' }}">
                    News
                </a>
                <a href="{{ route('gallery.index') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('gallery.*') ? 'active text-[#5EDFFF]' : '' }}">
                    Gallery
                </a>
                <a href="{{ route('documents.index') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('documents.*') ? 'active text-[#5EDFFF]' : '' }}">
                    Documents
                </a>
                <a href="{{ route('contact') }}" class="nav-link-underline relative text-white hover:text-[#5EDFFF] transition-colors font-medium {{ request()->routeIs('contact') ? 'active text-[#5EDFFF]' : '' }}">
                    Contact
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-white hover:text-green-300 focus:outline-none" id="mobile-menu-button" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="hidden md:hidden bg-[#142F32] border-t border-white/10" id="mobile-menu">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">Home</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">About</a>
            <a href="{{ route('posts.index') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">News</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">Gallery</a>
            <a href="{{ route('documents.index') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">Documents</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-white hover:bg-white/10 rounded-md">Contact</a>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu?.classList.toggle('hidden');
    });
</script>



