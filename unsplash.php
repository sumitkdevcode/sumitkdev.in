<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://unsplash.com/s/photos/coding');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
$html = curl_exec($ch);
preg_match_all('/"id":"([^"]+)"/i', $html, $matches);
$ids = array_unique($matches[1]);
echo "Found: " . count($ids) . "\n";
foreach(array_slice($ids, 0, 10) as $id) echo $id . "\n";
