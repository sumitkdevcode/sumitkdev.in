<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResumeExperience;
use App\Models\ResumeProject;
use App\Models\ResumeSkill;
use App\Models\ResumeCertificate;
use App\Models\ResumeTraining;
use App\Models\ResumeStrength;
use App\Models\Setting;

class ResumeController extends Controller
{
    /**
     * Show the resume management page with all sections.
     */
    public function index()
    {
        $experiences = ResumeExperience::ordered()->get();
        $projects = ResumeProject::ordered()->get();
        $skills = ResumeSkill::ordered()->get();
        $certificates = ResumeCertificate::ordered()->get();
        $trainings = ResumeTraining::ordered()->get();
        $strengths = ResumeStrength::ordered()->get();

        $resumeSummary = Setting::get('resume_summary', '');
        $resumeTitle = Setting::get('resume_title', 'Software Engineer');

        return view('admin.resume.index', compact(
            'experiences', 'projects', 'skills', 'certificates',
            'trainings', 'strengths', 'resumeSummary', 'resumeTitle'
        ));
    }

    /**
     * Update resume header settings (summary, title).
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'resume_summary' => 'required|string',
            'resume_title' => 'required|string|max:255',
        ]);

        Setting::set('resume_summary', $request->resume_summary, 'text', 'resume');
        Setting::set('resume_title', $request->resume_title, 'text', 'resume');

        return redirect()->back()->with('success', 'Resume settings updated successfully.');
    }

    // ─── Experience CRUD ───────────────────────────────────────

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:100',
            'end_date' => 'nullable|string|max:100',
            'bullets' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['bullets'] = $this->parseBullets($request->bullets);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeExperience::create($validated);

        return redirect()->back()->with('success', 'Experience added successfully.');
    }

    public function updateExperience(Request $request, $id)
    {
        $experience = ResumeExperience::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:100',
            'end_date' => 'nullable|string|max:100',
            'bullets' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['bullets'] = $this->parseBullets($request->bullets);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $experience->update($validated);

        return redirect()->back()->with('success', 'Experience updated successfully.');
    }

    public function destroyExperience($id)
    {
        ResumeExperience::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Experience deleted successfully.');
    }

    // ─── Project CRUD ──────────────────────────────────────────

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'technologies' => 'nullable|string|max:500',
            'bullets' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['bullets'] = $this->parseBullets($request->bullets);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeProject::create($validated);

        return redirect()->back()->with('success', 'Project added successfully.');
    }

    public function updateProject(Request $request, $id)
    {
        $project = ResumeProject::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'technologies' => 'nullable|string|max:500',
            'bullets' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['bullets'] = $this->parseBullets($request->bullets);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $project->update($validated);

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    public function destroyProject($id)
    {
        ResumeProject::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }

    // ─── Skill CRUD ────────────────────────────────────────────

    public function storeSkill(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'skills' => 'required|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['skills'] = $this->parseCommaSeparated($request->skills);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeSkill::create($validated);

        return redirect()->back()->with('success', 'Skill category added successfully.');
    }

    public function updateSkill(Request $request, $id)
    {
        $skill = ResumeSkill::findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'skills' => 'required|string',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['skills'] = $this->parseCommaSeparated($request->skills);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $skill->update($validated);

        return redirect()->back()->with('success', 'Skill category updated successfully.');
    }

    public function destroySkill($id)
    {
        ResumeSkill::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Skill category deleted successfully.');
    }

    // ─── Certificate CRUD ──────────────────────────────────────

    public function storeCertificate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeCertificate::create($validated);

        return redirect()->back()->with('success', 'Certificate added successfully.');
    }

    public function updateCertificate(Request $request, $id)
    {
        $certificate = ResumeCertificate::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $certificate->update($validated);

        return redirect()->back()->with('success', 'Certificate updated successfully.');
    }

    public function destroyCertificate($id)
    {
        ResumeCertificate::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Certificate deleted successfully.');
    }

    // ─── Training CRUD ─────────────────────────────────────────

    public function storeTraining(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'date_range' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeTraining::create($validated);

        return redirect()->back()->with('success', 'Training added successfully.');
    }

    public function updateTraining(Request $request, $id)
    {
        $training = ResumeTraining::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'date_range' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $training->update($validated);

        return redirect()->back()->with('success', 'Training updated successfully.');
    }

    public function destroyTraining($id)
    {
        ResumeTraining::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Training deleted successfully.');
    }

    // ─── Strength CRUD ─────────────────────────────────────────

    public function storeStrength(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        ResumeStrength::create($validated);

        return redirect()->back()->with('success', 'Strength added successfully.');
    }

    public function updateStrength(Request $request, $id)
    {
        $strength = ResumeStrength::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_visible' => 'nullable',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['order'] = $request->order ?? 0;

        $strength->update($validated);

        return redirect()->back()->with('success', 'Strength updated successfully.');
    }

    public function destroyStrength($id)
    {
        ResumeStrength::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Strength deleted successfully.');
    }

    // ─── Helpers ────────────────────────────────────────────────

    /**
     * Parse newline-separated text into a clean array of bullet points.
     */
    private function parseBullets(?string $text): array
    {
        if (empty($text)) return [];

        return array_values(array_filter(
            array_map('trim', explode("\n", $text)),
            fn($line) => !empty($line)
        ));
    }

    /**
     * Parse comma-separated text into a clean array.
     */
    private function parseCommaSeparated(?string $text): array
    {
        if (empty($text)) return [];

        return array_values(array_filter(
            array_map('trim', explode(',', $text)),
            fn($item) => !empty($item)
        ));
    }
}
