@extends('layouts.app')

@section('canonical_url', route('resume'))

@section('meta_title', 'Resume — Sumit Kumar | Software Engineer')
@section('meta_description', 'Professional resume of Sumit Kumar — Software Engineer with expertise in .NET, Laravel, React, Angular, and modern web technologies.')

@section('meta')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfilePage",
        "mainEntity": {
            "@id": "{{ url('/') }}/#person"
        },
        "name": "Resume — Sumit Kumar",
        "description": "Professional resume of Sumit Kumar — Software Engineer",
        "url": "{{ route('resume') }}",
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Resume",
                    "item": "{{ route('resume') }}"
                }
            ]
        }
    }
    </script>

    {{-- html2canvas + jsPDF for PDF download --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        /* Resume-specific styles */
        .resume-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.06);
        }

        .resume-section-title {
            font-size: 0.9rem;
            font-weight: 900;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: #000;
            border-bottom: 2px solid #000;
            padding-bottom: 0.4rem;
            margin-bottom: 0.8rem;
            margin-top: 1.2rem;
        }

        .resume-entry {
            padding-left: 1rem;
            border-left: 3px solid #000;
            margin-bottom: 0.6rem;
            transition: background-color 0.2s ease;
        }

        .resume-entry:hover {
            background-color: #fafafa;
        }

        .resume-entry-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #000;
            letter-spacing: -0.02em;
        }

        .resume-entry-meta {
            font-size: 0.82rem;
            color: #111827;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 0.1rem;
        }

        .resume-bullet-list {
            list-style-type: disc;
            margin-left: 1.2rem;
            margin-top: 0.3rem;
        }

        .resume-bullet-list li {
            font-size: 0.93rem;
            color: #111827;
            margin-bottom: 0.15rem;
            line-height: 1.5;
        }

        .resume-skills-grid {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .resume-skills-grid > div {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }

        .resume-skill-category {
            font-size: 0.78rem;
            font-weight: 600;
            color: #000;
            white-space: nowrap;
            min-width: 140px;
        }

        .resume-skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .resume-skill-tag {
            display: inline-block;
            background-color: #f3f4f6;
            color: #1f2937;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            border: 1px solid #e5e7eb;
            text-align: center;
            line-height: 14px;
            white-space: nowrap;
            box-sizing: border-box;
        }

        .resume-header-name {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: -0.06em;
            text-transform: uppercase;
            line-height: 1;
        }

        .resume-header-title {
            font-size: 0.85rem;
            color: #111827;
            font-weight: 500;
            margin-top: 0.3rem;
        }

        .resume-contact {
            font-size: 0.82rem;
            color: #111827;
            margin-top: 0.8rem;
        }

        .resume-contact a {
            color: #111827;
            text-decoration: none;
            font-weight: 500;
        }

        .resume-contact a:hover {
            text-decoration: underline;
        }

        .resume-summary-text {
            font-size: 0.93rem;
            color: #111827;
            line-height: 1.7;
        }

        /* PDF download button */
        .pdf-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #000;
            color: #fff;
            padding: 0.8rem 2rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pdf-download-btn:hover {
            background: #1f2937;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .pdf-download-btn:active {
            transform: scale(0.98);
        }

        /* Loading overlay */
        .resume-loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column;
            gap: 1rem;
            backdrop-filter: blur(4px);
        }

        .resume-loading-spinner {
            border: 3px solid #e5e7eb;
            border-top: 3px solid #000;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            animation: resumeSpin 0.8s linear infinite;
        }

        @keyframes resumeSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .resume-loading-text {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: #000;
        }

        /* Print styles */
        @media print {
            .resume-actions, .pdf-download-btn {
                display: none !important;
            }
            .resume-container {
                box-shadow: none;
                border: none;
                border-radius: 0;
            }
        }
    </style>
@endsection

@section('content')
    <section class="pt-12 pb-20 bg-white border-b border-black/5 min-h-screen">
        {{-- Background decoration --}}
        <div class="fixed inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-[0.03] z-0">
            <div class="whitespace-nowrap text-9xl font-bold uppercase tracking-tighter" style="animation: float 15s ease-in-out infinite;">
                RESUME &bull; CURRICULUM VITAE &bull; RESUME &bull; CURRICULUM VITAE &bull;
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            {{-- Page Header --}}
            <div class="mb-10" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4 font-bold">Resume</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-[-0.1em] uppercase leading-none mb-6">
                    My<br><span class="text-outline-premium opacity-100">Resume</span>
                </h1>
            </div>

            {{-- Download Button --}}
            <div class="mb-8 resume-actions" data-aos="fade-up">
                <button onclick="downloadResumePdf()" class="pdf-download-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download PDF
                </button>
            </div>

            {{-- Resume Content --}}
            <div class="resume-container p-8 md:p-12" id="resume-content" data-aos="fade-up">

                {{-- ─── Header ─── --}}
                <header class="text-center mb-8 pb-6 border-b border-gray-200">
                    <h2 class="resume-header-name">{{ $settings['site_name'] }}</h2>
                    <p class="resume-header-title">{{ $resumeTitle }}</p>
                    <div class="resume-contact mt-3">
                        <p>{{ $settings['location'] }} | {{ $settings['phone'] }} | <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></p>
                        <p class="mt-1">
                            <a href="{{ $settings['linkedin'] }}" target="_blank">{{ $settings['linkedin'] }}</a> |
                            <a href="{{ $settings['github'] }}" target="_blank">{{ $settings['github'] }}</a> |
                            <a href="{{ $settings['portfolio_url'] }}" target="_blank">{{ $settings['portfolio_url'] }}</a>
                        </p>
                    </div>
                </header>

                {{-- ─── Summary ─── --}}
                @if ($resumeSummary)
                    <section>
                        <h3 class="resume-section-title">Summary</h3>
                        <p class="resume-summary-text">{{ $resumeSummary }}</p>
                    </section>
                @endif

                {{-- ─── Education ─── --}}
                @php
                    $education = json_decode($settings['education'] ?? '[]', true);
                @endphp
                @if (!empty($education))
                    <section>
                        <h3 class="resume-section-title">Education</h3>
                        @foreach ($education as $edu)
                            <div class="resume-entry py-2">
                                <p class="resume-entry-title">{{ $edu['degree'] }}</p>
                                <p class="resume-entry-meta">{{ $edu['institution'] }} | {{ $edu['year'] }}</p>
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- ─── Work Experience ─── --}}
                @if ($experiences->count())
                    <section>
                        <h3 class="resume-section-title">Work Experience</h3>
                        @foreach ($experiences as $exp)
                            <div class="resume-entry py-3">
                                <p class="resume-entry-title">{{ $exp->title }}</p>
                                <p class="resume-entry-meta">{{ $exp->company }} | {{ $exp->start_date }} – {{ $exp->end_date ?? 'Present' }}</p>
                                @if ($exp->bullets && count($exp->bullets))
                                    <ul class="resume-bullet-list">
                                        @foreach ($exp->bullets as $bullet)
                                            <li>{{ $bullet }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- ─── Technical Skills ─── --}}
                @if ($skills->count())
                    <section>
                        <h3 class="resume-section-title">Technical Skills</h3>
                        <div class="resume-entry py-3">
                            <div class="resume-skills-grid">
                                @foreach ($skills as $skillCat)
                                    <div>
                                        <p class="resume-skill-category">{{ $skillCat->category }}:</p>
                                        <div class="resume-skill-tags">
                                            @foreach ($skillCat->skills as $tag)
                                                <div class="resume-skill-tag">{{ $tag }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                {{-- ─── Projects ─── --}}
                @if ($projects->count())
                    <section>
                        <h3 class="resume-section-title">Projects</h3>
                        @foreach ($projects as $project)
                            <div class="resume-entry py-3">
                                <p class="resume-entry-title">
                                    {{ $project->title }}
                                    @if ($project->subtitle)
                                        <span class="font-normal text-gray-800">({{ $project->subtitle }})</span>
                                    @endif
                                </p>
                                @if ($project->technologies)
                                    <p class="resume-entry-meta">Technologies: {{ $project->technologies }}</p>
                                @endif
                                @if ($project->bullets && count($project->bullets))
                                    <ul class="resume-bullet-list">
                                        @foreach ($project->bullets as $bullet)
                                            <li>{{ $bullet }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- ─── Certificates ─── --}}
                @if ($certificates->count())
                    <section>
                        <h3 class="resume-section-title">Certificates</h3>
                        <div class="resume-entry py-2">
                            <ul class="resume-bullet-list">
                                @foreach ($certificates as $cert)
                                    <li>{{ $cert->title }}@if ($cert->issuer) ({{ $cert->issuer }})@endif</li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif

                {{-- ─── Trainings ─── --}}
                @if ($trainings->count())
                    <section>
                        <h3 class="resume-section-title">Trainings</h3>
                        @foreach ($trainings as $training)
                            <div class="resume-entry py-2">
                                <p class="resume-entry-title">{{ $training->title }}</p>
                                <p class="resume-entry-meta">
                                    {{ $training->organization }}
                                    @if ($training->date_range) | {{ $training->date_range }} @endif
                                </p>
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- ─── Personal Strengths ─── --}}
                @if ($strengths->count())
                    <section>
                        <h3 class="resume-section-title">Personal Strengths</h3>
                        <div class="resume-entry py-2">
                            <ul class="resume-bullet-list">
                                @foreach ($strengths as $strength)
                                    <li>{{ $strength->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
            </div>

            {{-- Bottom Download Button --}}
            <div class="mt-8 text-center resume-actions" data-aos="fade-up">
                <button onclick="downloadResumePdf()" class="pdf-download-btn">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download PDF
                </button>
            </div>
        </div>

        {{-- Loading Overlay --}}
        <div id="resume-loading" class="resume-loading-overlay" style="display: none;">
            <div class="resume-loading-spinner"></div>
            <p class="resume-loading-text">Generating PDF...</p>
        </div>
    </section>

    {{-- PDF Download Script - placed inline because layout doesn't have @stack('scripts') --}}
    <script>
        async function downloadResumePdf() {
            var loadingEl = document.getElementById('resume-loading');
            loadingEl.style.display = 'flex';

            var element = document.getElementById('resume-content');
            var filename = '{{ str_replace(" ", "_", $settings["site_name"]) }}_Resume.pdf';

            try {
                if (typeof html2canvas === 'undefined') {
                    throw new Error('html2canvas library not loaded. Please refresh the page and try again.');
                }
                if (typeof window.jspdf === 'undefined') {
                    throw new Error('jsPDF library not loaded. Please refresh the page and try again.');
                }

                var desktopWidth = 900;

                // Use html2canvas onclone callback to modify the CLONE, not the real DOM.
                // This avoids all off-screen positioning issues.
                var canvas = await html2canvas(element, {
                    scale: 1.5,                       // reduced from 2 to shrink PDF size (< 500KB)
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff',
                    windowWidth: 1200,                // desktop viewport → disables mobile media queries
                    onclone: function(clonedDoc) {
                        var el = clonedDoc.getElementById('resume-content');

                        // Move element to the body root and position absolute to escape all parent 
                        // constraints (like max-w-7xl) and avoid any scroll offsets in capture
                        clonedDoc.body.appendChild(el);
                        el.style.position = 'absolute';
                        el.style.top = '0';
                        el.style.left = '0';

                        // Force desktop width
                        el.style.width = desktopWidth + 'px';
                        el.style.maxWidth = desktopWidth + 'px';
                        el.style.minWidth = desktopWidth + 'px';
                        el.style.padding = '3rem';
                        el.style.margin = '0';
                        el.style.boxSizing = 'border-box';

                        // Remove decorative styles for clean PDF output
                        el.style.border = 'none';
                        el.style.boxShadow = 'none';
                        el.style.borderRadius = '0';

                        // Boost base font size for larger text in PDF
                        el.style.fontSize = '105%';

                        // Kill AOS animations — these can push content down or hide it
                        el.style.transform = 'none';
                        el.style.opacity = '1';
                        el.style.transition = 'none';
                        el.removeAttribute('data-aos');

                        // Force desktop layout on skill grid items
                        var gridEl = el.querySelector('.resume-skills-grid');
                        if (gridEl) {
                            gridEl.style.flexDirection = 'column';
                            gridEl.style.gap = '0.5rem';
                        }
                        var items = el.querySelectorAll('.resume-skills-grid > div');
                        items.forEach(function(item) {
                            item.style.display = 'flex';
                            item.style.alignItems = 'baseline';
                            item.style.gap = '0.5rem';
                        });

                        // Reset AOS on ALL child elements inside the resume
                        var aosEls = el.querySelectorAll('[data-aos]');
                        aosEls.forEach(function(aosEl) {
                            aosEl.style.transform = 'none';
                            aosEl.style.opacity = '1';
                            aosEl.style.transition = 'none';
                        });
                    }
                });

                // --- Generate PDF with centered content ---
                var jsPDF = window.jspdf.jsPDF;
                var pdf = new jsPDF({ unit: 'mm', format: 'a4', orientation: 'p', compress: true });

                var pageWidth = 210;   // A4 width in mm
                var pageHeight = 297;  // A4 height in mm
                var margin = 10;       // left/right margin in mm
                var topMargin = 8;     // top margin on first page

                var contentWidth = pageWidth - (margin * 2);
                var imgData = canvas.toDataURL('image/jpeg', 0.65);  // reduced from 0.95 for smaller PDF
                var imgHeight = (canvas.height * contentWidth) / canvas.width;

                // First page — content starts below topMargin
                pdf.addImage(imgData, 'JPEG', margin, topMargin, contentWidth, imgHeight, undefined, 'FAST');
                var consumed = pageHeight - topMargin;  // how much of the image fits on page 1

                // Subsequent pages — content continues flush from top
                while (consumed < imgHeight) {
                    pdf.addPage();
                    pdf.addImage(imgData, 'JPEG', margin, -consumed, contentWidth, imgHeight, undefined, 'FAST');
                    consumed += pageHeight;
                }

                pdf.save(filename);
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert(error.message || 'There was an error generating the PDF. Please try again.');
            } finally {
                loadingEl.style.display = 'none';
            }
        }
    </script>
@endsection
