import re

with open('database/seeders/PageSeoSeeder.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace 'Sumit Kumar (sumitkdev)' with 'Sumit Kumar' in meta_title and og_title
content = re.sub(r"'meta_title'\s*=>\s*'([^']*) \(sumitkdev\)([^']*)'", r"'meta_title' => '\1\2'", content)
content = re.sub(r"'og_title'\s*=>\s*'([^']*) \(sumitkdev\)([^']*)'", r"'og_title' => '\1\2'", content)

# Replace ' (sumitkdev)' just in case some other format was used in title
content = re.sub(r"'meta_title'\s*=>\s*'([^']*) \(sumitkdev\)'", r"'meta_title' => '\1'", content)
content = re.sub(r"'og_title'\s*=>\s*'([^']*) \(sumitkdev\)'", r"'og_title' => '\1'", content)

# Remove ' - sumitkdev' or ' — sumitkdev'
content = re.sub(r" — sumitkdev", "", content)

# Ensure "Sumit Kumar" is kept instead of "Sumit Kumar (sumitkdev)" everywhere in titles
content = content.replace("Sumit Kumar (sumitkdev)", "Sumit Kumar")
content = content.replace("sumitkdev)", ")")

with open('database/seeders/PageSeoSeeder.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Fixed PageSeoSeeder.php")
