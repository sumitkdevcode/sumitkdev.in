<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageSeo;

class PageSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_path' => '/',
                'page_name' => 'Home',
                'meta_title' => 'Sumit Kumar (sumitkdev) — Full Stack Developer & Software Engineer',
                'meta_description' => 'Sumit Kumar (sumitkdev) is a Full Stack Developer & Software Engineer specializing in Laravel, React, Vue.js, and modern web technologies. Explore portfolio, read 500+ tutorials, and hire for projects.',
                'meta_keywords' => 'sumitkdev, Sumit Kumar, Full Stack Developer, Software Engineer, Laravel Expert, React Developer, Web Development, sumitkdev.in',
                'og_title' => 'Sumit Kumar (sumitkdev) — Full Stack Developer & Software Engineer',
                'og_description' => 'Official website of Sumit Kumar (sumitkdev). Explore portfolio, read technical tutorials, and hire me for your next project.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'about',
                'page_name' => 'About Me',
                'meta_title' => 'About Sumit Kumar (sumitkdev) — My Journey & Skills',
                'meta_description' => 'Learn about Sumit Kumar (sumitkdev) — MCA graduate, Software Engineer at Web IT Squad. 3+ years of experience in Laravel, React, ASP.NET Core, and modern web development.',
                'meta_keywords' => 'About Sumit Kumar, sumitkdev, MCA, Software Engineer, Developer Skills, Web IT Squad',
                'og_title' => 'About Sumit Kumar (sumitkdev)',
                'og_description' => 'My journey from learning to code to becoming a professional Full Stack Developer.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'portfolio',
                'page_name' => 'Portfolio',
                'meta_title' => 'Portfolio & Projects — Sumit Kumar (sumitkdev)',
                'meta_description' => 'Showcase of web development projects by Sumit Kumar (sumitkdev). Client work, open-source contributions, and technical case studies using Laravel, React, and ASP.NET Core.',
                'meta_keywords' => 'Sumit Kumar Portfolio, sumitkdev Projects, Web Development, Laravel Projects, Open Source',
                'og_title' => 'Portfolio — Sumit Kumar (sumitkdev)',
                'og_description' => 'View my latest work and technical case studies.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'blog',
                'page_name' => 'Blog / Insights',
                'meta_title' => 'Developer Blog & Tutorials — Sumit Kumar (sumitkdev)',
                'meta_description' => '500+ tutorials, tips, and insights on PHP, Laravel, JavaScript, React, and software engineering by Sumit Kumar (sumitkdev). Learn modern web development.',
                'meta_keywords' => 'sumitkdev Blog, Sumit Kumar Tutorials, Laravel Tips, React Developer Blog, Web Development Articles',
                'og_title' => 'Developer Blog — Sumit Kumar (sumitkdev)',
                'og_description' => 'In-depth articles and tutorials for modern web developers.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'contact',
                'page_name' => 'Contact',
                'meta_title' => 'Contact Sumit Kumar (sumitkdev) — Let\'s Work Together',
                'meta_description' => 'Get in touch with Sumit Kumar (sumitkdev) for freelance web development, full-time opportunities, or project consultation. Based in Greater Noida, India.',
                'meta_keywords' => 'Contact Sumit Kumar, Hire sumitkdev, Freelance Laravel Developer, Web Developer India',
                'og_title' => 'Contact Sumit Kumar (sumitkdev)',
                'og_description' => 'Available for freelance and full-time opportunities. Let\'s build something great.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'open-source',
                'page_name' => 'Open Source',
                'meta_title' => 'Open Source Contributions — Sumit Kumar (sumitkdev)',
                'meta_description' => 'Explore open-source packages, GitHub repositories, and community contributions by Sumit Kumar (sumitkdev) in the Laravel and PHP ecosystem.',
                'meta_keywords' => 'Open Source Projects, GitHub sumitkdev, sumitkdevcode, Laravel Packages, Free Code',
                'og_title' => 'Open Source — Sumit Kumar (sumitkdev)',
                'og_description' => 'Giving back to the community through open-source software.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'links',
                'page_name' => 'All Links',
                'meta_title' => 'Sumit Kumar (sumitkdev) — All Links & Socials',
                'meta_description' => 'Find all of Sumit Kumar\'s (sumitkdev) social media profiles, recent articles, and important resources in one place.',
                'meta_keywords' => 'sumitkdev Links, Sumit Kumar Socials, Link in Bio, sumitkdev.in',
                'og_title' => 'Sumit Kumar (sumitkdev) — All Links',
                'og_description' => 'Connect with me across the web.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'gallery',
                'page_name' => 'Gallery',
                'meta_title' => 'Gallery & Setup — Sumit Kumar (sumitkdev)',
                'meta_description' => 'A visual tour of Sumit Kumar\'s (sumitkdev) workspace, developer setup, and behind-the-scenes moments.',
                'meta_keywords' => 'Developer Workspace, Coding Setup, sumitkdev Gallery, Sumit Kumar Photos',
                'og_title' => 'Workspace & Gallery — sumitkdev',
                'og_description' => 'Behind the scenes of my coding journey.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'feed',
                'page_name' => 'Social Feed',
                'meta_title' => 'Social Feed & YouTube — Sumit Kumar (sumitkdev)',
                'meta_description' => 'Catch up on Sumit Kumar\'s (sumitkdev) latest YouTube tutorials, Instagram moments, and professional posts. All social updates in one place.',
                'meta_keywords' => 'sumitkdev Feed, Sumit Kumar YouTube, Instagram Posts, Social Media Updates',
                'og_title' => 'Social Feed — Sumit Kumar (sumitkdev)',
                'og_description' => 'My latest content from YouTube, Instagram, X, and LinkedIn.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ]
        ];

        foreach ($pages as $pageData) {
            PageSeo::updateOrCreate(
                ['page_path' => $pageData['page_path']],
                $pageData
            );
        }
    }
}
