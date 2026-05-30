import sys

with open('resources/views/contact.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

start_contact_socials = content.find('<ul class="flex space-x-6">')
if start_contact_socials != -1:
    end_contact_socials = content.find('</ul>', start_contact_socials) + 5
    
    new_icons = '''<ul class="flex space-x-6">
                                  @php
                                      $contactLinks = collect()
                                          ->merge($globalSocialLinks['social_media'] ?? [])
                                          ->merge($globalSocialLinks['developer_profiles'] ?? [])
                                          ->take(4);
                                  @endphp
                                  @foreach($contactLinks as $link)
                                      <li>
                                          <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                              class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all group">
                                              {!! str_replace('<svg ', '<svg class="w-4 h-4" ', $link->icon_svg) !!}
                                          </a>
                                      </li>
                                  @endforeach
                              </ul>'''
    content = content[:start_contact_socials] + new_icons + content[end_contact_socials:]

    with open('resources/views/contact.blade.php', 'w', encoding='utf-8') as f:
        f.write(content)
    print("Updated contact.blade.php successfully!")
else:
    print("Could not find contact social links")
