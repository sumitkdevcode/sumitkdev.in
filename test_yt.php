<?php
\Illuminate\Support\Facades\Cache::forget('youtube_videos_v2');
\Illuminate\Support\Facades\Cache::forget('youtube_videos_rss_v2');
$videos = app(\App\Services\SocialMediaService::class)->getYoutubeVideos();
foreach ($videos as $v) {
    echo $v['title'] . "\n";
}
