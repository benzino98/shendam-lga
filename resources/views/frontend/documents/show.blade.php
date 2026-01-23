@extends('layouts.frontend')

@section('title', $document->title)
@section('description', $document->description ?? 'Official document from Shendam Local Government Area.')

@section('content')
    @php
        $formatBytes = function (?int $bytes): ?string {
            if (!$bytes || $bytes <= 0) return null;
            $kb = 1024;
            $mb = $kb * 1024;
            $gb = $mb * 1024;
            if ($bytes >= $gb) return number_format($bytes / $gb, 1) . ' GB';
            if ($bytes >= $mb) return number_format($bytes / $mb, 1) . ' MB';
            return number_format($bytes / $kb, 0) . ' KB';
        };

        $formatFileType = function (?string $fileType): string {
            if (!$fileType) return '—';
            $t = strtolower($fileType);
            if (str_contains($t, 'pdf')) return 'PDF';
            if (str_contains($t, 'word')) return 'DOC';
            if (str_contains($t, 'excel') || str_contains($t, 'spreadsheet')) return 'XLS';
            if (str_contains($t, 'powerpoint') || str_contains($t, 'presentation')) return 'PPT';
            $parts = explode('/', $t);
            return strtoupper(end($parts) ?: $t);
        };

        $format = $formatFileType($document->file_type);
        $size = $formatBytes($document->file_size);
        $published = $document->created_at?->format('M d, Y') ?? '—';
        $categoryLabel = $document->category?->name;
        $categorySlug = $document->category?->slug;
        $typeLabel = match ($document->type) {
            'report' => 'Reports',
            'budget' => 'Budgets',
            'policy' => 'Policies',
            'statement' => 'Circulars',
            default => 'Other',
        };
    @endphp

    <!-- Header -->
    <section class="py-10 md:py-12 bg-[#f6f8fa] border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#142F32] underline-offset-2 hover:underline">Home</a></li>
                    <li class="text-gray-400">→</li>
                    <li><a href="{{ route('documents.index') }}" class="hover:text-[#142F32] underline-offset-2 hover:underline">Documents</a></li>
                    <li class="text-gray-400">→</li>
                    <li class="text-gray-900 font-semibold">{{ Str::limit($document->title, 60) }}</li>
                </ol>
            </nav>

            <div class="flex flex-col gap-3">
                <h1 class="text-2xl md:text-3xl font-bold text-[#142F32] tracking-tight leading-snug">{{ $document->title }}</h1>
                <p class="text-sm text-gray-600">
                    <span class="font-semibold text-gray-800">{{ $typeLabel }}</span>
                    <span class="mx-2 text-gray-300">•</span>
                    <span>Published {{ $published }}</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Document Details -->
    <section class="py-10 md:py-12 bg-[#f6f8fa]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <article class="lg:col-span-2">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 md:p-8">
                        <!-- Preview -->
                        <div class="mb-6">
                            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-3">Document Preview</h2>
                            @php
                                $publicUrl = null;
                                try {
                                    $publicUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($document->file_path);
                                } catch (\Throwable $e) {
                                    $publicUrl = null;
                                }
                            @endphp

                            @if($publicUrl && str_contains(strtolower((string) $document->file_type), 'pdf'))
                                <div class="rounded-lg overflow-hidden border border-gray-200 bg-white">
                                    <iframe
                                        title="Preview: {{ $document->title }}"
                                        src="{{ $publicUrl }}#toolbar=0&navpanes=0"
                                        class="w-full h-[520px]"
                                    ></iframe>
                                </div>
                            @else
                                <div class="rounded-lg border border-gray-200 bg-gray-50 p-10 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="mx-auto w-14 h-14 rounded-xl bg-white border border-gray-200 flex items-center justify-center mb-3">
                                            <i data-lucide="file" class="w-7 h-7 text-[#142F32]"></i>
                                        </div>
                                        <p class="text-sm text-gray-700 font-semibold">Preview not available</p>
                                        <p class="text-xs text-gray-500 mt-1">Use the download button to open this file.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-2">Description</h2>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ $document->description ?: '—' }}
                            </p>
                        </div>

                        <!-- Primary action (solid, high-contrast) -->
                        <div class="pt-6 border-t border-gray-200">
                            <a href="{{ route('documents.download', $document->slug) }}"
                               class="inline-flex items-center justify-center w-full md:w-auto px-6 py-3 rounded-lg bg-[#142F32] text-white font-semibold shadow-sm hover:bg-[#1a3f44] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2">
                                <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                                Download Document
                            </a>
                            <p class="text-xs text-gray-500 mt-2">
                                File name: <span class="font-mono">{{ $document->file_name }}</span>
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 space-y-6">
                    <!-- Back to Documents -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                        <a href="{{ route('documents.index') }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-white border border-gray-200 text-[#142F32] font-semibold hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                            Back to Documents
                        </a>
                    </div>

                    <!-- Document Information -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
                        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wide mb-4">Document Information</h2>
                        <dl class="text-sm">
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">Type</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $typeLabel }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">Format</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $format }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">File size</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $size ?: '—' }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">Category</dt>
                                <dd class="font-semibold text-[#142F32]">
                                    @if($categoryLabel && $categorySlug)
                                        <a href="{{ route('documents.index', ['category' => $categorySlug]) }}" class="underline-offset-2 hover:underline">
                                            {{ $categoryLabel }}
                                        </a>
                                    @else
                                        —
                                    @endif
                                </dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">Uploaded by</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $document->user?->name ?: '—' }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-gray-100">
                                <dt class="text-gray-600">Published date</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $published }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <dt class="text-gray-600">Downloads</dt>
                                <dd class="font-semibold text-[#142F32]">{{ $document->download_count ?? 0 }}</dd>
                            </div>
                        </dl>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
