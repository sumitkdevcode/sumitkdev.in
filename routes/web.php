<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolio;
use App\Http\Controllers\Admin\BlogController as AdminBlog;
use App\Http\Controllers\Admin\MediaController as AdminMedia;
use App\Http\Controllers\Admin\CategoryController as AdminCategory;
use App\Http\Controllers\Admin\SettingController as AdminSetting;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Frontend Routes (with HTTP cache headers)
|--------------------------------------------------------------------------
*/
Route::middleware(['cache.page'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    Route::get('/gallery', [MediaController::class, 'index'])->name('gallery');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::get('/links', [HomeController::class, 'links'])->name('links');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| SEO Routes (Sitemap & Robots)
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', function () {
    $content = \Illuminate\Support\Facades\Cache::remember('sitemap_xml', 21600, function () {
        $posts = \App\Models\BlogPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        $portfolios = \App\Models\PortfolioItem::where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        // Static pages
        $staticPages = [
            ['url' => url('/'),           'priority' => '1.0',  'changefreq' => 'daily'],
            ['url' => url('/about'),      'priority' => '0.9',  'changefreq' => 'monthly'],
            ['url' => url('/portfolio'),  'priority' => '0.9',  'changefreq' => 'weekly'],
            ['url' => url('/blog'),       'priority' => '0.9',  'changefreq' => 'daily'],
            ['url' => url('/gallery'),    'priority' => '0.7',  'changefreq' => 'weekly'],
            ['url' => url('/contact'),    'priority' => '0.8',  'changefreq' => 'monthly'],
            ['url' => url('/links'),      'priority' => '0.8',  'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $content .= '  <url>' . "\n";
            $content .= '    <loc>' . $page['url'] . '</loc>' . "\n";
            $content .= '    <lastmod>' . now()->toDateString() . '</lastmod>' . "\n";
            $content .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
            $content .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
            $content .= '  </url>' . "\n";
        }

        // Blog posts (with image tags)
        foreach ($posts as $post) {
            $content .= '  <url>' . "\n";
            $content .= '    <loc>' . url('/blog/' . $post->slug) . '</loc>' . "\n";
            $content .= '    <lastmod>' . $post->updated_at->toDateString() . '</lastmod>' . "\n";
            $content .= '    <changefreq>monthly</changefreq>' . "\n";
            $content .= '    <priority>0.8</priority>' . "\n";
            if ($post->featured_image) {
                $imageUrl = str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image);
                $content .= '    <image:image>' . "\n";
                $content .= '      <image:loc>' . htmlspecialchars($imageUrl) . '</image:loc>' . "\n";
                $content .= '      <image:title>' . htmlspecialchars($post->title) . '</image:title>' . "\n";
                $content .= '      <image:caption>' . htmlspecialchars(Str::limit(strip_tags($post->excerpt ?? ''), 100)) . '</image:caption>' . "\n";
                $content .= '    </image:image>' . "\n";
            }
            $content .= '  </url>' . "\n";
        }

        // Portfolio items
        foreach ($portfolios as $project) {
            $content .= '  <url>' . "\n";
            $content .= '    <loc>' . url('/portfolio/' . $project->slug) . '</loc>' . "\n";
            $content .= '    <lastmod>' . $project->updated_at->toDateString() . '</lastmod>' . "\n";
            $content .= '    <changefreq>monthly</changefreq>' . "\n";
            $content .= '    <priority>0.7</priority>' . "\n";
            $content .= '  </url>' . "\n";
        }

        $content .= '</urlset>';

        return $content;
    });

    return response($content, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::get('/robots.txt', function () {
    $content = \Illuminate\Support\Facades\Cache::remember('robots_txt', 86400, function () {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /dashboard\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "Disallow: /profile\n";
        $content .= "Disallow: /forgot-password\n";
        $content .= "Disallow: /reset-password\n";
        $content .= "Disallow: /verify-email\n";
        $content .= "Disallow: /confirm-password\n";
        $content .= "Disallow: /email/verification-notification\n\n";
        $content .= "# Sitemap\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
        return $content;
    });

    return response($content, 200, ['Content-Type' => 'text/plain']);
})->name('robots');

/*
|--------------------------------------------------------------------------
| Profile Routes (Standard Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth and admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('portfolio', AdminPortfolio::class);
    Route::resource('blog', AdminBlog::class);
    Route::resource('media', AdminMedia::class);
    Route::resource('categories', AdminCategory::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/settings', [AdminSetting::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSetting::class, 'update'])->name('settings.update');

    Route::resource('seo', \App\Http\Controllers\Admin\PageSeoController::class);

    Route::get('/contacts', [AdminContact::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [AdminContact::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{id}', [AdminContact::class, 'destroy'])->name('contacts.destroy');
});

require __DIR__ . '/auth.php';
