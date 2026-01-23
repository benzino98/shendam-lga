@extends('admin.layouts.app')

@section('title', $category->name)
@section('page-title', 'View Category')

@section('content')
    <div class="space-y-6">
        <!-- Category Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                        <p class="text-gray-900">{{ $category->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Posts Count</label>
                        <span class="inline-block px-2 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $category->posts->count() }} {{ Str::plural('post', $category->posts->count()) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $category->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-gray-900">{{ $category->updated_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($category->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                        <p class="text-gray-900">{{ $category->description }}</p>
                    </div>
                @endif

                <!-- Posts -->
                @if($category->posts->count() > 0)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Posts in this Category</h3>
                        <div class="space-y-2">
                            @foreach($category->posts as $post)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <a href="{{ route('admin.posts.show', $post) }}" class="text-sm font-medium text-[#142F32] hover:underline">
                                        {{ $post->title }}
                                    </a>
                                    <span class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Categories
            </a>
            <a href="{{ route('admin.categories.edit', $category) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Category
            </a>
        </div>
    </div>
@endsection
