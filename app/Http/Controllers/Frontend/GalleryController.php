<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index()
    {
        $galleries = Gallery::with(['images', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.gallery.index', compact('galleries'));
    }

    /**
     * Display a specific gallery by slug.
     */
    public function show(string $slug)
    {
        $gallery = Gallery::where('slug', $slug)
            ->with(['images' => function($query) {
                $query->orderBy('order');
            }, 'user'])
            ->firstOrFail();

        return view('frontend.gallery.show', compact('gallery'));
    }
}
