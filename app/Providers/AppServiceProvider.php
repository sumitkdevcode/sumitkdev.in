<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Only target layout views instead of '*' to avoid redundant queries on partials/components
        View::composer(['layouts.app', 'layouts.admin'], function ($view) {
            $path = '/' . request()->path();
            if ($path === '//')
                $path = '/';

            $cacheKey = 'page_seo_' . md5($path);

            $seo = Cache::remember($cacheKey, 3600, function () use ($path) {
                $seo = \App\Models\PageSeo::where('page_path', $path)->first();

                // If not found, try stripping query strings or trailing slashes
                if (!$seo) {
                    $parentPath = '/' . explode('/', ltrim($path, '/'))[0];
                    $seo = \App\Models\PageSeo::where('page_path', $parentPath)->first();
                }

                return $seo;
            });

            $view->with('seoData', $seo);
        });
    }
}
