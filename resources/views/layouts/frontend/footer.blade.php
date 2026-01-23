<footer class="bg-gradient-to-br from-[#142F32] via-[#1a3f44] to-[#142F32] text-white mt-20 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#5EDFFF] rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#E0B973] rounded-full blur-3xl"></div>
    </div>
    
    <!-- Wave Divider at Top -->
    <div class="absolute top-0 left-0 right-0 h-16 -mt-16">
        <svg class="w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none" fill="currentColor">
            <path d="M0,60 C300,100 600,20 900,60 C1050,80 1150,40 1200,60 L1200,120 L0,120 Z" fill="#142F32"></path>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Company Info - Enhanced -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="relative signature-logo">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#5EDFFF] via-[#142F32] to-[#E0B973] rounded-xl flex items-center justify-center border-2 border-white/20 shadow-lg">
                            <span class="text-xl font-bold text-white tracking-tight">SLG</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-xl opacity-30 blur-xl -z-10"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold heading-display tracking-tight">Shendam LGA</span>
                        <span class="text-sm text-gray-300 font-medium">Local Government Area</span>
                    </div>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed max-w-md mb-6">
                    Serving the people of Shendam Local Government Area with transparency, efficiency, and dedication. 
                    Your trusted partner in local governance and community development.
                </p>
                <!-- Social Links Placeholder -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#5EDFFF] rounded-lg flex items-center justify-center transition-colors group">
                        <i data-lucide="facebook" class="w-5 h-5 text-white group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#5EDFFF] rounded-lg flex items-center justify-center transition-colors group">
                        <i data-lucide="twitter" class="w-5 h-5 text-white group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-[#5EDFFF] rounded-lg flex items-center justify-center transition-colors group">
                        <i data-lucide="instagram" class="w-5 h-5 text-white group-hover:scale-110 transition-transform"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="heading-display-2 font-semibold mb-6 text-lg flex items-center">
                    <i data-lucide="link" class="w-5 h-5 mr-2 text-[#5EDFFF]"></i>
                    Quick Links
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-300 hover:text-[#5EDFFF] transition-colors flex items-center group">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="text-gray-300 hover:text-[#5EDFFF] transition-colors flex items-center group">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            News & Updates
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}" class="text-gray-300 hover:text-[#5EDFFF] transition-colors flex items-center group">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('documents.index') }}" class="text-gray-300 hover:text-[#5EDFFF] transition-colors flex items-center group">
                            <i data-lucide="chevron-right" class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Documents
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="heading-display-2 font-semibold mb-6 text-lg flex items-center">
                    <i data-lucide="mail" class="w-5 h-5 mr-2 text-[#5EDFFF]"></i>
                    Get In Touch
                </h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-2 mt-1 text-[#5EDFFF] flex-shrink-0"></i>
                        <span>Shendam Local Government<br>Plateau State, Nigeria</span>
                    </li>
                    <li class="flex items-center pt-2">
                        <i data-lucide="mail" class="w-4 h-4 mr-2 text-[#5EDFFF] flex-shrink-0"></i>
                        <a href="mailto:info@shendamlga.gov.ng" class="hover:text-[#5EDFFF] transition-colors">
                            info@shendamlga.gov.ng
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-300 text-sm flex items-center">
                <i data-lucide="copyright" class="w-4 h-4 mr-2 text-[#5EDFFF]"></i>
                {{ date('Y') }} Shendam Local Government Area. All rights reserved.
            </p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-300 hover:text-[#5EDFFF] transition-colors text-sm flex items-center group">
                    <span>Terms & Conditions</span>
                    <i data-lucide="external-link" class="w-3 h-3 ml-1 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                <a href="#" class="text-gray-300 hover:text-[#5EDFFF] transition-colors text-sm flex items-center group">
                    <span>Privacy Policy</span>
                    <i data-lucide="external-link" class="w-3 h-3 ml-1 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
    </div>
</footer>



