import sys

with open('resources/views/links.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

start_idx = content.find('            <!-- Social Media -->')
end_idx = content.find('            <!-- CTA -->')

if start_idx != -1 and end_idx != -1:
    new_content = """            @php
                $sections = [
                    'social_media' => ['title' => 'Social Media', 'delay' => '0'],
                    'developer_profiles' => ['title' => 'Developer Profiles', 'delay' => '100'],
                    'competitive_coding' => ['title' => 'Competitive Coding', 'delay' => '200'],
                    'freelance_platforms' => ['title' => 'Freelance Platforms', 'delay' => '300'],
                    'website_blog' => ['title' => 'Website & Blog', 'delay' => '400'],
                ];
            @endphp

            @foreach ($sections as $catKey => $section)
                @if(isset($globalSocialLinks[$catKey]) && $globalSocialLinks[$catKey]->count() > 0)
                    <div class="mb-20" data-aos="fade-up" data-aos-delay="{{ $section['delay'] }}">
                        <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">{{ $section['title'] }}</h2>
                        <div class="grid sm:grid-cols-2 {{ $catKey == 'freelance_platforms' ? 'lg:grid-cols-3' : '' }} gap-4">
                            @foreach ($globalSocialLinks[$catKey] as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener me"
                                    class="group flex items-center gap-5 p-6 transition-all duration-300 {{ $catKey == 'website_blog' ? 'bg-black text-white hover:bg-gray-900' : 'border border-black/10 hover:border-black hover:bg-black hover:text-white' }}">
                                    <div class="w-12 h-12 flex items-center justify-center border {{ $catKey == 'website_blog' ? 'border-white/20' : 'border-current/20 group-hover:border-white/30 transition-colors' }} rounded-full">
                                        {!! str_replace('<svg ', '<svg class="w-5 h-5" ', $link->icon_svg) !!}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold uppercase tracking-widest">{{ $link->platform_name }}</p>
                                        @if($link->handle)
                                            <p class="text-xs {{ $catKey == 'website_blog' ? 'text-gray-400' : 'text-gray-400 group-hover:text-gray-300 transition-colors' }}">{{ $link->handle }}</p>
                                        @endif
                                    </div>
                                    <svg class="w-5 h-5 opacity-{{ $catKey == 'website_blog' ? '50' : '0' }} group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

"""
    updated = content[:start_idx] + new_content + content[end_idx:]
    with open('resources/views/links.blade.php', 'w', encoding='utf-8') as f:
        f.write(updated)
    print('Updated successfully')
else:
    print('Could not find markers')
