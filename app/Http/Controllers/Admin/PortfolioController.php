<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Portfolio $portfolio)
    {
        $perPage = $request->input('per_page', 10); // Get per_page from request, default to 10
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', []);

        $query = $portfolio::query();

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

        return Inertia::render('admin/portfolio/index', [
            'portfolios' => $paginated->items(), // Only portfolio items
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
    public function create(PortfolioType $type)
    {
        return Inertia::render('admin/portfolio/id', ['types' => $type::all(['id', 'title'])]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:portfolios|max:255',
            'content' => 'required|string',
            'status' => 'required|string|in:published,draft,archived',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'portfolio_type_id' => 'required|exists:portfolio_types,id',
        ]);

        // Remove featured_image from validated data as we handle it separately
        $portfolioData = collect($validated)->except('featured_image')->toArray();

        $portfolio = Portfolio::create($portfolioData);

        // if ($request->hasFile('featured_image')) {
        //     // $portfolio->clearMediaCollection('featured_image');
        //     $portfolio->addMediaFromRequest('featured_image')
        //         ->toMediaCollection('portfolio');
        // }

        return to_route('portfolio.show', [$portfolio])->with('message', 'Successfully created new portfolio.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio, PortfolioType $type)
    {
        return Inertia::render('admin/portfolio/id', ['portfolio' => $portfolio, 'types' => $type::all(['id', 'title'])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio, PortfolioType $type)
    {
        return Inertia::render('admin/portfolio/id', [
            'portfolio' => $portfolio,
            'types' => $type::all(['id', 'title']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:portfolios,slug,'.$portfolio->id,
            'content' => 'required|string',
            'status' => 'required|string|in:published,draft,archived',
            'portfolio_type_id' => 'required|exists:portfolio_types,id',
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
            $portfolio->getMedia('portfolio')->each->delete();

            // Add new image
            $portfolio->addMediaFromRequest('featured_image')
                ->toMediaCollection('portfolio');
        }

        $portfolio->update($portfolioData);

        return to_route('portfolio.show', [$portfolio, 'message' => 'Portfolio updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return to_route('portfolio.index')->with('message', 'Portfolio deleted successfully.');
    }
}
