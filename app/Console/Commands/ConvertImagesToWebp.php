<?php

namespace App\Console\Commands;

use App\Helpers\ImageHelper;
use App\Models\BlogPost;
use App\Models\Media;
use App\Models\PortfolioItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp {--quality=80 : WebP quality (0-100)} {--dry-run : Show what would be converted without actually converting}';

    protected $description = 'Convert all existing images (blog, portfolio, media, public) to WebP format for faster loading';

    private int $converted = 0;
    private int $skipped = 0;
    private int $failed = 0;
    private float $savedBytes = 0;

    public function handle(): int
    {
        $quality = (int) $this->option('quality');
        $dryRun = $this->option('dry-run');

        $this->info('🖼️  Converting all images to WebP format...');
        $this->info("   Quality: {$quality}%  |  Dry Run: " . ($dryRun ? 'Yes' : 'No'));
        $this->newLine();

        // 1. Convert static images in public/images/
        $this->convertPublicImages($quality, $dryRun);

        // 2. Convert blog images (featured + sub)
        $this->convertBlogImages($quality, $dryRun);

        // 3. Convert portfolio images (featured + sub)
        $this->convertPortfolioImages($quality, $dryRun);

        // 4. Convert media gallery images
        $this->convertMediaImages($quality, $dryRun);

        // Summary
        $this->newLine();
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info("✅ Converted: {$this->converted}");
        $this->info("⏭️  Skipped:   {$this->skipped}");
        if ($this->failed > 0) {
            $this->warn("❌ Failed:    {$this->failed}");
        }
        if ($this->savedBytes > 0) {
            $savedMB = round($this->savedBytes / 1024 / 1024, 2);
            $this->info("💾 Space saved: {$savedMB} MB");
        }
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        return Command::SUCCESS;
    }

    private function convertPublicImages(int $quality, bool $dryRun): void
    {
        $this->info('📁 Converting public/images/...');

        $publicImagesPath = public_path('images');
        if (!is_dir($publicImagesPath)) {
            $this->line('   No images directory found, skipping.');
            return;
        }

        $files = glob($publicImagesPath . '/*.{jpg,jpeg,png,gif,bmp}', GLOB_BRACE);

        foreach ($files as $file) {
            $basename = basename($file);
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if ($extension === 'webp') {
                $this->skipped++;
                continue;
            }

            if ($dryRun) {
                $size = filesize($file);
                $this->line("   Would convert: {$basename} (" . $this->formatBytes($size) . ")");
                $this->skipped++;
                continue;
            }

            try {
                $mime = mime_content_type($file);
                $image = $this->createImageFromFile($file, $mime);

                if ($image === false) {
                    $this->failed++;
                    $this->warn("   ❌ Failed: {$basename} (unsupported format)");
                    continue;
                }

                $webpName = pathinfo($file, PATHINFO_FILENAME) . '.webp';
                $webpPath = $publicImagesPath . '/' . $webpName;

                $originalSize = filesize($file);
                imagewebp($image, $webpPath, $quality);
                imagedestroy($image);
                $newSize = filesize($webpPath);

                // Delete original
                if ($file !== $webpPath) {
                    unlink($file);
                }

                $this->savedBytes += max(0, $originalSize - $newSize);
                $this->converted++;
                $this->line("   ✅ {$basename} → {$webpName} (" . $this->formatBytes($originalSize) . " → " . $this->formatBytes($newSize) . ")");
            } catch (\Exception $e) {
                $this->failed++;
                $this->warn("   ❌ Failed: {$basename} ({$e->getMessage()})");
            }
        }
    }

    private function convertBlogImages(int $quality, bool $dryRun): void
    {
        $this->info('📁 Converting blog images...');
        $posts = BlogPost::all();

        foreach ($posts as $post) {
            $changed = false;

            // Featured image
            if ($post->featured_image && !str_ends_with(strtolower($post->featured_image), '.webp')) {
                $result = $this->convertStorageImage($post->featured_image, $quality, $dryRun, 'blog');
                if ($result !== $post->featured_image) {
                    $post->featured_image = $result;
                    $changed = true;
                }
            }

            // Sub images
            if ($post->sub_images && is_array($post->sub_images)) {
                $newSubImages = [];
                foreach ($post->sub_images as $subImage) {
                    if (!str_ends_with(strtolower($subImage), '.webp')) {
                        $result = $this->convertStorageImage($subImage, $quality, $dryRun, 'blog/sub');
                        $newSubImages[] = $result;
                        if ($result !== $subImage) {
                            $changed = true;
                        }
                    } else {
                        $newSubImages[] = $subImage;
                    }
                }
                $post->sub_images = $newSubImages;
            }

            if ($changed && !$dryRun) {
                $post->save();
            }
        }
    }

    private function convertPortfolioImages(int $quality, bool $dryRun): void
    {
        $this->info('📁 Converting portfolio images...');
        $items = PortfolioItem::all();

        foreach ($items as $item) {
            $changed = false;

            // Featured image
            if ($item->featured_image && !str_ends_with(strtolower($item->featured_image), '.webp')) {
                $result = $this->convertStorageImage($item->featured_image, $quality, $dryRun, 'projects');
                if ($result !== $item->featured_image) {
                    $item->featured_image = $result;
                    $changed = true;
                }
            }

            // Sub images
            if ($item->sub_images && is_array($item->sub_images)) {
                $newSubImages = [];
                foreach ($item->sub_images as $subImage) {
                    if (!str_ends_with(strtolower($subImage), '.webp')) {
                        $result = $this->convertStorageImage($subImage, $quality, $dryRun, 'projects/sub');
                        $newSubImages[] = $result;
                        if ($result !== $subImage) {
                            $changed = true;
                        }
                    } else {
                        $newSubImages[] = $subImage;
                    }
                }
                $item->sub_images = $newSubImages;
            }

            if ($changed && !$dryRun) {
                $item->save();
            }
        }
    }

    private function convertMediaImages(int $quality, bool $dryRun): void
    {
        $this->info('📁 Converting media gallery images...');
        $mediaItems = Media::where('file_type', 'image')->get();

        foreach ($mediaItems as $item) {
            if (str_ends_with(strtolower($item->file_path), '.webp')) {
                $this->skipped++;
                continue;
            }

            $result = $this->convertStorageImage($item->file_path, $quality, $dryRun, 'media');
            if ($result !== $item->file_path && !$dryRun) {
                $item->file_path = $result;
                $item->mime_type = 'image/webp';
                $item->save();
            }
        }
    }

    private function convertStorageImage(string $path, int $quality, bool $dryRun, string $context): string
    {
        if (!Storage::disk('public')->exists($path)) {
            $this->warn("   ⚠️  Not found: {$path}");
            $this->skipped++;
            return $path;
        }

        $basename = basename($path);

        if ($dryRun) {
            $fullPath = Storage::disk('public')->path($path);
            $size = filesize($fullPath);
            $this->line("   Would convert: [{$context}] {$basename} (" . $this->formatBytes($size) . ")");
            $this->skipped++;
            return $path;
        }

        $fullPath = Storage::disk('public')->path($path);
        $originalSize = filesize($fullPath);

        $newPath = ImageHelper::convertExistingToWebp($path, 'public', $quality, true);

        if ($newPath !== $path) {
            $newFullPath = Storage::disk('public')->path($newPath);
            $newSize = filesize($newFullPath);
            $this->savedBytes += max(0, $originalSize - $newSize);
            $this->converted++;
            $this->line("   ✅ [{$context}] {$basename} → " . basename($newPath) . " (" . $this->formatBytes($originalSize) . " → " . $this->formatBytes($newSize) . ")");
        } else {
            $this->skipped++;
        }

        return $newPath;
    }

    private function createImageFromFile(string $filePath, string $mime): \GdImage|false
    {
        return match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($filePath),
            'image/png' => $this->createFromPng($filePath),
            'image/gif' => imagecreatefromgif($filePath),
            'image/bmp', 'image/x-ms-bmp' => imagecreatefrombmp($filePath),
            default => false,
        };
    }

    private function createFromPng(string $filePath): \GdImage|false
    {
        $image = imagecreatefrompng($filePath);
        if ($image === false) return false;
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        return $image;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }
}
