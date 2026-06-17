<?php
$rss = file_get_contents('https://www.youtube.com/feeds/videos.xml?channel_id=UCjTP4KmZdAM8NMeMXPG95Mw');
$xml = simplexml_load_string($rss);
$videos = [];
foreach ($xml->entry as $entry) {
    $media = $entry->children('media', true);
    $videos[] = [
        'id' => (string)$entry->children('yt', true)->videoId,
        'title' => (string)$entry->title,
        'thumbnail' => (string)$media->group->thumbnail->attributes()->url,
        'published_at' => (string)$entry->published,
        'url' => (string)$entry->link->attributes()->href,
        'embed_url' => 'https://www.youtube.com/embed/' . (string)$entry->children('yt', true)->videoId,
    ];
}
print_r($videos);
