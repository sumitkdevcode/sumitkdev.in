import urllib.request
import re

url = "https://www.youtube.com/watch?v=3z4g7gqYlHk"
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'})
try:
    html = urllib.request.urlopen(req).read().decode('utf-8')
    match = re.search(r'channelId":"(UC[a-zA-Z0-9_-]+)"', html)
    if match:
        print("FOUND:", match.group(1))
    else:
        print("NOT FOUND")
except Exception as e:
    print(e)
