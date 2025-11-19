<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Blog $blog)
    {
        $perPage = $request->integer('per_page', 10); // Get per_page from request, default to 10
        $search = $request->string('search', '');
        $sortBy = $request->array('sort_by', []);
        $status = $request->string('status', '')->trim();

        $query = $blog::query();

        if ($status->value !== '' && $status->value !== null) {
            $query->where('status', '=', $status->value);
        }

        if ($search) {
            $query->where('title', 'like', '%'.$search.'%');
        }

        // Apply sorting
        if (! empty($sortBy)) {
            $query->orderBy($sortBy['key'], $sortBy['order']);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        $paginated = $query->paginate($perPage)->withQueryString();

        return Inertia::render('admin/blog/index', [
            'blogs' => $paginated->items(),
            'search' => $search,
            'pagination' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $blog)
    {
        return Inertia::render('admin/blog/id');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:portfolios|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:published,draft,archived',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        $blogData = collect($validated)->except('featured_image')->toArray();

        $blog = $blog::create($blogData);

        return to_route('blog.show', [$blog]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return Inertia::render('admin/blog/id', [$blog]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return Inertia::render('admin/blog/id', [$blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:portfolios,slug,'.$blog->id,
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|string|in:published,draft,archived',
        ];

        // Only add featured_image validation if a file is present
        if ($request->hasFile('featured_image')) {
            $rules['featured_image'] = 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }

        $validated = $request->validate($rules);

        // Remove featured_image from validated data as we handle it separately
        $portfolioData = collect($validated)->except('featured_image')->toArray();

        if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
            // Only clear if media exists
            $blog->getMedia('portfolio')->each->delete();

            // Add new image
            $blog->addMediaFromRequest('featured_image')
                ->toMediaCollection('portfolio');
        }

        $blog->update($portfolioData);

        return to_route('portfolio.show', [$blog, 'message' => 'Portfolio updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return to_route('blog.index');
    }
}
