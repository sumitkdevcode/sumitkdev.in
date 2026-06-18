<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.youtube.com/feeds/videos.xml?channel_id=UCjTP4KmZdAM8NMeMXPG95Mw");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36");
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "STATUS: $httpcode\n";
echo substr($output, 0, 200) . "\n";
