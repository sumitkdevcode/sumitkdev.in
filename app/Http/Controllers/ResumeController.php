<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\ResumeExperience;
use App\Models\ResumeProject;
use App\Models\ResumeSkill;
use App\Models\ResumeCertificate;
use App\Models\ResumeTraining;
use App\Models\ResumeStrength;
use App\Models\Setting;

class ResumeController extends Controller
{
    public function show()
    {
        $experiences = Cache::remember('resume_experiences', 3600, function () {
            return ResumeExperience::visible()->ordered()->get();
        });

        $projects = Cache::remember('resume_projects', 3600, function () {
            return ResumeProject::visible()->ordered()->get();
        });

        $skills = Cache::remember('resume_skills', 3600, function () {
            return ResumeSkill::visible()->ordered()->get();
        });

        $certificates = Cache::remember('resume_certificates', 3600, function () {
            return ResumeCertificate::visible()->ordered()->get();
        });

        $trainings = Cache::remember('resume_trainings', 3600, function () {
            return ResumeTraining::visible()->ordered()->get();
        });

        $strengths = Cache::remember('resume_strengths', 3600, function () {
            return ResumeStrength::visible()->ordered()->get();
        });

        $resumeSummary = Setting::get('resume_summary', '');
        $resumeTitle = Setting::get('resume_title', 'Software Engineer');

        $settings = [
            'site_name' => Setting::get('site_name', 'SUMIT KUMAR'),
            'location' => Setting::get('location', 'Greater Noida, Uttar Pradesh, India'),
            'phone' => Setting::get('phone', '+91 8303744132'),
            'email' => Setting::get('email', 'kumar.sumit321321@gmail.com'),
            'linkedin' => Setting::get('linkedin', 'https://linkedin.com/in/sumitkdev'),
            'github' => Setting::get('github', 'https://github.com/sumitkdevcode'),
            'portfolio_url' => Setting::get('portfolio_url', 'https://sumitkdev.in'),
            'education' => Setting::get('education', json_encode([
                ['degree' => 'Master of Computer Applications (MCA)', 'institution' => 'Gautam Buddha University, Greater Noida, Uttar Pradesh', 'year' => '2023-2025'],
                ['degree' => 'Bachelor of Computer Applications (BCA)', 'institution' => 'Galgotias University, Greater Noida, Uttar Pradesh', 'year' => '2020-2023'],
            ])),
        ];

        return view('resume', compact(
            'experiences', 'projects', 'skills', 'certificates',
            'trainings', 'strengths', 'resumeSummary', 'resumeTitle', 'settings'
        ));
    }
}
