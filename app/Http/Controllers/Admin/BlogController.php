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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
