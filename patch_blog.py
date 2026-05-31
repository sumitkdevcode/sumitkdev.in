import sys

file_path = r'd:\Websites\work\repo\sumitkdev.in\resources\views\home.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

start_idx = -1
end_idx = -1

for i, line in enumerate(lines):
    if '<!-- Blog Journal -->' in line:
        start_idx = i
    if '<!-- FAQ Section -->' in line:
        end_idx = i
        break

if start_idx != -1 and end_idx != -1:
    new_blog_section = """    <!-- Blog Journal -->
    <section class="py-32 bg-white text-black overflow-hidden relative">
        <div class="max-w-[1400px] mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-right">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-500 mb-4">Latest Updates</p>
                    <h2 class="text-6xl font-bold tracking-tighter text-black">Recent Thoughts</h2>
                </div>
            </div>

            <div class="relative z-10 py-4 w-full">
                <div id="blog-scroll-container" class="flex gap-6 md:gap-8 w-full overflow-x-auto snap-x snap-mandatory pb-8 scroll-smooth items-start cursor-grab active:cursor-grabbing" style="scrollbar-width: thin;">
                    @forelse($allBlogs as $index => $blog)
                        <a href="{{ route('blog.show', $blog->slug) }}" class="group block w-64 md:w-80 shrink-0 snap-start {{ $index % 2 != 0 ? 'mt-12' : '' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                            <div class="bg-white rounded-2xl overflow-hidden mb-6 aspect-[4/3] relative neo-frame">
                                @if($blog->featured_image)
                                    <img src="{{ Str::startsWith($blog->featured_image, ['http://', 'https://']) ? $blog->featured_image : asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 group-hover:scale-105 transition-transform duration-700 flex items-center justify-center">
                                        <span class="text-gray-400 font-bold tracking-widest uppercase text-xs">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold mb-3 flex items-center text-black group-hover:text-black/70 transition-colors">
                                <span class="truncate">{{ $blog->title }}</span>
                                <svg class="w-4 h-4 ml-2 text-black transform group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed">
                                {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 100) }}
                            </p>
                        </a>
                    @empty
                        <div class="w-full py-20 text-center opacity-30">
                            <p class="text-2xl font-bold text-black">Journal entries are being prepared...</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-8 text-center w-full flex justify-center" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" class="btn-premium group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest bg-black text-white px-8 py-4">
                    <span class="relative z-10">Read More</span>
                    <svg class="w-5 h-5 relative z-10 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

"""
    new_lines = lines[:start_idx] + [new_blog_section] + lines[end_idx:]
    with open(file_path, 'w', encoding='utf-8') as f:
        f.writelines(new_lines)
    print('SUCCESS')
else:
    print('FAILED TO FIND SECTIONS')
