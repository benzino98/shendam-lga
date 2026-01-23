<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with(['user', 'images'])->latest()->paginate(15);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galleries,slug',
            'description' => 'nullable|string',
            'type' => 'required|in:event,project,general',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['user_id'] = auth()->id();

        $gallery = Gallery::create($validated);

        return redirect()->route('admin.galleries.show', $gallery)
            ->with('success', 'Gallery created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['images' => function($query) {
            $query->orderBy('order');
        }, 'user']);
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:galleries,slug,' . $gallery->id,
            'description' => 'nullable|string',
            'type' => 'required|in:event,project,general',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete all images
        foreach ($gallery->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }

    /**
     * Upload an image to a gallery.
     */
    public function uploadImage(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:2048',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
        ]);

        foreach ($request->file('images') as $index => $image) {
            $imagePath = $image->store('gallery', 'public');
            
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image_path' => $imagePath,
                'title' => $request->titles[$index] ?? null,
                'description' => $request->descriptions[$index] ?? null,
                'alt_text' => $request->titles[$index] ?? null,
                'order' => $gallery->images()->max('order') + 1,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    /**
     * Delete an image from a gallery.
     */
    public function deleteImage(Gallery $gallery, GalleryImage $image)
    {
        if ($image->gallery_id !== $gallery->id) {
            abort(404);
        }

        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
