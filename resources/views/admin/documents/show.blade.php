@extends('admin.layouts.app')

@section('title', $document->title)
@section('page-title', 'View Document')

@section('content')
    <div class="space-y-6">
        <!-- Document Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $document->title }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.documents.edit', $document) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.documents.destroy', $document) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this document?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- File Info -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Document File</h3>
                            <p class="text-sm text-gray-600">{{ $document->file_name }}</p>
                        </div>
                        <a href="{{ Storage::url($document->file_path) }}" 
                           target="_blank"
                           download
                           class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                            Download
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Type:</span>
                            <span class="ml-2 font-medium text-gray-900">{{ strtoupper($document->file_type) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Size:</span>
                            <span class="ml-2 font-medium text-gray-900">{{ number_format($document->file_size / 1024, 1) }} KB</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Downloads:</span>
                            <span class="ml-2 font-medium text-gray-900">{{ $document->download_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                        <p class="text-gray-900">{{ $document->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                        <p class="text-gray-900">{{ $document->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Type</label>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                            {{ ucfirst($document->type) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                        <p class="text-gray-900">{{ $document->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $document->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-gray-900">{{ $document->updated_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($document->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                        <p class="text-gray-900">{{ $document->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.documents.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Documents
            </a>
            <a href="{{ route('admin.documents.edit', $document) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Document
            </a>
        </div>
    </div>
@endsection
