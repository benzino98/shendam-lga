@extends('layouts.frontend')

@section('title', 'About Us')
@section('description', 'Learn about Shendam Local Government Area - History, culture, people, governance, and progress')

@section('content')
    <!-- Hero Section -->
    <section class="gradient-mesh text-white py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#5EDFFF]/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#E0B973]/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in">
                <h1 class="heading-display text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                    About <span class="signature-gradient-text">Shendam</span>
                </h1>
                <p class="text-lg md:text-xl lg:text-2xl text-gray-200 max-w-3xl mx-auto slide-up">
                    History, culture, people, governance, and progress.
                </p>
                <p class="text-base md:text-lg text-gray-300 mt-4 slide-up" style="animation-delay: 0.2s;">
                    Serving with Excellence • Building for Tomorrow
                </p>
            </div>
        </div>
    </section>

    <!-- Introduction Block -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in-on-scroll">
                    <div class="glass-card p-8 card-lift">
                        <h2 class="heading-display-2 text-3xl font-bold text-[#142F32] mb-6">Welcome to Shendam LGA</h2>
                        <div class="space-y-4 text-gray-700 leading-relaxed">
                            <p class="text-lg font-semibold text-[#142F32]">
                                SHENDAM LOCAL GOVERNMENT AREA AT A GLANCE
                            </p>

                            <p>
                                <strong class="text-[#142F32]">1. Location:</strong>
                                Created in 1976, Shendam – popularly referred to as the <span class="italic">Home of Hospitality</span> – is situated about 155km south of Jos, the headquarters of Plateau State. It covers a land mass of about 2,437 sq km and has a population of about 208,017 made up of 109,519 males and 97,498 females as recorded in the 2006 Population Census.
                            </p>

                            <p>
                                The Local Government Area shares common boundaries with Quan-pan LGA to the west, Mikang LGA to the south and Langtang South LGA to the east. It is a belt of low-lying land and is thickly covered with economic trees. It is traversed by many streams and rivers which can be utilised effectively for fishing, agriculture and transportation.
                            </p>

                            <p>
                                Shendam experiences relatively high temperatures during the day and low temperatures at night. The hot and humid weather condition, coupled with generally fertile soil, enhances the growth of cash crops such as yams, rice, millet, beans, cassava and others.
                            </p>

                            <p>
                                Apart from these crops, the Local Government Area is also blessed with abundant mineral resources such as salt, gypsum, clay, sand and hard rock, deposited around areas including Dertang Jayu, Duam, Japhshen Tengzet and Dungoeshing. These mineral resources abound in large quantities, waiting to be tapped by potential investors.
                            </p>

                            <p>
                                Tourist attraction centres found in the area include Npol Lake in Lakushi, Jelbang Rock, Nroam Lake, Shendam Dam, Gonvel, Goesa and Kaanjen ponds.
                            </p>

                            <p>
                                The area is inhabited by the Goemai whose predominant occupations are farming, fishing and rearing of livestock. Because of the peaceful and hospitable nature of the Goemai, other ethnic groups such as Mpun, Kwalla, Berom, Mushere, Hausa, Fulani, Igbo, Yoruba and many others also settle peacefully with them.
                            </p>

                            <p>
                                For administrative convenience, the area is divided into four districts, each headed by a district head. Shendam District is headed by Miskoom Leonard Shaiyen; Derteng District is headed by Miskoom Nijin Yunkwap; Dokan Tofa is headed by Miskoom James Laankwap; while Dorok District is headed by an acting head, Miskoom Prinkwap Maigari.
                            </p>

                            <p>
                                The entire Goemai nation is headed by a first-class chief, Miskoom Hubert Shaldas II (OON), who is also the Deputy Chairman, Plateau State Council of Chiefs.
                            </p>

                            <p>
                                The Local Government Area enjoys the network services of MTN, GLO and Zain, and has other social amenities such as good road networks and a modern post office. The area also enjoys the services of banks such as UBA and Agricultural and Co‑operative Banks, while Ocean Bank has already concluded arrangements to commence full-fledged banking activities.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl image-scale-hover">
                        <div class="aspect-[4/3] bg-gradient-to-br from-[#142F32] to-[#1a3f44] flex items-center justify-center">
                            <div class="text-center text-white p-8">
                                <i data-lucide="building-2" class="w-24 h-24 mx-auto mb-4 text-[#5EDFFF]"></i>
                                <p class="text-lg opacity-90">Shendam Local Government Area</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History Overview -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in-on-scroll">
                <h2 class="heading-display text-4xl md:text-5xl font-bold text-[#142F32] mb-4">Our History</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">A journey through time, from our roots to the present day</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pre-Colonial Roots -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#142F32] rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="book-open" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Pre-Colonial Roots</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Long before modern administration, the people of Shendam lived in organized communities, practicing agriculture, trade, and rich cultural traditions that continue to shape our identity today.
                    </p>
                </div>

                <!-- Formation & Administration -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="landmark" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Formation & Administration</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Established as a Local Government Area in 1976, Shendam has evolved into a model of local governance, serving its people with dedication and progressive leadership.
                    </p>
                </div>

                <!-- Development Highlights -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-xl flex items-center justify-center mb-4">
                        <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Development Highlights</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        From infrastructure projects to social programs, Shendam LGA continues to invest in the future, building roads, schools, healthcare facilities, and empowering communities.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline of Major Events -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in-on-scroll">
                <h2 class="heading-display text-4xl md:text-5xl font-bold text-[#142F32] mb-4">Timeline of Major Events</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Key milestones in our journey</p>
            </div>

            <!-- Desktop Timeline (Horizontal) -->
            <div class="hidden lg:block">
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-[#5EDFFF] via-[#E0B973] to-[#5EDFFF] transform -translate-y-1/2"></div>
                    
                    <div class="relative grid grid-cols-4 gap-8">
                        <!-- Event 1 -->
                        <div class="relative fade-in-on-scroll">
                            <div class="glass-card p-6 card-lift text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#142F32] rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 border-4 border-white shadow-lg">
                                    <span class="text-white font-bold text-lg">1976</span>
                                </div>
                                <h3 class="font-bold text-[#142F32] mb-2">LGA Created</h3>
                                <p class="text-sm text-gray-600">Shendam Local Government Area was officially established</p>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="relative fade-in-on-scroll" style="animation-delay: 0.1s;">
                            <div class="glass-card p-6 card-lift text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 border-4 border-white shadow-lg">
                                    <span class="text-white font-bold text-lg">2004</span>
                                </div>
                                <h3 class="font-bold text-[#142F32] mb-2">Peace Initiative</h3>
                                <p class="text-sm text-gray-600">Major peace and reconciliation efforts</p>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="relative fade-in-on-scroll" style="animation-delay: 0.2s;">
                            <div class="glass-card p-6 card-lift text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 border-4 border-white shadow-lg">
                                    <span class="text-white font-bold text-lg">2015</span>
                                </div>
                                <h3 class="font-bold text-[#142F32] mb-2">Road Project</h3>
                                <p class="text-sm text-gray-600">Major road infrastructure project launched</p>
                            </div>
                        </div>

                        <!-- Event 4 -->
                        <div class="relative fade-in-on-scroll" style="animation-delay: 0.3s;">
                            <div class="glass-card p-6 card-lift text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-[#142F32] to-[#5EDFFF] rounded-full flex items-center justify-center mx-auto mb-4 relative z-10 border-4 border-white shadow-lg">
                                    <span class="text-white font-bold text-lg">2021</span>
                                </div>
                                <h3 class="font-bold text-[#142F32] mb-2">Health Initiative</h3>
                                <p class="text-sm text-gray-600">New comprehensive health program started</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Timeline (Vertical) -->
            <div class="lg:hidden space-y-8">
                <div class="glass-card p-6 card-lift fade-in-on-scroll">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#142F32] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">1976</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#142F32] mb-2">LGA Created</h3>
                            <p class="text-sm text-gray-600">Shendam Local Government Area was officially established</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">2004</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#142F32] mb-2">Peace Initiative</h3>
                            <p class="text-sm text-gray-600">Major peace and reconciliation efforts</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">2015</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#142F32] mb-2">Road Project</h3>
                            <p class="text-sm text-gray-600">Major road infrastructure project launched</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.3s;">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#142F32] to-[#5EDFFF] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold">2021</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#142F32] mb-2">Health Initiative</h3>
                            <p class="text-sm text-gray-600">New comprehensive health program started</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Culture & People -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in-on-scroll">
                <h2 class="heading-display text-4xl md:text-5xl font-bold text-[#142F32] mb-4">Culture & People</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Celebrating our rich heritage and diverse communities</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Ethnic Groups -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll">
                    <div class="aspect-[4/3] bg-gradient-to-br from-[#142F32] to-[#1a3f44] rounded-xl mb-4 flex items-center justify-center">
                        <i data-lucide="users" class="w-16 h-16 text-[#5EDFFF]"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Ethnic Groups</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Shendam is home to diverse ethnic groups living together in harmony, each contributing unique traditions and values to our collective identity.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            Multiple ethnic communities
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            Peaceful coexistence
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            Cultural exchange
                        </li>
                    </ul>
                </div>

                <!-- Traditions -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="aspect-[4/3] bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-xl mb-4 flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-16 h-16 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Traditions</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Our vibrant festivals, traditional dress, music, and dance reflect the rich cultural heritage passed down through generations.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#E0B973] mr-2"></i>
                            Annual festivals
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#E0B973] mr-2"></i>
                            Traditional ceremonies
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#E0B973] mr-2"></i>
                            Cultural performances
                        </li>
                    </ul>
                </div>

                <!-- Language -->
                <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="aspect-[4/3] bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-xl mb-4 flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-16 h-16 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-xl font-bold text-[#142F32] mb-3">Language</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Multiple languages and dialects are spoken across the LGA, with English serving as the official language for administration and education.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            Indigenous languages
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            English (official)
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="check" class="w-4 h-4 text-[#5EDFFF] mr-2"></i>
                            Pidgin English
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Governance Profile -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in-on-scroll">
                <h2 class="heading-display text-4xl md:text-5xl font-bold text-[#142F32] mb-4">Governance</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Leadership committed to service and development</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Mission -->
                <div class="glass-card p-8 card-lift fade-in-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#5EDFFF] to-[#142F32] rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="target" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-2xl font-bold text-[#142F32] mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To develop a sound Infrastructure base, while providing an enabling environment for peaceful coexistence for Shendam LGA in the shortest time possible.
                    </p>
                </div>

                <!-- Vision -->
                <div class="glass-card p-8 card-lift fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="heading-display-2 text-2xl font-bold text-[#142F32] mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To buld an egalitatrian viable, peacful and just Local Government Area where inhabitants are economically and politically empowered and their value system redefined with the present reality poised to face the challenges of tommorrow.
                </div>
            </div>

            <!-- Leadership Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Chairman -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll">
                    <div class="w-32 h-32 bg-gradient-to-br from-[#142F32] to-[#5EDFFF] rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                        <i data-lucide="user" class="w-16 h-16 text-white"></i>
                    </div>
                    <h3 class="font-bold text-lg text-[#142F32] mb-2">LGA Chairman</h3>
                    <p class="text-sm text-gray-600 mb-4">Leading with integrity and dedication</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-[#5EDFFF]/10 hover:bg-[#5EDFFF] rounded-lg flex items-center justify-center transition-colors group">
                            <i data-lucide="mail" class="w-4 h-4 text-[#5EDFFF] group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Council Leaders -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-32 h-32 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                        <i data-lucide="users" class="w-16 h-16 text-white"></i>
                    </div>
                    <h3 class="font-bold text-lg text-[#142F32] mb-2">Council Leaders</h3>
                    <p class="text-sm text-gray-600 mb-4">Dedicated representatives serving communities</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-[#E0B973]/10 hover:bg-[#E0B973] rounded-lg flex items-center justify-center transition-colors group">
                            <i data-lucide="mail" class="w-4 h-4 text-[#E0B973] group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Administration -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="w-32 h-32 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                        <i data-lucide="briefcase" class="w-16 h-16 text-white"></i>
                    </div>
                    <h3 class="font-bold text-lg text-[#142F32] mb-2">Administration</h3>
                    <p class="text-sm text-gray-600 mb-4">Professional team ensuring efficient service delivery</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-[#5EDFFF]/10 hover:bg-[#5EDFFF] rounded-lg flex items-center justify-center transition-colors group">
                            <i data-lucide="mail" class="w-4 h-4 text-[#5EDFFF] group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fun Facts / At a Glance -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in-on-scroll">
                <h2 class="heading-display text-4xl md:text-5xl font-bold text-[#142F32] mb-4">At a Glance</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Quick facts about Shendam LGA</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                <!-- Population -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        <span data-counter="250" data-suffix="K+" style="color: #5EDFFF !important;">0K+</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium flex items-center justify-center">
                        <i data-lucide="users" class="w-4 h-4 mr-2 text-[#5EDFFF]"></i>
                        Population
                    </div>
                </div>

                <!-- Area -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        <span data-counter="1500" data-suffix=" km²" style="color: #E0B973 !important;">0 km²</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium flex items-center justify-center">
                        <i data-lucide="map" class="w-4 h-4 mr-2 text-[#E0B973]"></i>
                        Area
                    </div>
                </div>

                <!-- Communities -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        <span data-counter="50" data-suffix="+" style="color: #5EDFFF !important;">0+</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium flex items-center justify-center">
                        <i data-lucide="home" class="w-4 h-4 mr-2 text-[#5EDFFF]"></i>
                        Communities
                    </div>
                </div>

                <!-- Years of Heritage -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        <span data-counter="48" data-suffix="+" style="color: #E0B973 !important;">0+</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium flex items-center justify-center">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2 text-[#E0B973]"></i>
                        Years of Heritage
                    </div>
                </div>

                <!-- Infrastructure -->
                <div class="glass-card p-6 card-lift text-center fade-in-on-scroll" style="animation-delay: 0.4s;">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        <span data-counter="100" data-suffix="+" style="color: #5EDFFF !important;">0+</span>
                    </div>
                    <div class="text-sm text-gray-600 font-medium flex items-center justify-center">
                        <i data-lucide="building-2" class="w-4 h-4 mr-2 text-[#5EDFFF]"></i>
                        Key Infrastructure
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
