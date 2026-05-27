<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Store an uploaded image as WebP format for optimal performance.
     * Falls back to original format if WebP conversion fails.
     *
     * @param UploadedFile $file The uploaded image file
     * @param string $directory The storage directory (e.g., 'blog', 'projects')
     * @param string $disk The storage disk (default: 'public')
     * @param int $quality WebP quality (0-100, default: 80)
     * @return string The stored file path relative to the disk
     */
    public static function storeAsWebp(UploadedFile $file, string $directory, string $disk = 'public', int $quality = 80): string
    {
        $mime = $file->getMimeType();

        // Only convert image types (not videos)
        if (!str_starts_with($mime, 'image/')) {
            return $file->store($directory, $disk);
        }

        // If already WebP, just store it
        if ($mime === 'image/webp') {
            return $file->store($directory, $disk);
        }

        try {
            $image = self::createImageFromFile($file->getRealPath(), $mime);

            if ($image === false) {
                return $file->store($directory, $disk);
            }

            // Generate a unique filename with .webp extension
            $filename = Str::random(40) . '.webp';
            $path = $directory . '/' . $filename;

            // Create a temporary file for WebP output
            $tempPath = tempnam(sys_get_temp_dir(), 'webp_');
            imagewebp($image, $tempPath, $quality);
            imagedestroy($image);

            // Store the WebP file
            Storage::disk($disk)->put($path, file_get_contents($tempPath));

            // Clean up temp file
            @unlink($tempPath);

            return $path;
        } catch (\Exception $e) {
            // If conversion fails, fall back to storing original
            return $file->store($directory, $disk);
        }
    }

    /**
     * Convert an existing image file on disk to WebP format.
     * Returns the new path or the original path if conversion fails.
     *
     * @param string $existingPath The existing file path relative to disk
     * @param string $disk The storage disk (default: 'public')
     * @param int $quality WebP quality (0-100, default: 80)
     * @param bool $deleteOriginal Whether to delete the original file after conversion
     * @return string The new file path (or original if conversion failed)
     */
    public static function convertExistingToWebp(string $existingPath, string $disk = 'public', int $quality = 80, bool $deleteOriginal = true): string
    {
        // Skip if already webp
        if (str_ends_with(strtolower($existingPath), '.webp')) {
            return $existingPath;
        }

        if (!Storage::disk($disk)->exists($existingPath)) {
            return $existingPath;
        }

        try {
            $fullPath = Storage::disk($disk)->path($existingPath);
            $mime = mime_content_type($fullPath);

            if (!str_starts_with($mime, 'image/')) {
                return $existingPath;
            }

            $image = self::createImageFromFile($fullPath, $mime);

            if ($image === false) {
                return $existingPath;
            }

            // Build new path with .webp extension
            $directory = dirname($existingPath);
            $filename = pathinfo($existingPath, PATHINFO_FILENAME) . '.webp';
            $newPath = $directory . '/' . $filename;

            // Convert and save
            $tempPath = tempnam(sys_get_temp_dir(), 'webp_');
            imagewebp($image, $tempPath, $quality);
            imagedestroy($image);

            Storage::disk($disk)->put($newPath, file_get_contents($tempPath));
            @unlink($tempPath);

            // Delete the original file
            if ($deleteOriginal && $existingPath !== $newPath) {
                Storage::disk($disk)->delete($existingPath);
            }

            return $newPath;
        } catch (\Exception $e) {
            return $existingPath;
        }
    }

    /**
     * Create a GD image resource from a file path based on MIME type.
     *
     * @param string $filePath
     * @param string $mime
     * @return \GdImage|false
     */
    private static function createImageFromFile(string $filePath, string $mime): \GdImage|false
    {
        return match ($mime) {
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($filePath),
            'image/png' => self::createFromPngPreserveAlpha($filePath),
            'image/gif' => imagecreatefromgif($filePath),
            'image/bmp', 'image/x-ms-bmp' => imagecreatefrombmp($filePath),
            default => false,
        };
    }

    /**
     * Create image from PNG while preserving alpha/transparency for WebP.
     */
    private static function createFromPngPreserveAlpha(string $filePath): \GdImage|false
    {
        $image = imagecreatefrompng($filePath);
        if ($image === false) {
            return false;
        }

        // Preserve transparency
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        return $image;
    }
}
