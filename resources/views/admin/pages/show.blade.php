@extends('admin.layouts.app')

@section('title', $page->title)
@section('page-title', 'View Page')

@section('content')
    <div class="space-y-6">
        <!-- Page Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $page->title }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this page?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                        <p class="text-gray-900">{{ $page->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $page->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($page->status) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                        <p class="text-gray-900">{{ $page->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $page->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-gray-900">{{ $page->updated_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Content</label>
                    <div class="prose max-w-none p-4 bg-gray-50 rounded-lg border border-gray-200">
                        {!! $page->content !!}
                    </div>
                </div>

                <!-- SEO Info -->
                @if($page->meta_title || $page->meta_description || $page->meta_keywords)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO Information</h3>
                        <div class="space-y-4">
                            @if($page->meta_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Title</label>
                                    <p class="text-gray-900">{{ $page->meta_title }}</p>
                                </div>
                            @endif
                            @if($page->meta_description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Description</label>
                                    <p class="text-gray-900">{{ $page->meta_description }}</p>
                                </div>
                            @endif
                            @if($page->meta_keywords)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Keywords</label>
                                    <p class="text-gray-900">{{ $page->meta_keywords }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Pages
            </a>
            <a href="{{ route('admin.pages.edit', $page) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Page
            </a>
        </div>
    </div>
@endsection
