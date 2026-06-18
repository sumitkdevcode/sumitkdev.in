<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://rsshub.app/youtube/channel/UCjTP4KmZdAM8NMeMXPG95Mw");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "STATUS: $httpcode\n";
echo substr($output, 0, 100) . "\n";
