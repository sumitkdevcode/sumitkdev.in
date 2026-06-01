<?php
$terms = ['laptop', 'code screen', 'artificial intelligence', 'machine learning', 'programmer', 'data center'];
$urls = [];

foreach ($terms as $term) {
    $url = "https://en.wikipedia.org/w/api.php?action=query&format=json&prop=pageimages&generator=search&gsrsearch=" . urlencode($term) . "&gsrlimit=10&pithumbsize=800";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'SumitkDev/1.0');
    $response = curl_exec($ch);
    $data = json_decode($response, true);
    
    if (isset($data['query']['pages'])) {
        foreach ($data['query']['pages'] as $page) {
            if (isset($page['thumbnail']['source'])) {
                $urls[] = $page['thumbnail']['source'];
            }
        }
    }
}

$urls = array_unique($urls);
echo "Found: " . count($urls) . "\n";
foreach(array_slice($urls, 0, 10) as $url) {
    echo $url . "\n";
}
file_put_contents('tech_images.json', json_encode(array_values($urls), JSON_PRETTY_PRINT));
