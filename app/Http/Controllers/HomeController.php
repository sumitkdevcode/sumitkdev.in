<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Cache::remember('home_featured_projects', 3600, function () {
            return \App\Models\PortfolioItem::where('is_published', true)
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        });

        $allBlogs = Cache::remember('home_all_blogs', 1800, function () {
            return \App\Models\BlogPost::where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->get();
        });

        $galleryImages = Cache::remember('home_gallery_images', 3600, function () {
            return \App\Models\Media::where('file_type', 'image')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        });

        $settings = $this->getSettings();

        return view('home', compact('featuredProjects', 'allBlogs', 'galleryImages', 'settings'));
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('about', compact('settings'));
    }

    public function links()
    {
        $settings = $this->getSettings();
        return view('links', compact('settings'));
    }

    private function getSettings()
    {
        return [
            'site_name' => \App\Models\Setting::get('site_name', 'SUMIT KUMAR'),
            'tagline' => \App\Models\Setting::get('tagline', 'Results-oriented Full Stack Developer'),
            'summary' => \App\Models\Setting::get('summary', "Results-oriented Full Stack Developer with a Master's in Computer Applications and hands-on experience in designing, developing, and deploying web applications. Proven ability to contribute to all phases of the development lifecycle, from concept to deployment."),
            'bio' => \App\Models\Setting::get('bio', "Results-oriented Full Stack Developer with a Master's in Computer Applications and hands-on experience in designing, developing, and deploying web applications. Proven ability to contribute to all phases of the development lifecycle, from concept to deployment."),
            'location' => \App\Models\Setting::get('location', 'Greater Noida, Uttar Pradesh, India'),
            'phone' => \App\Models\Setting::get('phone', '+91 8303744132'),
            'email' => \App\Models\Setting::get('email', 'kumar.sumit321321@gmail.com'),
            'github' => \App\Models\Setting::get('github', 'https://github.com/sumitkumar5683'),
            'linkedin' => \App\Models\Setting::get('linkedin', 'https://linkedin.com/in/sumit-kumar-84b869231'),
            'portfolio_url' => \App\Models\Setting::get('portfolio_url', 'https://sumitkdev.in'),
            'education' => \App\Models\Setting::get('education', json_encode([
                ['degree' => 'Master of Computer Applications (MCA)', 'institution' => 'Gautam Buddha University, Greater Noida, Uttar Pradesh', 'year' => '2023-2025'],
                ['degree' => 'Bachelor of Computer Applications (BCA)', 'institution' => 'Galgotias University, Greater Noida, Uttar Pradesh', 'year' => '2020-2023'],
            ])),
        ];
    }
}

