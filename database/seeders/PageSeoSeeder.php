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
                'meta_title' => 'Sumit Kumar — Full Stack Developer & Software Engineer',
                'meta_description' => 'Official website of Sumit Kumar (sumitkdev), a Full Stack Developer specializing in Laravel, React, Vue.js, and modern web architectures.',
                'meta_keywords' => 'Sumit Kumar, sumitkdev, Full Stack Developer, Laravel Expert, React Developer, Web Development',
                'og_title' => 'Sumit Kumar — Full Stack Developer',
                'og_description' => 'Explore my portfolio, read technical tutorials, and hire me for your next project.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'about',
                'page_name' => 'About Me',
                'meta_title' => 'About Sumit Kumar — My Journey & Skills',
                'meta_description' => 'Learn more about Sumit Kumar, my educational background (MCA), technical skills, and professional journey in software engineering.',
                'meta_keywords' => 'About Sumit Kumar, MCA, Software Engineer Journey, Developer Skills',
                'og_title' => 'About Sumit Kumar',
                'og_description' => 'My journey from learning to code to becoming a professional Full Stack Developer.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'portfolio',
                'page_name' => 'Portfolio',
                'meta_title' => 'Portfolio & Projects — Sumit Kumar',
                'meta_description' => 'A showcase of my recent web development projects, open-source contributions, and client work using Laravel and React.',
                'meta_keywords' => 'Sumit Kumar Portfolio, Web Development Projects, Laravel Projects, Open Source',
                'og_title' => 'Sumit Kumar Projects',
                'og_description' => 'View my latest work and technical case studies.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'blog',
                'page_name' => 'Blog / Insights',
                'meta_title' => 'Developer Blog & Tutorials — Sumit Kumar',
                'meta_description' => 'Read tutorials, tips, and insights on PHP, Laravel, JavaScript, React, and general software engineering by Sumit Kumar.',
                'meta_keywords' => 'Laravel Tutorials, React Tips, Software Engineering Blog, Web Development Articles',
                'og_title' => 'Developer Blog by Sumit Kumar',
                'og_description' => 'In-depth articles and tutorials for modern web developers.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'contact',
                'page_name' => 'Contact',
                'meta_title' => 'Contact Sumit Kumar — Let\'s Work Together',
                'meta_description' => 'Get in touch with Sumit Kumar for freelance web development projects, full-time opportunities, or general inquiries.',
                'meta_keywords' => 'Contact Sumit Kumar, Hire Web Developer, Freelance Laravel Developer',
                'og_title' => 'Contact Sumit Kumar',
                'og_description' => 'Available for freelance and full-time opportunities. Let\'s build something great.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'open-source',
                'page_name' => 'Open Source',
                'meta_title' => 'Open Source Contributions — Sumit Kumar',
                'meta_description' => 'Explore my open-source packages, GitHub repositories, and community contributions in the Laravel and PHP ecosystem.',
                'meta_keywords' => 'Open Source Projects, GitHub Sumitkdev, Laravel Packages, Free Code',
                'og_title' => 'Open Source by Sumit Kumar',
                'og_description' => 'Giving back to the community through open-source software.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'links',
                'page_name' => 'All Links',
                'meta_title' => 'Sumit Kumar Links — Socials & Resources',
                'meta_description' => 'A centralized hub for all of Sumit Kumar\'s social media profiles, recent articles, and important resources.',
                'meta_keywords' => 'Sumitkdev Links, Social Media Profiles, Link in Bio',
                'og_title' => 'Sumit Kumar - All Links',
                'og_description' => 'Connect with me across the web.',
                'twitter_card' => 'summary',
                'twitter_handle' => '@sumitkdevs',
            ],
            [
                'page_path' => 'gallery',
                'page_name' => 'Gallery',
                'meta_title' => 'Gallery & Setup — Sumit Kumar',
                'meta_description' => 'A visual tour of my workspace, developer setup, and behind-the-scenes moments.',
                'meta_keywords' => 'Developer Workspace, Coding Setup, Sumit Kumar Gallery',
                'og_title' => 'Workspace & Gallery',
                'og_description' => 'Behind the scenes of my coding journey.',
                'twitter_card' => 'summary_large_image',
                'twitter_handle' => '@sumitkdevs',
            ]
        ];

        foreach ($pages as $pageData) {
            PageSeo::firstOrCreate(
                ['page_path' => $pageData['page_path']],
                $pageData
            );
        }
    }
}
