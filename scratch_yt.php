<?php
$html = file_get_contents('https://www.youtube.com/@sumitkdev');
preg_match('/"channelId":"(UC[a-zA-Z0-9_-]+)"/', $html, $matches);
if (!empty($matches[1])) {
    echo "CHANNEL_ID=" . $matches[1] . "\n";
} else {
    // try to find RSS link
    preg_match('/channel_id=(UC[a-zA-Z0-9_-]+)/', $html, $m);
    if (!empty($m[1])) {
        echo "CHANNEL_ID=" . $m[1] . "\n";
    } else {
        echo "NOT FOUND\n";
    }
}
