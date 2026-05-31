<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,webp,mp4,mov,ogg|max:20480', // 20MB max
            'title' => 'nullable|max:255',
            'category' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $mime = $file->getMimeType();
        $type = str_contains($mime, 'video') ? 'video' : 'image';

        // Convert images to WebP, store videos as-is
        if ($type === 'image') {
            $path = ImageHelper::storeAsWebp($file, 'media');
            $mime = 'image/webp'; // Update MIME after conversion
        } else {
            $path = $file->store('media', 'public');
        }


        Media::create([
            'title' => $request->title ?: $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $type,
            'mime_type' => $mime,
            'file_size' => round($file->getSize() / 1024),
            'category' => $request->category,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media uploaded successfully.');
    }

    public function destroy(Media $medium)
    {
        Storage::disk('public')->delete($medium->file_path);
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted.');
    }

    public function edit(Media $medium)
    {
        return view('admin.media.edit', compact('medium'));
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'category' => 'nullable|string',
        ]);

        $medium->update([
            'title' => $request->title,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully.');
    }
}
