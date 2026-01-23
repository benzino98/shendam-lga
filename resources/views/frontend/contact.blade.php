@extends('layouts.frontend')

@section('title', 'Contact Us')
@section('description', 'Contact Shendam Local Government Area')

@section('content')
    <!-- Hero Section -->
    <section class="gradient-mesh text-white py-16 lg:py-24 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#5EDFFF]/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#E0B973]/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in">
                <h1 class="heading-display text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    Get In <span class="signature-gradient-text">Touch</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto slide-up">
                    We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Information Cards -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="glass-card p-6 card-lift fade-in-on-scroll">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#5EDFFF] to-[#142F32] rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#142F32] mb-2">Address</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Shendam Local Government<br>
                                    Plateau State, Nigeria
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.1s;">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#E0B973] to-[#142F32] rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#142F32] mb-2">Email</h3>
                                <a href="mailto:info@shendamlga.gov.ng" class="text-[#5EDFFF] hover:text-[#142F32] transition-colors text-sm">
                                    info@shendamlga.gov.ng
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card p-6 card-lift fade-in-on-scroll" style="animation-delay: 0.2s;">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#5EDFFF] to-[#E0B973] rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-[#142F32] mb-2">Office Hours</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Monday - Friday<br>
                                    8:00 AM - 5:00 PM
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="glass-card p-8 card-lift slide-up-on-scroll">
                        <h2 class="heading-display-2 text-2xl font-bold text-[#142F32] mb-6">Send us a Message</h2>
                        
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center space-x-3">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0"></i>
                                <p class="text-green-800 text-sm">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-center space-x-3 mb-2">
                                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 flex-shrink-0"></i>
                                    <p class="text-red-800 font-semibold text-sm">Please correct the following errors:</p>
                                </div>
                                <ul class="list-disc list-inside text-red-700 text-sm space-y-1 ml-8">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-[#142F32] mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent transition-all outline-none"
                                        placeholder="John Doe"
                                    >
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-[#142F32] mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent transition-all outline-none"
                                        placeholder="john@example.com"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-[#142F32] mb-2">
                                    Phone Number
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent transition-all outline-none"
                                    placeholder="+234 800 000 0000"
                                >
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-semibold text-[#142F32] mb-2">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="subject" 
                                    name="subject" 
                                    value="{{ old('subject') }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent transition-all outline-none"
                                    placeholder="What is this regarding?"
                                >
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-[#142F32] mb-2">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="6"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5EDFFF] focus:border-transparent transition-all outline-none resize-none"
                                    placeholder="Tell us how we can help you..."
                                >{{ old('message') }}</textarea>
                            </div>

                            <div>
                                <button 
                                    type="submit"
                                    class="btn-lift w-full md:w-auto px-8 py-4 bg-gradient-to-r from-[#142F32] to-[#1a3f44] text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center space-x-2 group"
                                >
                                    <span>Send Message</span>
                                    <i data-lucide="send" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



