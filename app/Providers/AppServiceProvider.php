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

        View::composer('*', function ($view) {
            $socialLinks = Cache::remember('global_social_links', 3600, function () {
                return \App\Models\SocialLink::where('is_active', true)
                    ->orderBy('order')
                    ->get()
                    ->groupBy('category');
            });
            $view->with('globalSocialLinks', $socialLinks);
        });

        // Override default mail configuration dynamically based on the active SMTP setting
        try {
            $defaultSmtp = Cache::rememberForever('default_smtp_setting', function () {
                if (\Illuminate\Support\Facades\Schema::hasTable('smtp_settings')) {
                    return \App\Models\SmtpSetting::where('is_default', true)->first();
                }
                return null;
            });

            if ($defaultSmtp) {
                config([
                    'mail.default' => $defaultSmtp->mail_mailer ?? 'smtp',
                    'mail.mailers.smtp.host' => $defaultSmtp->mail_host,
                    'mail.mailers.smtp.port' => $defaultSmtp->mail_port,
                    'mail.mailers.smtp.encryption' => $defaultSmtp->mail_encryption,
                    'mail.mailers.smtp.username' => $defaultSmtp->mail_username,
                    'mail.mailers.smtp.password' => $defaultSmtp->mail_password,
                    'mail.from.address' => $defaultSmtp->mail_from_address,
                    'mail.from.name' => $defaultSmtp->mail_from_name,
                ]);
            }
        } catch (\Exception $e) {
            // Safely ignore during initial setup / migrations
        }
    }
}
