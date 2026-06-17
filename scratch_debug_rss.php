<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$channelId = 'UCjTP4KmZdAM8NMeMXPG95Mw';
$rss = \Illuminate\Support\Facades\Http::get("https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}")->body();
$xml = simplexml_load_string($rss);
var_dump($xml !== false);
var_dump(isset($xml->entry));

// Let's also check what gets cached
$videos = app(\App\Services\SocialMediaService::class)->getYoutubeVideos(3);
echo "Count of videos returned: " . count($videos) . "\n";
if (count($videos) > 0) {
    echo "First video ID: " . $videos[0]['id'] . "\n";
}
