@extends('layouts.frontend')

@section('title', 'Documents')
@section('description', 'Access official documents, budgets, reports, and policies from Shendam Local Government Area.')

@section('content')
    @php
        $type = request('type');
        $typeTabs = [
            'all' => ['label' => 'All', 'value' => null],
            'reports' => ['label' => 'Reports', 'value' => 'reports'],
            'budgets' => ['label' => 'Budgets', 'value' => 'budgets'],
            'policies' => ['label' => 'Policies', 'value' => 'policies'],
            'circulars' => ['label' => 'Circulars', 'value' => 'circulars'],
        ];

        $activeTabKey = 'all';
        foreach ($typeTabs as $key => $tab) {
            if ($tab['value'] && $tab['value'] === $type) {
                $activeTabKey = $key;
                break;
            }
        }

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
            // e.g. "application/pdf" -> "PDF"
            $parts = explode('/', $t);
            return strtoupper(end($parts) ?: $t);
        };
    @endphp

    <!-- Documents Library -->
    <section class="py-12 md:py-16 bg-[#f6f8fa]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <header class="mb-8 md:mb-10">
                <div class="flex flex-col gap-3">
                    <h1 class="text-2xl md:text-3xl font-bold text-[#142F32] tracking-tight">Documents</h1>
                    <p class="text-gray-600 max-w-3xl">
                        Official publications and public records of Shendam Local Government Area.
                    </p>
                </div>
            </header>

            <!-- Filters -->
            <div class="mb-8 md:mb-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Type Tabs (Pills) -->
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach($typeTabs as $key => $tab)
                            @php
                                $isActive = $key === $activeTabKey;
                                $queryParams = request()->query();
                                
                                if ($tab['value']) {
                                    $queryParams['type'] = $tab['value'];
                                } else {
                                    unset($queryParams['type']);
                                }
                                
                                // Remove page when filtering
                                unset($queryParams['page']);
                                
                                $tabUrl = route('documents.index', $queryParams);
                            @endphp
                            <a href="{{ $tabUrl }}"
                               class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2 {{ $isActive ? 'bg-[#142F32] text-white border-[#142F32]' : 'bg-white text-[#142F32] border-gray-200 hover:bg-gray-50' }}">
                                {{ $tab['label'] }}
                            </a>
                        @endforeach

                        <!-- Optional: Document Category (DB) -->
                        <form method="GET" action="{{ route('documents.index') }}" id="categoryForm" class="ml-0 lg:ml-2">
                            @foreach(request()->query() as $k => $v)
                                @if($k !== 'category' && $k !== 'page')
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach
                            <label class="sr-only" for="category">Category</label>
                            <select id="category" name="category"
                                    onchange="this.form.submit()"
                                    class="h-10 rounded-full border border-gray-200 bg-white px-4 text-sm font-semibold text-[#142F32] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#5EDFFF] focus:ring-offset-2">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                                        {{ $category->name }} @if(isset($category->documents_count)) ({{ $category->documents_count }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <!-- Search -->
                    <form method="GET" action="{{ route('documents.index') }}" id="searchForm" class="flex items-center gap-2">
                        @foreach(request()->query() as $k => $v)
                            @if($k !== 'search')
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}" class="preserve-param">
                            @endif
                        @endforeach
                        <label class="sr-only" for="search">Search documents</label>
                        <input id="search" type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search documents..."
                               autocomplete="off"
                               class="h-10 w-full lg:w-80 rounded-lg border border-gray-200 bg-white px-4 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#5EDFFF] focus:ring-offset-2">
                        <button type="submit"
                                class="h-10 inline-flex items-center justify-center rounded-lg bg-[#142F32] px-4 text-sm font-semibold text-white shadow-sm hover:bg-[#1a3f44] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#5EDFFF] focus-visible:ring-offset-2">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span class="ml-2 hidden sm:inline">Search</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Documents Grid -->
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
                <div class="mt-10">
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
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchForm = document.getElementById('searchForm');
            let searchTimeout;

            // Live search with debouncing
            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    
                    const searchValue = this.value.trim();
                    
                    // Debounce: wait 500ms after user stops typing
                    searchTimeout = setTimeout(function() {
                        // Build URL with all current parameters
                        const currentParams = new URLSearchParams(window.location.search);
                        
                        // Update search parameter
                        if (searchValue) {
                            currentParams.set('search', searchValue);
                        } else {
                            currentParams.delete('search');
                        }
                        
                        // Remove page parameter when searching
                        currentParams.delete('page');
                        
                        // Navigate to new URL
                        const newUrl = '{{ route("documents.index") }}' + (currentParams.toString() ? '?' + currentParams.toString() : '');
                        window.location.href = newUrl;
                    }, 500);
                });

                // Handle Enter key - submit immediately
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        searchForm.submit();
                    }
                });
            }
        });
    </script>
    @endpush
@endsection
