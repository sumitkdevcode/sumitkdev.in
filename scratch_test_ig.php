<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clear the cache manually first
\Illuminate\Support\Facades\Cache::forget('instagram_posts');

$maxResults = 6;
$dbPosts = \App\Models\SocialPost::where('platform', 'instagram')
    ->where('is_published', true)
    ->orderBy('published_at', 'desc')
    ->take($maxResults)
    ->get();

echo "DB Posts Count: " . $dbPosts->count() . "\n";

if ($dbPosts->count() > 0) {
    $mapped = $dbPosts->map(function ($post) {
        return [
            'id' => $post->id,
            'caption' => $post->content,
            'media_type' => $post->media_type,
            'media_url' => str_starts_with($post->media_url, 'http') ? $post->media_url : asset('storage/' . $post->media_url),
            'permalink' => $post->permalink ?? '#',
            'published_at' => $post->published_at,
        ];
    })->toArray();
    echo "Mapped data:\n";
    print_r($mapped);
} else {
    echo "No db posts found!\n";
}

$servicePosts = app(\App\Services\SocialMediaService::class)->getInstagramPosts($maxResults);
echo "\nService Returned:\n";
print_r($servicePosts);
