<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\PortfolioItem;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $projects = Cache::remember("portfolio_index_page_{$page}", 3600, function () {
            return PortfolioItem::where('is_published', true)
                ->orderBy('order')
                ->paginate(12);
        });

        return view('portfolio.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Cache::remember("portfolio_item_{$slug}", 3600, function () use ($slug) {
            return PortfolioItem::where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
        });

        return view('portfolio.show', compact('project'));
    }
}

