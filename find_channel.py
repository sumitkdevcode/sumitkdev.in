import urllib.request
import re

url = "https://www.youtube.com/@sumitkdev"
req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
try:
    html = urllib.request.urlopen(req).read().decode('utf-8')
    match = re.search(r'itemprop="url" href="http://www.youtube.com/channel/(UC[a-zA-Z0-9_-]+)"', html)
    if match:
        print("FOUND:", match.group(1))
    else:
        match2 = re.search(r'channelId":"(UC[a-zA-Z0-9_-]+)"', html)
        if match2:
            print("FOUND (json):", match2.group(1))
        else:
            print("NOT FOUND")
except Exception as e:
    print(e)
