<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        $latestPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $featuredGalleries = Gallery::with('images')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.home', compact('latestPosts', 'featuredGalleries'));
    }
}
