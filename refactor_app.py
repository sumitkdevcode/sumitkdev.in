import sys

with open('resources/views/layouts/app.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Replace sameAs array in schema
start_schema = content.find('"sameAs": [')
if start_schema != -1:
    end_schema = content.find(']', start_schema) + 1
    new_schema = '''"sameAs": [
              @php
                  $allLinks = collect();
                  if(isset($globalSocialLinks)) {
                      foreach($globalSocialLinks as $category => $links) {
                          $allLinks = $allLinks->merge($links);
                      }
                  }
              @endphp
              @foreach($allLinks as $link)
                  "{{ $link->url }}"{{ $loop->last ? '' : ',' }}
              @endforeach
          ]'''
    content = content[:start_schema] + new_schema + content[end_schema:]

# 2. Replace footer icons
start_footer_icons = content.find('<!-- LinkedIn -->')
if start_footer_icons != -1:
    end_footer_icons = content.find('</div>', start_footer_icons) # End of the flex container containing icons
    
    # We want to replace from start_footer_icons up to the end of the icons
    # The actual structure is:
    # <div class="flex gap-4">
    #     <!-- LinkedIn --> ...
    #     <!-- GitHub --> ...
    #     <!-- Twitter --> ...
    #     <!-- Instagram --> ...
    # </div>
    # Let's find the end of the last </a> which is before that </div>
    last_a_end = content.find('</a>', content.find('<!-- Instagram -->')) + 4
    
    new_icons = '''@php
                                  $footerLinks = collect()
                                      ->merge($globalSocialLinks['social_media'] ?? [])
                                      ->merge($globalSocialLinks['developer_profiles'] ?? [])
                                      ->take(5);
                              @endphp
                              @foreach($footerLinks as $link)
                                  <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                      class="w-12 h-12 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all">
                                      {!! str_replace('<svg ', '<svg class="w-5 h-5" ', $link->icon_svg) !!}
                                  </a>
                              @endforeach
'''
    
    content = content[:start_footer_icons] + new_icons + content[last_a_end:]

with open('resources/views/layouts/app.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print("Updated app.blade.php successfully!")
