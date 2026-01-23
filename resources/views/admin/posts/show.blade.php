@extends('admin.layouts.app')

@section('title', $post->title)
@section('page-title', 'View Post')

@section('content')
    <div class="space-y-6">
        <!-- Post Details -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Featured Image -->
                @if($post->featured_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Featured Image</label>
                        <img src="{{ Storage::url($post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="max-w-md rounded-lg border border-gray-300">
                    </div>
                @endif

                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                        <p class="text-gray-900">{{ $post->slug }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                        <p class="text-gray-900">{{ $post->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : ($post->status === 'archived' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Featured</label>
                        <p class="text-gray-900">{{ $post->is_featured ? 'Yes' : 'No' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                        <p class="text-gray-900">{{ $post->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Published At</label>
                        <p class="text-gray-900">{{ $post->published_at ? $post->published_at->format('F d, Y \a\t h:i A') : 'Not published' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                        <p class="text-gray-900">{{ $post->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                        <p class="text-gray-900">{{ $post->updated_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Excerpt -->
                @if($post->excerpt)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Excerpt</label>
                        <p class="text-gray-900">{{ $post->excerpt }}</p>
                    </div>
                @endif

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Content</label>
                    <div class="prose max-w-none p-4 bg-gray-50 rounded-lg border border-gray-200">
                        {!! $post->content !!}
                    </div>
                </div>

                <!-- Tags -->
                @if($post->tags->count() > 0)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Tags</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <span class="px-3 py-1 bg-[#142F32]/10 text-[#142F32] text-sm font-semibold rounded-full">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- SEO Info -->
                @if($post->meta_title || $post->meta_description || $post->meta_keywords)
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO Information</h3>
                        <div class="space-y-4">
                            @if($post->meta_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Title</label>
                                    <p class="text-gray-900">{{ $post->meta_title }}</p>
                                </div>
                            @endif
                            @if($post->meta_description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Description</label>
                                    <p class="text-gray-900">{{ $post->meta_description }}</p>
                                </div>
                            @endif
                            @if($post->meta_keywords)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Meta Keywords</label>
                                    <p class="text-gray-900">{{ $post->meta_keywords }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back to Posts
            </a>
            <a href="{{ route('admin.posts.edit', $post) }}" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                Edit Post
            </a>
        </div>
    </div>
@endsection
