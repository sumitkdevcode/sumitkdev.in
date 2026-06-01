<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://burst.shopify.com/technology');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$html = curl_exec($ch);
preg_match_all('/<img[^>]+src="([^"]+)"[^>]*class="js-track-photo-click/i', $html, $matches);
// Also try to find any image inside photo-tile
if (empty($matches[1])) {
    preg_match_all('/src="(https:\/\/burst\.shopifycdn\.com\/photos\/[^"]+)"/i', $html, $matches);
}

$urls = array_unique($matches[1]);
echo "Found: " . count($urls) . "\n";
foreach(array_slice($urls, 0, 10) as $url) {
    echo $url . "\n";
}
