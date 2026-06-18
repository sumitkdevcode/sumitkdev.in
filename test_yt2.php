<?php
$channelId = trim(config('services.youtube.channel_id') ?: 'UCjTP4KmZdAM8NMeMXPG95Mw');
echo "CHANNEL ID IS: '" . $channelId . "'\n";
echo "URL IS: 'https://www.youtube.com/feeds/videos.xml?channel_id=" . $channelId . "'\n";
$response = \Illuminate\Support\Facades\Http::get("https://www.youtube.com/feeds/videos.xml?channel_id=" . $channelId);
echo "RESPONSE STATUS: " . $response->status() . "\n";
echo substr($response->body(), 0, 100) . "\n";
