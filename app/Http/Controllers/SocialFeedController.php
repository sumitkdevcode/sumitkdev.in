<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialMediaService;

class SocialFeedController extends Controller
{
    protected $socialMediaService;

    public function __construct(SocialMediaService $socialMediaService)
    {
        $this->socialMediaService = $socialMediaService;
    }

    public function index()
    {
        $youtubeVideos = $this->socialMediaService->getYoutubeVideos(3);
        $socialPosts = $this->socialMediaService->getSocialPosts(6);

        // Optional SEO Data
        $seoData = (object) [
            'meta_title' => 'Social Feed - Sumit Kumar',
            'meta_description' => 'Check out the latest YouTube videos and Social posts from Sumit Kumar.',
            'og_title' => 'Social Feed - Sumit Kumar',
            'og_description' => 'Check out the latest YouTube videos and Social posts from Sumit Kumar.',
        ];

        return view('social.feed', compact('youtubeVideos', 'socialPosts', 'seoData'));
    }
}
