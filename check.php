<?php
libxml_use_internal_errors(true);
$content = file_get_contents('http://127.0.0.1:8000/sitemap.xml');
$xml = simplexml_load_string($content);
if ($xml === false) {
    foreach(libxml_get_errors() as $error) {
        echo "Error: " . $error->message . "\n";
    }
} else {
    echo 'XML is valid. Count: ' . count($xml->url) . "\n";
}
