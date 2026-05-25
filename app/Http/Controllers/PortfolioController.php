<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PortfolioItem;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = PortfolioItem::where('is_published', true)
            ->orderBy('order')
            ->paginate(12);

        return view('portfolio.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = PortfolioItem::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('portfolio.show', compact('project'));
    }
}
