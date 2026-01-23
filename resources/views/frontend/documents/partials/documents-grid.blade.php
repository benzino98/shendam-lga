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
@endphp

@if($documents->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($documents as $document)
            @php
                $format = $formatFileType($document->file_type);
                $size = $formatBytes($document->file_size);
                $date = $document->created_at?->format('M d, Y') ?? '—';
                $categoryLabel = $document->category?->name;
            @endphp
            <article class="relative bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow card-lift">
                <!-- Whole-card clickable overlay -->
                <a href="{{ route('documents.show', $document->slug) }}"
                   class="absolute inset-0 z-10 rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2"
                   aria-label="View document: {{ $document->title }}"></a>

                <div class="relative z-20 p-5">
                    <!-- Header row (icon + badge) -->
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-11 h-11 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                @if(str_contains(strtolower((string) $document->file_type), 'pdf'))
                                    <i data-lucide="file-text" class="w-5 h-5 text-[#142F32]"></i>
                                @elseif(str_contains(strtolower((string) $document->file_type), 'excel') || str_contains(strtolower((string) $document->file_type), 'spreadsheet'))
                                    <i data-lucide="file-spreadsheet" class="w-5 h-5 text-[#142F32]"></i>
                                @else
                                    <i data-lucide="file" class="w-5 h-5 text-[#142F32]"></i>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    @if($categoryLabel)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide uppercase bg-gray-100 text-gray-700 border border-gray-200">
                                            {{ $categoryLabel }}
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wide uppercase bg-[#142F32]/5 text-[#142F32] border border-[#142F32]/10">
                                        {{ strtoupper($document->type ?: 'other') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Download (secondary, icon-only) -->
                        <a href="{{ route('documents.download', $document->slug) }}"
                           class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 bg-white text-[#142F32] hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2"
                           aria-label="Download {{ $document->title }}">
                            <i data-lucide="download" class="w-5 h-5"></i>
                        </a>
                    </div>

                    <!-- Title -->
                    <h2 class="text-lg md:text-[19px] font-bold text-[#142F32] leading-snug">
                        <span class="line-clamp-2">{{ $document->title }}</span>
                    </h2>

                    <!-- Description (2 lines max) -->
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed line-clamp-2">
                        {{ $document->description ?: '—' }}
                    </p>

                    <!-- Metadata line: Date • File size • Format -->
                    <div class="mt-4 text-xs text-gray-600">
                        <span class="font-medium">{{ $date }}</span>
                        <span class="mx-2 text-gray-300">•</span>
                        <span>{{ $size ?: '—' }}</span>
                        <span class="mx-2 text-gray-300">•</span>
                        <span>{{ $format }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="mt-5 flex items-center gap-3">
                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-[#142F32] text-white text-sm font-semibold shadow-sm">
                            View
                        </span>
                        <span class="text-xs text-gray-500">Details & metadata</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10" id="paginationContainer">
        {{ $documents->links() }}
    </div>
@else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-10 max-w-md mx-auto">
            <i data-lucide="file-x" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
            <h3 class="text-lg font-bold text-[#142F32] mb-2">No documents found</h3>
            <p class="text-sm text-gray-600">Try adjusting filters or search terms.</p>
        </div>
    </div>
@endif
