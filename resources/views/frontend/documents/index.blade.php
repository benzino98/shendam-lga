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
                    <h1 class="heading-display text-3xl md:text-4xl lg:text-5xl font-bold text-[#142F32] tracking-tight">Documents</h1>
                    <p class="text-gray-600 max-w-3xl text-base md:text-lg">
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
            <div id="documentsContainer">
                @include('frontend.documents.partials.documents-grid', ['documents' => $documents])
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchForm = document.getElementById('searchForm');
            const documentsContainer = document.getElementById('documentsContainer');
            let searchTimeout;
            let isLoading = false;

            // Format bytes helper
            function formatBytes(bytes) {
                if (!bytes || bytes <= 0) return null;
                const kb = 1024;
                const mb = kb * 1024;
                const gb = mb * 1024;
                if (bytes >= gb) return (bytes / gb).toFixed(1) + ' GB';
                if (bytes >= mb) return (bytes / mb).toFixed(1) + ' MB';
                return Math.round(bytes / kb) + ' KB';
            }

            // Format file type helper
            function formatFileType(fileType) {
                if (!fileType) return '—';
                const t = fileType.toLowerCase();
                if (t.includes('pdf')) return 'PDF';
                if (t.includes('word')) return 'DOC';
                if (t.includes('excel') || t.includes('spreadsheet')) return 'XLS';
                if (t.includes('powerpoint') || t.includes('presentation')) return 'PPT';
                const parts = t.split('/');
                return parts[parts.length - 1].toUpperCase() || t.toUpperCase();
            }

            // Load documents via AJAX
            function loadDocuments(params = {}) {
                if (isLoading) return;
                isLoading = true;

                // Show loading state
                documentsContainer.innerHTML = '<div class="text-center py-16"><div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#142F32]"></div><p class="mt-4 text-gray-600">Loading documents...</p></div>';

                // Build query string
                const queryParams = new URLSearchParams();
                Object.keys(params).forEach(key => {
                    if (params[key]) {
                        queryParams.append(key, params[key]);
                    }
                });

                // Make AJAX request
                fetch('{{ route("documents.index") }}?' + queryParams.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.html) {
                        documentsContainer.innerHTML = data.html;
                        
                        // Update URL without reload
                        const newUrl = '{{ route("documents.index") }}' + (queryParams.toString() ? '?' + queryParams.toString() : '');
                        window.history.pushState({}, '', newUrl);
                        
                        // Reinitialize Lucide icons
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }
                })
                .catch(error => {
                    console.error('Error loading documents:', error);
                    documentsContainer.innerHTML = '<div class="text-center py-16"><div class="bg-white rounded-xl border border-gray-200 shadow-sm p-10 max-w-md mx-auto"><i data-lucide="alert-circle" class="w-12 h-12 text-red-400 mx-auto mb-4"></i><h3 class="text-lg font-bold text-[#142F32] mb-2">Error loading documents</h3><p class="text-sm text-gray-600">Please try again.</p></div></div>';
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                })
                .finally(() => {
                    isLoading = false;
                });
            }

            // Live search with debouncing
            if (searchInput && searchForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    
                    const searchValue = this.value.trim();
                    
                    // Debounce: wait 400ms after user stops typing
                    searchTimeout = setTimeout(function() {
                        // Get all current parameters
                        const currentParams = new URLSearchParams(window.location.search);
                        
                        // Update search parameter
                        if (searchValue) {
                            currentParams.set('search', searchValue);
                        } else {
                            currentParams.delete('search');
                        }
                        
                        // Remove page parameter when searching
                        currentParams.delete('page');
                        
                        // Convert to object
                        const params = {};
                        currentParams.forEach((value, key) => {
                            params[key] = value;
                        });
                        
                        // Load documents via AJAX
                        loadDocuments(params);
                    }, 400);
                });

                // Handle Enter key - submit immediately
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        
                        const currentParams = new URLSearchParams(window.location.search);
                        if (this.value.trim()) {
                            currentParams.set('search', this.value.trim());
                        } else {
                            currentParams.delete('search');
                        }
                        currentParams.delete('page');
                        
                        const params = {};
                        currentParams.forEach((value, key) => {
                            params[key] = value;
                        });
                        
                        loadDocuments(params);
                    }
                });
            }

            // Handle category form change
            const categoryForm = document.getElementById('categoryForm');
            if (categoryForm) {
                const categorySelect = document.getElementById('category');
                if (categorySelect) {
                    categorySelect.addEventListener('change', function() {
                        const currentParams = new URLSearchParams(window.location.search);
                        
                        if (this.value) {
                            currentParams.set('category', this.value);
                        } else {
                            currentParams.delete('category');
                        }
                        currentParams.delete('page');
                        
                        const params = {};
                        currentParams.forEach((value, key) => {
                            params[key] = value;
                        });
                        
                        loadDocuments(params);
                    });
                }
            }

            // Handle type tab clicks - prevent default and use AJAX, preserve search and category
            document.querySelectorAll('a[href*="documents.index"]').forEach(link => {
                if (link.closest('.flex.flex-wrap')) { // Only type tabs
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        
                        // Preserve current search and category parameters
                        const currentParams = new URLSearchParams(window.location.search);
                        const searchValue = currentParams.get('search');
                        const categoryValue = currentParams.get('category');
                        
                        // Build params object from URL
                        const params = {};
                        url.searchParams.forEach((value, key) => {
                            params[key] = value;
                        });
                        
                        // Preserve search if it exists
                        if (searchValue) {
                            params.search = searchValue;
                        }
                        
                        // Preserve category if it exists
                        if (categoryValue) {
                            params.category = categoryValue;
                        }
                        
                        // Remove page parameter
                        delete params.page;
                        
                        loadDocuments(params);
                    });
                }
            });
        });
    </script>
    @endpush
@endsection
