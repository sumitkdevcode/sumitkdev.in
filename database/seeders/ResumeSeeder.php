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
        Setting::set('resume_summary', "Results-oriented Software Engineer with a Master's in Computer Applications and hands-on experience in designing, developing, and deploying web applications. Proven ability to contribute to all phases of the development lifecycle, from concept to deployment. Eager to leverage strong technical skills and project experience in a challenging role with opportunities for growth and learning within an experienced team.", 'text', 'resume');

        Setting::set('resume_title', 'Software Engineer', 'text', 'resume');

        // ─── Experiences ───────────────────────────────────────
        ResumeExperience::create([
            'title' => 'Software Engineer',
            'company' => 'Web IT Squad - IT Services Company',
            'start_date' => 'February 2025',
            'end_date' => 'Present',
            'bullets' => [
                'Developed and maintained responsive, user-friendly client websites and web applications using .NET, Angular, C#, SQL, HTML, CSS, JavaScript, and PHP.',
                'Built scalable backend services and REST APIs with ASP.NET Core, following Clean Architecture and Vertical Slice Architecture to keep features modular and maintainable.',
                'Implemented secure authentication systems and role-based access controls in admin dashboards.',
            ],
            'order' => 1,
            'is_visible' => true,
        ]);

        ResumeExperience::create([
            'title' => 'Web Developer Intern',
            'company' => 'Gautam Buddha University (USoICT Website)',
            'start_date' => 'December 2023',
            'end_date' => 'February 2025',
            'bullets' => [
                'Redesigned and developed key sections of the university\'s USoICT website, enhancing user experience and information accessibility for students and faculty.',
                'Implemented responsive design features and interactive elements using HTML, CSS, and JavaScript.',
                'Collaborated with university staff to gather requirements and ensure the website met institutional standards.',
                'Optimized web performance and loading speeds through code refactoring and image compression techniques.',
                'Ensured accessibility compliance by adhering to WCAG guidelines.',
            ],
            'order' => 2,
            'is_visible' => true,
        ]);

        ResumeExperience::create([
            'title' => 'Web Developer Intern',
            'company' => 'TULIP, Ministry of Housing and Urban Affairs, Government of India',
            'start_date' => 'May 2023',
            'end_date' => 'July 2023',
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
            'category' => 'Databases',
            'skills' => ['Microsoft SQL Server', 'MySQL', 'PostgreSQL'],
            'order' => 4,
        ]);

        ResumeSkill::create([
            'category' => 'Tools & Technologies',
            'skills' => ['Git', 'REST APIs', 'Postman', 'Antigravity', 'Cursor'],
            'order' => 5,
        ]);

        // ─── Projects ─────────────────────────────────────────
        ResumeProject::create([
            'title' => 'GBU Placement Portal',
            'subtitle' => 'MCA - Major Project',
            'technologies' => 'HTML, CSS, JavaScript, PHP, MySQL',
            'bullets' => [
                'Developed a comprehensive placement portal for Gautam Buddha University to streamline the campus recruitment process for students and companies.',
                'Led the backend development, designing the database schema in MySQL and implementing core functionalities using PHP.',
                'Implemented an automated email notification system to send alerts for new job postings, application statuses, and interview schedules directly from the portal\'s forms.',
                'Designed and implemented a user-friendly interface for students to create profiles, apply for jobs, and for administrators to manage listings.',
            ],
            'order' => 1,
            'is_visible' => true,
        ]);

        ResumeProject::create([
            'title' => 'Decentralized File Storage System',
            'subtitle' => 'BCA - Major Project',
            'technologies' => 'React, Solidity, Blockchain',
            'bullets' => [
                'Designed and developed a proof-of-concept decentralized file storage application.',
                'Built the frontend interface using React, allowing users to upload and manage files.',
            ],
            'order' => 2,
            'is_visible' => true,
        ]);

        ResumeProject::create([
            'title' => 'ScriptNex',
            'subtitle' => null,
            'technologies' => 'HTML, CSS, JavaScript, PHP, MySQL',
            'bullets' => [
                'Developed a web-based hospital management system to manage patient records, appointments, and doctor information.',
                'Focused on creating an intuitive UI for ease of use by hospital staff.',
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
            'organization' => 'American Indian Foundation (BlackRock)',
            'date_range' => 'March 2023 – July 2023',
            'order' => 1,
        ]);

        ResumeTraining::create([
            'title' => 'Backend Development & Soft Skills',
            'organization' => 'Anudip Foundation',
            'date_range' => 'May 2025 – July 2025',
            'order' => 2,
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
