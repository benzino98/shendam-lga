@extends('layouts.frontend')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))

@section('content')
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card bg-white/90 backdrop-blur-sm rounded-xl shadow-xl p-8 md:p-12 border-2 border-white/50 fade-in-on-scroll">
                <h1 class="heading-display text-4xl md:text-5xl lg:text-6xl font-bold text-[#142F32] mb-8">{{ $page->title }}</h1>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection



