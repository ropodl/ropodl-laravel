<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PortfolioType $type)
    {
        $perPage = $request->input('per_page', 10); // Get per_page from request, default to 10
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', []);

        $query = $type::query();

        if ($search) {
            $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('content', 'like', '%'.$search.'%');
        }

        // Apply sorting
        if (! empty($sortBy)) {
            $query->orderBy($sortBy['key'], $sortBy['order']);
        } else {
            $query->orderBy('updated_at', 'desc');
        }

        $paginated = $query->paginate($perPage);

        return Inertia::render('admin/portfolio/type', [
            'types' => $paginated->items(), // Only portfolio items
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
        // return Inertia::render('admin/portfolio/id');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PortfolioType $type)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:portfolio_types,slug|max:255',
        ]);

        $portfolioType = collect($validated)->toArray();

        $portfolioType = $type::create($portfolioType);

        return to_route('portfolio-type.index', [$portfolioType])->with('message', 'Successfully created new portfolio.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PortfolioType $portfolioType)
    {
        // return Inertia::render('admin/portfolio/id', ['portfolio' => $portfolio]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioType $portfolio_type)
    {
        return Inertia::render('admin/portfolio/id', [
            'portfolio_type' => $portfolio_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PortfolioType $type)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:portfolio_types,slug,'.$type->id,
        ]);

        $type->update($validated);

        return to_route('portfolio-type.index')
            ->with('message', 'Portfolio type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioType $type)
    {
        $type->delete();

        return to_route('portfolio.index')->with('message', 'Portfolio deleted successfully.');
    }
}
