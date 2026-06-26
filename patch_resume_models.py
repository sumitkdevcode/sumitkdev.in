import os

models = {
    'ResumeExperience': 'resume_experiences',
    'ResumeProject': 'resume_projects',
    'ResumeSkill': 'resume_skills',
    'ResumeCertificate': 'resume_certificates',
    'ResumeTraining': 'resume_trainings',
    'ResumeStrength': 'resume_strengths'
}

for model, cache_key in models.items():
    filepath = f"app/Models/{model}.php"
    if not os.path.exists(filepath):
        continue
        
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
        
    if 'protected static function boot()' not in content:
        # insert it before the last }
        boot_method = f"""
    protected static function boot()
    {{
        parent::boot();

        static::saved(function ($model) {{
            \\Illuminate\\Support\\Facades\\Cache::forget('{cache_key}');
        }});

        static::deleted(function ($model) {{
            \\Illuminate\\Support\\Facades\\Cache::forget('{cache_key}');
        }});
    }}
}}"""
        # Find the last closing brace and replace it
        content = content.rsplit('}', 1)[0] + boot_method
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
            
print("Successfully patched all Resume models to clear cache on save/delete.")
