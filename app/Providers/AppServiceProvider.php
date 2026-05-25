<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $path = '/' . request()->path();
            if ($path === '//')
                $path = '/';

            $seo = \App\Models\PageSeo::where('page_path', $path)->first();

            // If not found, try stripping query strings or trailing slashes
            if (!$seo) {
                $path = '/' . explode('/', request()->path())[0];
                $seo = \App\Models\PageSeo::where('page_path', $path)->first();
            }

            $view->with('seoData', $seo);
        });
    }
}
