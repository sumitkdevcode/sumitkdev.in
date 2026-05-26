<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Media;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        $media = Cache::remember("gallery_media_page_{$page}", 3600, function () {
            return Media::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        });

        return view('gallery', compact('media'));
    }
}

