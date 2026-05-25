<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('gallery', compact('media'));
    }
}
