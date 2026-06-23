<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WarmupCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warmup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pre-warm critical application caches for fast first-load performance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🔥 Warming up application caches...');
        $start = microtime(true);

        // 1. Settings (loads all in one query)
        $this->task('Settings', function () {
            \App\Models\Setting::get('site_name');
        });

        // 2. Social Links
        $this->task('Social Links', function () {
            Cache::remember('global_social_links', 3600, function () {
                return \App\Models\SocialLink::where('is_active', true)
                    ->orderBy('order')
                    ->get()
                    ->groupBy('category');
            });
        });

        // 3. Featured Projects (home page)
        $this->task('Featured Projects', function () {
            Cache::remember('home_featured_projects', 3600, function () {
                return \App\Models\PortfolioItem::where('is_published', true)
                    ->orderBy('order')
                    ->orderBy('created_at', 'desc')
                    ->take(6)
                    ->get();
            });
        });

        // 4. Blog Posts (home page)
        $this->task('Home Blogs', function () {
            Cache::remember('home_all_blogs', 1800, function () {
                return \App\Models\BlogPost::where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->take(12)
                    ->get();
            });
        });

        // 5. Gallery Images (home page)
        $this->task('Gallery Images', function () {
            Cache::remember('home_gallery_images', 3600, function () {
                return \App\Models\Media::where('file_type', 'image')
                    ->orderBy('created_at', 'desc')
                    ->take(8)
                    ->get();
            });
        });

        // 6. Blog categories
        $this->task('Blog Categories', function () {
            Cache::remember('blog_categories_list', 3600, function () {
                return \App\Models\BlogPost::where('is_published', true)
                    ->select('category')
                    ->distinct()
                    ->pluck('category')
                    ->filter()
                    ->sort()
                    ->values();
            });
        });

        // 7. Blog index page 1
        $this->task('Blog Index (Page 1)', function () {
            $cacheKey = 'blog_index_page_1_search_' . md5('') . '_category_' . md5('');
            Cache::remember($cacheKey, 1800, function () {
                return \App\Models\BlogPost::with('author')
                    ->where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);
            });
        });

        // 8. Portfolio index page 1
        $this->task('Portfolio Index (Page 1)', function () {
            Cache::remember('portfolio_index_page_1', 3600, function () {
                return \App\Models\PortfolioItem::where('is_published', true)
                    ->orderBy('order')
                    ->paginate(12);
            });
        });

        // 9. SEO data for key pages
        $this->task('SEO Data', function () {
            $paths = ['/', '/about', '/portfolio', '/blog', '/contact', '/gallery', '/feed', '/links', '/tools'];
            foreach ($paths as $path) {
                $cacheKey = 'page_seo_' . md5($path);
                Cache::remember($cacheKey, 3600, function () use ($path) {
                    return \App\Models\PageSeo::where('page_path', $path)->first();
                });
            }
        });

        // 10. SMTP settings
        $this->task('SMTP Settings', function () {
            Cache::rememberForever('default_smtp_setting', function () {
                try {
                    return \App\Models\SmtpSetting::where('is_default', true)->first();
                } catch (\Exception $e) {
                    return null;
                }
            });
        });

        // 11. YouTube RSS Feed (with timeout)
        $this->task('YouTube RSS Feed', function () {
            $channelId = trim(config('services.youtube.channel_id') ?: 'UCjTP4KmZdAM8NMeMXPG95Mw');
            Cache::remember('youtube_videos_rss_v2', now()->addHours(6), function () use ($channelId) {
                try {
                    $rss = Http::timeout(5)->get("https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}")->body();
                    $xml = simplexml_load_string($rss);

                    if (!$xml || !isset($xml->entry)) {
                        return [];
                    }

                    $videos = [];
                    $count = 0;
                    foreach ($xml->entry as $entry) {
                        if ($count >= 3) break;
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

                    return $videos;
                } catch (\Exception $e) {
                    return [];
                }
            });
        });

        // 12. Social Posts
        $this->task('Social Posts', function () {
            Cache::remember('social_posts_v2', now()->addHours(24), function () {
                $dbPosts = \App\Models\SocialPost::where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->take(6)
                    ->get();

                if ($dbPosts->count() > 0) {
                    return $dbPosts->map(function ($post) {
                        return [
                            'id' => $post->id,
                            'platform' => $post->platform,
                            'caption' => $post->content,
                            'media_type' => $post->media_type,
                            'media_url' => $post->media_url ? (str_starts_with($post->media_url, 'http') ? $post->media_url : asset('storage/' . $post->media_url)) : '',
                            'permalink' => $post->permalink ?? '#',
                            'published_at' => $post->published_at->toIso8601String(),
                        ];
                    })->toArray();
                }

                return [];
            });
        });

        // 13. Sitemap
        $this->task('Sitemap Cache', function () {
            Cache::remember('sitemap_xml', 21600, function () {
                return 'warmed'; // Just ensure the key exists; actual content generated on first request
            });
        });

        $elapsed = round(microtime(true) - $start, 2);
        $this->newLine();
        $this->info("✅ Cache warmup completed in {$elapsed}s");

        return Command::SUCCESS;
    }

    /**
     * Run a task with visual feedback.
     */
    private function task(string $name, \Closure $callback): void
    {
        $this->output->write("  ⏳ {$name}...");
        try {
            $callback();
            $this->output->writeln(" <fg=green>✓</>");
        } catch (\Exception $e) {
            $this->output->writeln(" <fg=red>✗ {$e->getMessage()}</>");
        }
    }
}
