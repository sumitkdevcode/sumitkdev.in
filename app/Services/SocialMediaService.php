<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SocialMediaService
{
    /**
     * Get YouTube Videos
     */
    public function getYoutubeVideos($maxResults = 6)
    {
        $apiKey = config('services.youtube.api_key');
        $channelId = config('services.youtube.channel_id') ?: 'UCjTP4KmZdAM8NMeMXPG95Mw'; // Default to @sumitkdev channel

        // Try API first if configured
        if ($apiKey && $channelId && $channelId !== 'UCjTP4KmZdAM8NMeMXPG95Mw') {
            return Cache::remember('youtube_videos_v2', now()->addHours(12), function () use ($apiKey, $channelId, $maxResults) {
                try {
                    $response = Http::get("https://www.googleapis.com/youtube/v3/search", [
                        'key' => $apiKey,
                        'channelId' => $channelId,
                        'part' => 'snippet,id',
                        'order' => 'date',
                        'maxResults' => $maxResults,
                        'type' => 'video'
                    ]);

                    if ($response->successful()) {
                        $items = $response->json('items');
                        return collect($items)->map(function ($item) {
                            return [
                                'id' => $item['id']['videoId'],
                                'title' => $item['snippet']['title'],
                                'description' => $item['snippet']['description'],
                                'thumbnail' => $item['snippet']['thumbnails']['high']['url'] ?? $item['snippet']['thumbnails']['default']['url'],
                                'published_at' => $item['snippet']['publishedAt'],
                                'url' => 'https://www.youtube.com/watch?v=' . $item['id']['videoId'],
                                'embed_url' => 'https://www.youtube.com/embed/' . $item['id']['videoId'],
                            ];
                        })->toArray();
                    }
                    Log::error('YouTube API Error', ['response' => $response->body()]);
                } catch (\Exception $e) {
                    Log::error('YouTube API Exception', ['message' => $e->getMessage()]);
                }
            });
        }

        // Fallback to Public RSS Feed (No API Key Required!)
        return Cache::remember('youtube_videos_rss_v2', now()->addHours(1), function () use ($channelId, $maxResults) {
            try {
                $rss = Http::get("https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}")->body();
                $xml = simplexml_load_string($rss);
                
                if (!$xml || !isset($xml->entry)) {
                    return $this->getDummyYoutubeVideos($maxResults);
                }
                
                $videos = [];
                $count = 0;
                foreach ($xml->entry as $entry) {
                    if ($count >= $maxResults) break;
                    
                    $media = $entry->children('media', true);
                    $yt = $entry->children('yt', true);
                    $videoId = (string)$yt->videoId;
                    
                    $videos[] = [
                        'id' => $videoId,
                        'title' => (string)$entry->title,
                        'description' => (string)$media->group->description,
                        'thumbnail' => (string)$media->group->thumbnail->attributes()->url,
                        'published_at' => (string)$entry->published,
                        'url' => (string)$entry->link->attributes()->href,
                        'embed_url' => 'https://www.youtube.com/embed/' . $videoId,
                    ];
                    $count++;
                }
                
                return count($videos) > 0 ? $videos : $this->getDummyYoutubeVideos($maxResults);
            } catch (\Exception $e) {
                Log::error('YouTube RSS Exception', ['message' => $e->getMessage()]);
                return $this->getDummyYoutubeVideos($maxResults);
            }
        });
    }

    /**
     * Get Instagram Posts
     */
    public function getInstagramPosts($maxResults = 6)
    {
        $accessToken = config('services.instagram.access_token');
        
        // Cache the combined results
        return Cache::remember('instagram_posts_v2', now()->addHours(12), function () use ($accessToken, $maxResults) {
            // First try to fetch from our local database (Admin Social Posts)
            $dbPosts = \App\Models\SocialPost::where('platform', 'instagram')
                ->where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->take($maxResults)
                ->get();

            if ($dbPosts->count() > 0) {
                return $dbPosts->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'caption' => $post->content,
                        'media_type' => $post->media_type,
                        'media_url' => str_starts_with($post->media_url, 'http') ? $post->media_url : asset('storage/' . $post->media_url),
                        'permalink' => $post->permalink ?? '#',
                        'published_at' => $post->published_at->toIso8601String(),
                    ];
                })->toArray();
            }

            // Fallback to API if configured
            if ($accessToken) {
                try {
                    $response = Http::get("https://graph.instagram.com/me/media", [
                        'fields' => 'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp',
                        'access_token' => $accessToken,
                        'limit' => $maxResults
                    ]);

                    if ($response->successful()) {
                        $items = $response->json('data');
                        return collect($items)->map(function ($item) {
                            return [
                                'id' => $item['id'],
                                'caption' => $item['caption'] ?? 'Instagram Post',
                                'media_type' => $item['media_type'],
                                'media_url' => $item['media_type'] === 'VIDEO' ? ($item['thumbnail_url'] ?? '') : $item['media_url'],
                                'permalink' => $item['permalink'],
                                'published_at' => $item['timestamp'],
                            ];
                        })->toArray();
                    }

                    Log::error('Instagram API Error', ['response' => $response->body()]);
                } catch (\Exception $e) {
                    Log::error('Instagram API Exception', ['message' => $e->getMessage()]);
                }
            }

            // Final fallback to dummy data
            return $this->getDummyInstagramPosts($maxResults);
        });
    }

    /**
     * Dummy YouTube Data for testing/schema setup
     */
    private function getDummyYoutubeVideos($limit = 3)
    {
        return [
            [
                'id' => 'dQw4w9WgXcQ',
                'title' => 'Building a Modern Laravel Web App',
                'description' => 'A comprehensive guide to building a modern web application using Laravel, Livewire, and Tailwind CSS.',
                'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=640&q=80',
                'published_at' => now()->subDays(2)->toIso8601String(),
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            ],
            [
                'id' => 'L_jWHffIx5E',
                'title' => 'React vs Vue.js for Beginners',
                'description' => 'Comparing the top two front-end frameworks to help you decide which one to learn next.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=640&q=80',
                'published_at' => now()->subDays(10)->toIso8601String(),
                'url' => 'https://www.youtube.com/watch?v=L_jWHffIx5E',
                'embed_url' => 'https://www.youtube.com/embed/L_jWHffIx5E',
            ],
            [
                'id' => 'k2qgadSvNyU',
                'title' => 'My Developer Workspace Setup',
                'description' => 'Tour of my home office setup for software engineering and content creation.',
                'thumbnail' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=640&q=80',
                'published_at' => now()->subDays(20)->toIso8601String(),
                'url' => 'https://www.youtube.com/watch?v=k2qgadSvNyU',
                'embed_url' => 'https://www.youtube.com/embed/k2qgadSvNyU',
            ],
        ];
    }

    /**
     * Dummy Instagram Data for testing/schema setup
     */
    private function getDummyInstagramPosts($limit = 6)
    {
        return [
            [
                'id' => '1',
                'caption' => 'Delivering high-performance web applications. Follow @sumitkdev.in for coding tips! 🚀 #coding #laravel #developer',
                'media_type' => 'IMAGE',
                'media_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=640&q=80',
                'permalink' => 'https://www.instagram.com/sumitkdev.in/',
                'published_at' => now()->subDays(1)->toIso8601String(),
            ],
            [
                'id' => '2',
                'caption' => 'Coffee, code, and UI/UX design. What are you building today? ☕️💻 @sumitkdev.in',
                'media_type' => 'IMAGE',
                'media_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=640&q=80',
                'permalink' => 'https://www.instagram.com/sumitkdev.in/',
                'published_at' => now()->subDays(4)->toIso8601String(),
            ],
            [
                'id' => '3',
                'caption' => 'Backend architecture planning for a new client project. 🏗️🔥 #webdevelopment',
                'media_type' => 'IMAGE',
                'media_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=640&q=80',
                'permalink' => 'https://www.instagram.com/sumitkdev.in/',
                'published_at' => now()->subDays(7)->toIso8601String(),
            ]
        ];
    }
}
