<?php
// Run with: php artisan tinker cleanup_seo.php

use App\Models\PageSeo;

// Find all entries without leading slash (excluding '/')
$legacyEntries = PageSeo::all()->filter(function ($entry) {
    return $entry->page_path !== '/' && !str_starts_with($entry->page_path, '/');
});

echo "Found {$legacyEntries->count()} legacy entries without leading slash:\n";

foreach ($legacyEntries as $entry) {
    $normalizedPath = '/' . $entry->page_path;
    $canonical = PageSeo::where('page_path', $normalizedPath)->first();

    if ($canonical) {
        // Copy SEO data to canonical if it's empty
        if ($entry->meta_title && !$canonical->meta_title) {
            $canonical->update($entry->only([
                'page_name', 'meta_title', 'meta_description', 'meta_keywords',
                'og_title', 'og_description', 'og_image', 'twitter_card', 'twitter_handle',
            ]));
            echo "  Merged: {$entry->page_path} -> {$normalizedPath}\n";
        }
        $entry->delete();
        echo "  Deleted duplicate: {$entry->page_path}\n";
    } else {
        $entry->update(['page_path' => $normalizedPath]);
        echo "  Fixed path: {$entry->page_path} -> {$normalizedPath}\n";
    }
}

echo "\nRemaining entries:\n";
foreach (PageSeo::orderBy('page_path')->get() as $seo) {
    echo "  {$seo->page_path} => {$seo->page_name} | {$seo->meta_title}\n";
}

echo "\nDone! Now clear cache with: php artisan cache:clear\n";
