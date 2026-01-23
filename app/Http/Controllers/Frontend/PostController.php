<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index(Request $request)
    {
        $query = Post::where('status', 'published')
            ->with(['category', 'user']);

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::withCount('posts')->get();

        return view('frontend.posts.index', compact('posts', 'categories'));
    }

    /**
     * Display a specific post by slug.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'user', 'tags'])
            ->firstOrFail();

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                if ($post->category_id) {
                    $query->where('category_id', $post->category_id);
                }
            })
            ->take(3)
            ->get();

        return view('frontend.posts.show', compact('post', 'relatedPosts'));
    }
}
