@extends('admin.layouts.app')

@section('title', $gallery->name)
@section('page-title', 'View Gallery')

@section('content')
    <div class="space-y-6">
        <!-- Gallery Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $gallery->name }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this gallery? All images will be deleted.');">
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
                        <p class="text-gray-900">{{ $gallery->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Type</label>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ ucfirst($gallery->type) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                        <p class="text-gray-900">{{ $gallery->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Images</label>
                        <span class="inline-block px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $gallery->images->count() }} {{ Str::plural('image', $gallery->images->count()) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $gallery->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($gallery->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                        <p class="text-gray-900">{{ $gallery->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Image Upload Section -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Upload Images</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.galleries.images.upload', $gallery) }}" method="POST" enctype="multipart/form-data" id="upload-form">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Select Images</label>
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   multiple 
                                   accept="image/*"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                            <p class="mt-1 text-sm text-gray-500">You can select multiple images at once. Max 2MB per image.</p>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                            Upload Images
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Images Grid -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Gallery Images ({{ $gallery->images->count() }})</h3>
            </div>
            <div class="p-6">
                @if($gallery->images->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($gallery->images as $image)
                            <div class="relative group">
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $image->alt_text ?? $image->title ?? 'Gallery image' }}" 
                                     class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                    <form action="{{ route('admin.galleries.images.delete', [$gallery, $image]) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this image?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                @if($image->title)
                                    <p class="mt-2 text-sm text-gray-700 truncate">{{ $image->title }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">No images uploaded yet. Use the form above to upload images.</p>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.galleries.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Galleries
            </a>
            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Gallery
            </a>
        </div>
    </div>
@endsection
