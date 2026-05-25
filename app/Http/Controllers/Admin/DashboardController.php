<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects_count' => \App\Models\PortfolioItem::count(),
            'featured_count' => \App\Models\PortfolioItem::where('is_featured', true)->count(),
            'posts_count' => \App\Models\BlogPost::count(),
            'published_posts_count' => \App\Models\BlogPost::where('is_published', true)->count(),
            'messages_unread' => \App\Models\ContactMessage::where('is_read', false)->count(),
            'total_views' => \App\Models\BlogPost::sum('views'),
        ];

        $recent_messages = \App\Models\ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages'));
    }
}
