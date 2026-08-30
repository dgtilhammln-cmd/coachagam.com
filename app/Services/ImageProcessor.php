<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageProcessor
{
    /**
     * Handle image upload, convert to WebP, and compress using native GD.
     *
     * @param UploadedFile $file The uploaded file
     * @param string $folder The destination folder inside storage/app/public/
     * @param bool $isFavicon If true, skip conversion and store original
     * @return string The stored file path relative to 'public' disk
     */
    public static function processAndStore(UploadedFile $file, string $folder, bool $isFavicon = false): string
    {
        // Favicon: store as-is (ICO/PNG favicon should not be converted)
        if ($isFavicon) {
            return $file->store($folder, 'public');
        }

        $mimeType = $file->getMimeType();

        // Only convert actual images (not SVG, ICO, etc.)
        $convertible = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $convertible)) {
            return $file->store($folder, 'public');
        }

        try {
            $sourcePath = $file->getRealPath();
            $filename   = Str::random(40) . '.webp';
            $storagePath = trim($folder, '/') . '/' . $filename;
            $disk = Storage::disk('public');

            // Make sure the folder exists
            if (!$disk->exists(trim($folder, '/'))) {
                $disk->makeDirectory(trim($folder, '/'));
            }

            // Load image with GD based on MIME type
            $gdImage = match ($mimeType) {
                'image/jpeg', 'image/jpg' => imagecreatefromjpeg($sourcePath),
                'image/png'               => imagecreatefrompng($sourcePath),
                'image/gif'               => imagecreatefromgif($sourcePath),
                'image/webp'              => imagecreatefromwebp($sourcePath),
                default                   => null,
            };

            if (!$gdImage) {
                return $file->store($folder, 'public');
            }

            // Preserve transparency for PNG/GIF
            imagepalettetotruecolor($gdImage);
            imagealphablending($gdImage, true);
            imagesavealpha($gdImage, true);

            // Encode WebP to buffer (quality 82)
            ob_start();
            imagewebp($gdImage, null, 82);
            $webpData = ob_get_clean();
            imagedestroy($gdImage);

            // Store to disk
            $disk->put($storagePath, $webpData);

            return $storagePath;
        } catch (\Throwable $e) {
            // Fallback to normal store if anything fails
            return $file->store($folder, 'public');
        }
    }
}
