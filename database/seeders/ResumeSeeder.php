<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResumeExperience;
use App\Models\ResumeProject;
use App\Models\ResumeSkill;
use App\Models\ResumeCertificate;
use App\Models\ResumeTraining;
use App\Models\ResumeStrength;
use App\Models\Setting;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Resume Settings ───────────────────────────────────
        Setting::set('resume_summary', "Software Engineer with hands-on experience in designing, developing, and deploying scalable web applications using ASP.NET Core, Angular, Next.js, Laravel, React, and SQL. Experienced in building REST APIs, responsive user interfaces, authentication systems, and full-stack enterprise applications following Clean Architecture and Vertical Slice Architecture. Developed ScriptNex, an open-source learning platform, and contributed to government and university web projects. Passionate about solving complex problems, writing clean code, and building high-performance software.", 'text', 'resume');

        Setting::set('resume_title', 'Software Engineer', 'text', 'resume');

        Setting::set('education', json_encode([
            ['degree' => 'Master of Computer Applications (MCA)', 'institution' => 'GAUTAM BUDDHA UNIVERSITY, GREATER NOIDA, UTTAR PRADESH', 'year' => '2023-2025'],
            ['degree' => 'Bachelor of Computer Applications (BCA)', 'institution' => 'GALGOTIAS UNIVERSITY, GREATER NOIDA, UTTAR PRADESH', 'year' => '2020-2023'],
        ]), 'json', 'resume');

        // Clear existing records before seeding to avoid duplicates during multiple seeds
        ResumeExperience::truncate();
        ResumeSkill::truncate();
        ResumeProject::truncate();
        ResumeCertificate::truncate();
        ResumeTraining::truncate();
        ResumeStrength::truncate();

        // ─── Experiences ───────────────────────────────────────
        ResumeExperience::create([
            'title' => 'Software Engineer',
            'company' => 'WEB IT SQUAD - IT SERVICES COMPANY',
            'start_date' => 'FEBRUARY 2025',
            'end_date' => 'PRESENT',
            'bullets' => [
                'Developed and maintained 5+ production-ready web applications using ASP.NET Core, Angular, JavaScript, SQL, and PHP.',
                'Designed and implemented RESTful APIs following Clean Architecture and Vertical Slice Architecture.',
                'Reduced API response time by 30% through database query optimization.',
                'Built secure authentication and role-based authorization using JWT and ASP.NET Identity.',
                'Collaborated with cross-functional teams to deliver client projects on schedule.',
                'Fixed production issues and improved application performance and scalability.',
            ],
            'order' => 1,
            'is_visible' => true,
        ]);

        ResumeExperience::create([
            'title' => 'Web Developer Intern',
            'company' => 'GAUTAM BUDDHA UNIVERSITY (USOICT WEBSITE)',
            'start_date' => 'DECEMBER 2023',
            'end_date' => 'FEBRUARY 2025',
            'bullets' => [
                'Redesigned and developed key sections of the university\'s USoICT website, enhancing user experience and information accessibility for students and faculty.',
                'Implemented responsive design features and interactive elements using HTML, CSS, and JavaScript.',
                'Collaborated with university staff to gather requirements and ensure the website met institutional standards.',
                'Optimized web performance and loading speeds through code refactoring and image compression techniques.',
            ],
            'order' => 2,
            'is_visible' => true,
        ]);

        ResumeExperience::create([
            'title' => 'Web Developer Intern',
            'company' => 'TULIP, MINISTRY OF HOUSING AND URBAN AFFAIRS, GOVERNMENT OF INDIA',
            'start_date' => 'MAY 2023',
            'end_date' => 'JULY 2023',
            'bullets' => [
                'Contributed to the redesign of the DAY-NULM 2.0 (Deendayal Antyodaya Yojana-National Urban Livelihoods Mission) portal.',
                'Developed and implemented new UI components using HTML, CSS, JavaScript, and React.js.',
                'Assisted in analyzing user feedback to identify areas for website improvement.',
                'Worked closely with senior developers and mentors to understand real-world web development workflows in a government project environment.',
            ],
            'order' => 3,
            'is_visible' => true,
        ]);

        // ─── Skills ────────────────────────────────────────────
        ResumeSkill::create([
            'category' => 'Languages',
            'skills' => ['C#', 'PHP', 'JavaScript', 'SQL'],
            'order' => 1,
        ]);

        ResumeSkill::create([
            'category' => 'Frontend',
            'skills' => ['HTML5', 'CSS3', 'React', 'Angular', 'Next.js', 'Flutter', 'React Native'],
            'order' => 2,
        ]);

        ResumeSkill::create([
            'category' => 'Backend',
            'skills' => ['ASP.NET Core (REST API)', 'Laravel (REST API)', 'Express.js', 'Django'],
            'order' => 3,
        ]);

        ResumeSkill::create([
            'category' => 'Problem Solving',
            'skills' => ['Data Structures', 'Algorithms', 'OOP', 'Time & Space Complexity'],
            'order' => 4,
        ]);

        ResumeSkill::create([
            'category' => 'Tools & Technologies',
            'skills' => ['Git', 'REST APIs', 'Postman', 'Antigravity', 'Cursor'],
            'order' => 5,
        ]);
        
        ResumeSkill::create([
            'category' => 'Cloud & DevOps',
            'skills' => ['Docker', 'GitHub Actions', 'Azure (Basics)', 'AWS (Basics)', 'Linux', 'Nginx', 'IIS', 'CI/CD'],
            'order' => 6,
        ]);

        ResumeSkill::create([
            'category' => 'Architecture',
            'skills' => ['REST API', 'Clean Architecture', 'Vertical Slice Architecture', 'MVC'],
            'order' => 7,
        ]);

        // ─── Projects ─────────────────────────────────────────
        ResumeProject::create([
            'title' => 'ScriptNex – Open Source Coding Platform',
            'subtitle' => 'www.scriptnex.com',
            'technologies' => 'NEXT.JS, LARAVEL, MYSQL, REST API, TAILWIND CSS, GIT/GITHUB',
            'bullets' => [
                'Built a full-stack open-source coding platform from scratch.',
                'Developed secure authentication and role-based access.',
                'Designed REST APIs for tutorials, coding challenges, certifications, and blogs.',
                'Improved SEO using dynamic metadata and sitemap generation.',
                'Optimized application performance using lazy loading and image optimization.',
                'Maintained the platform using Git/GitHub and followed clean coding practices.',
            ],
            'order' => 1,
            'is_visible' => true,
        ]);

        ResumeProject::create([
            'title' => 'GBU Placement Portal',
            'subtitle' => 'MCA - Major Project',
            'technologies' => 'HTML, CSS, JAVASCRIPT, PHP, MYSQL',
            'bullets' => [
                'Developed a comprehensive placement portal for Gautam Buddha University to streamline the campus recruitment process for students and companies.',
                'Led the backend development, designing the database schema in MySQL and implementing core functionalities using PHP.',
            ],
            'order' => 2,
            'is_visible' => true,
        ]);

        ResumeProject::create([
            'title' => 'Decentralized File Storage System',
            'subtitle' => 'BCA - Major Project',
            'technologies' => 'REACT, SOLIDITY, BLOCKCHAIN',
            'bullets' => [
                'Designed and developed a proof-of-concept decentralized file storage application.',
                'Built the frontend interface using React, allowing users to upload and manage files.',
            ],
            'order' => 3,
            'is_visible' => true,
        ]);

        // ─── Certificates ──────────────────────────────────────
        ResumeCertificate::create([
            'title' => 'React Basic',
            'issuer' => 'Hackerrank',
            'order' => 1,
        ]);

        ResumeCertificate::create([
            'title' => 'Web Development',
            'issuer' => 'Techgyan, IIT Bombay',
            'order' => 2,
        ]);

        // ─── Trainings ────────────────────────────────────────
        ResumeTraining::create([
            'title' => 'Backend Development & Soft Skills',
            'organization' => 'AMERICAN INDIAN FOUNDATION (BLACKROCK)',
            'date_range' => 'MARCH 2023 – JULY 2023',
            'order' => 1,
        ]);

        // ─── Strengths ────────────────────────────────────────
        $strengths = [
            'Effective Communication',
            'Leadership & Teamwork',
            'Creativity & Problem-Solving',
            'Time Management',
            'Adaptability & Quick Learner',
        ];

        foreach ($strengths as $i => $strength) {
            ResumeStrength::create([
                'title' => $strength,
                'order' => $i + 1,
            ]);
        }
    }
}
