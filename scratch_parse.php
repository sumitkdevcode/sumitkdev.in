<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$channelId = 'UCjTP4KmZdAM8NMeMXPG95Mw';
$maxResults = 3;

$rss = \Illuminate\Support\Facades\Http::get("https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}")->body();
$xml = simplexml_load_string($rss);

$videos = [];
$count = 0;
foreach ($xml->entry as $entry) {
    if ($count >= $maxResults) break;
    
    $media = $entry->children('http://search.yahoo.com/mrss/');
    $yt = $entry->children('http://www.youtube.com/xml/schemas/2015');
    
    // In original code: $media = $entry->children('media', true);
    // Is 'media' mapped correctly? Let's check original logic:
    $mediaOrig = $entry->children('media', true);
    $ytOrig = $entry->children('yt', true);
    
    echo "Video ID: " . (string)$ytOrig->videoId . "\n";
    echo "Title: " . (string)$entry->title . "\n";
    
    $videos[] = [
        'id' => (string)$ytOrig->videoId,
        'title' => (string)$entry->title,
        'description' => (string)$mediaOrig->group->description,
        'thumbnail' => (string)$mediaOrig->group->thumbnail->attributes()->url,
        'published_at' => (string)$entry->published,
        'url' => (string)$entry->link->attributes()->href,
        'embed_url' => 'https://www.youtube.com/embed/' . (string)$ytOrig->videoId,
    ];
    $count++;
}
echo "Parsed videos count: " . count($videos) . "\n";
print_r($videos);
