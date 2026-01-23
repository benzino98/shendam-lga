<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DocumentCategory::withCount('documents')->latest()->paginate(15);
        return view('admin.document-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.document-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:document_categories,slug',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        DocumentCategory::create($validated);

        return redirect()->route('admin.document-categories.index')
            ->with('success', 'Document category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentCategory $documentCategory)
    {
        $documentCategory->load('documents');
        return view('admin.document-categories.show', compact('documentCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentCategory $documentCategory)
    {
        return view('admin.document-categories.edit', compact('documentCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentCategory $documentCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:document_categories,slug,' . $documentCategory->id,
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $documentCategory->update($validated);

        return redirect()->route('admin.document-categories.index')
            ->with('success', 'Document category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentCategory $documentCategory)
    {
        if ($documentCategory->documents()->count() > 0) {
            return back()->with('error', 'Cannot delete category with associated documents.');
        }

        $documentCategory->delete();

        return redirect()->route('admin.document-categories.index')
            ->with('success', 'Document category deleted successfully.');
    }
}
