<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    public function index(Request $request)
    {
        $query = Document::with(['category', 'user']);

        // Type filter (institutional tabs) - handle both plural and singular
        if ($request->filled('type')) {
            $type = strtolower(trim((string) $request->type));
            $typeMap = [
                'reports' => 'report',
                'report' => 'report',
                'budgets' => 'budget',
                'budget' => 'budget',
                'policies' => 'policy',
                'policy' => 'policy',
                'circulars' => 'statement',
                'circular' => 'statement',
                'statements' => 'statement',
                'statement' => 'statement',
                'other' => 'other',
            ];

            if (isset($typeMap[$type])) {
                $query->where('type', $typeMap[$type]);
            }
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search filter (title, description, category name, type, file name)
        // Also handle type matching for search (e.g., "reports" should match type "report")
        if ($request->filled('search')) {
            $search = trim((string) $request->search);
            $searchLower = strtolower($search);

            // Map search terms to type values for better matching
            $typeSearchMap = [
                'reports' => 'report',
                'report' => 'report',
                'budgets' => 'budget',
                'budget' => 'budget',
                'policies' => 'policy',
                'policy' => 'policy',
                'circulars' => 'statement',
                'circular' => 'statement',
                'statements' => 'statement',
                'statement' => 'statement',
            ];

            $query->where(function ($q) use ($search, $searchLower, $typeSearchMap) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('file_name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%");
                  });

                // Handle type matching - check if search term matches a type
                if (isset($typeSearchMap[$searchLower])) {
                    $q->orWhere('type', $typeSearchMap[$searchLower]);
                } else {
                    // Also do a LIKE search on type field
                    $q->orWhere('type', 'like', "%{$searchLower}%");
                }
            });
        }

        $documents = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Get ALL categories, regardless of document count
        $categories = DocumentCategory::withCount('documents')
            ->orderBy('name')
            ->get();

        // If AJAX request, return only the documents grid partial
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('frontend.documents.partials.documents-grid', compact('documents'))->render()
            ]);
        }

        return view('frontend.documents.index', compact('documents', 'categories'));
    }

    /**
     * Display a specific document by slug.
     */
    public function show(string $slug)
    {
        $document = Document::where('slug', $slug)
            ->with(['category', 'user'])
            ->firstOrFail();

        return view('frontend.documents.show', compact('document'));
    }

    /**
     * Preview a specific document by slug (for iframe display).
     */
    public function preview(string $slug)
    {
        $document = Document::where('slug', $slug)->firstOrFail();

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found');
        }

        $filePath = Storage::disk('public')->path($document->file_path);
        
        // Get MIME type, default to application/pdf if detection fails
        try {
            $mimeType = Storage::disk('public')->mimeType($document->file_path);
            if (!$mimeType) {
                $mimeType = 'application/pdf';
            }
        } catch (\Throwable $e) {
            $mimeType = 'application/pdf';
        }

        // Ensure PDF files have correct MIME type
        if (str_contains(strtolower((string) $document->file_type), 'pdf')) {
            $mimeType = 'application/pdf';
        }

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . addslashes($document->file_name) . '"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * Download a specific document by slug.
     */
    public function download(string $slug)
    {
        $document = Document::where('slug', $slug)->firstOrFail();

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found');
        }

        // Increment download count
        $document->increment('download_count');

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
