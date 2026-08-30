<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvertImagesToWebp extends Command
{
    protected $signature   = 'images:webp-compress';
    protected $description = 'Convert all existing JPG/PNG images in storage to WebP and update database settings';

    public function handle()
    {
        $this->info('Starting image conversion to WebP...');
        $this->newLine();

        if (!function_exists('imagewebp')) {
            $this->error('GD extension with WebP support is required! Please enable ext-gd in php.ini.');
            return 1;
        }

        // Get favicon path to skip it
        $faviconPath = SiteSetting::where('key', 'general.favicon')->value('value');

        $disk  = Storage::disk('public');
        $files = $disk->allFiles();

        $converted = 0;
        $skipped   = 0;
        $errors    = 0;

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                continue;
            }

            // Skip favicon
            if ($faviconPath === $file || str_contains(basename($file), 'favicon')) {
                $this->line("<fg=yellow>SKIP</> favicon: {$file}");
                $skipped++;
                continue;
            }

            $absolutePath = $disk->path($file);
            $newFile      = preg_replace('/\.' . preg_quote($ext, '/') . '$/i', '.webp', $file);

            try {
                // Load with GD
                $gdImage = match ($ext) {
                    'jpg', 'jpeg' => imagecreatefromjpeg($absolutePath),
                    'png'         => imagecreatefrompng($absolutePath),
                    default       => null,
                };

                if (!$gdImage) {
                    $this->line("<fg=red>FAIL</> Could not read: {$file}");
                    $errors++;
                    continue;
                }

                // Preserve transparency
                imagepalettetotruecolor($gdImage);
                imagealphablending($gdImage, true);
                imagesavealpha($gdImage, true);

                // Encode to WebP (quality 82)
                ob_start();
                imagewebp($gdImage, null, 82);
                $webpData = ob_get_clean();
                imagedestroy($gdImage);

                // Save new file
                $disk->put($newFile, $webpData);

                // Delete old file
                $disk->delete($file);

                // Update database references
                $this->updateDb($file, $newFile);

                $this->line("<fg=green>DONE</> {$file} → {$newFile}");
                $converted++;
            } catch (\Throwable $e) {
                $this->line("<fg=red>ERROR</> {$file}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->newLine();
        $this->info("Done! Converted: {$converted}, Skipped: {$skipped}, Errors: {$errors}");
        return 0;
    }

    private function updateDb(string $oldPath, string $newPath): void
    {
        // Plain text settings
        SiteSetting::where('value', $oldPath)->update(['value' => $newPath]);

        // JSON settings (timelines, slides, etc.)
        $jsonRows = SiteSetting::where('type', 'json')
            ->orWhere(function ($q) use ($oldPath) {
                // Also catch text rows that contain the path as part of JSON string
                $q->where('type', 'text')->where('value', 'like', '%' . $oldPath . '%');
            })
            ->get();

        foreach ($jsonRows as $row) {
            if ($row->value && str_contains($row->value, $oldPath)) {
                $row->value = str_replace($oldPath, $newPath, $row->value);
                $row->save();
            }
        }
    }
}
