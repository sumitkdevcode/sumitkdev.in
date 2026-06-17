<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $response = \Illuminate\Support\Facades\Http::get("https://www.youtube.com/feeds/videos.xml?channel_id=UCjTP4KmZdAM8NMeMXPG95Mw");
    echo "STATUS: " . $response->status() . "\n";
    echo "BODY LENGTH: " . strlen($response->body()) . "\n";
} catch (\Exception $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n";
}
