<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://unsplash.com/napi/search/photos?query=coding&per_page=30');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$res = curl_exec($ch);
$data = json_decode($res, true);
echo 'Count: ' . count($data['results']) . "\n";
foreach ($data['results'] as $r) {
    echo $r['id'] . "\n";
}
