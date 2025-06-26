<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Traits\ProfilePictureHandler;
use Illuminate\Support\Facades\Storage;

class CleanupOrphanedProfilePictures extends Command
{
    use ProfilePictureHandler;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:cleanup-pictures {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up orphaned profile pictures from storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->info('🔍 Running in DRY RUN mode - no files will be deleted');
        } else {
            $this->info('🧹 Starting profile picture cleanup...');
        }

        // Get all valid profile picture paths from database
        $validPaths = User::whereNotNull('profile_picture')
            ->pluck('profile_picture')
            ->filter()
            ->toArray();

        $this->info("📊 Found " . count($validPaths) . " valid profile pictures in database");

        // Get all files in profile-pictures directory
        $profilePicturesDir = 'profile-pictures';
        
        if (!Storage::disk('public')->exists($profilePicturesDir)) {
            $this->info("📁 Directory '{$profilePicturesDir}' does not exist. Nothing to clean up.");
            return 0;
        }

        $allFiles = Storage::disk('public')->allFiles($profilePicturesDir);
        $this->info("📁 Found " . count($allFiles) . " files in storage directory");

        $orphanedFiles = [];
        $deletedCount = 0;

        foreach ($allFiles as $file) {
            // Skip if this is a valid path
            if (in_array($file, $validPaths)) {
                continue;
            }

            $orphanedFiles[] = $file;
            
            if (!$isDryRun) {
                // Delete orphaned file
                if (Storage::disk('public')->delete($file)) {
                    $deletedCount++;
                    $this->line("🗑️  Deleted: {$file}");
                } else {
                    $this->error("❌ Failed to delete: {$file}");
                }
            } else {
                $this->line("🔍 Would delete: {$file}");
            }
        }

        if ($isDryRun) {
            $this->info("🔍 DRY RUN SUMMARY:");
            $this->info("   - Files that would be deleted: " . count($orphanedFiles));
            $this->info("   - Storage space that would be freed: " . $this->formatBytes($this->calculateTotalSize($orphanedFiles)));
        } else {
            $this->info("✅ CLEANUP COMPLETED:");
            $this->info("   - Files deleted: {$deletedCount}");
            $this->info("   - Storage space freed: " . $this->formatBytes($this->calculateTotalSize($orphanedFiles)));
        }

        return 0;
    }

    /**
     * Calculate total size of files
     *
     * @param array $files
     * @return int
     */
    private function calculateTotalSize(array $files): int
    {
        $totalSize = 0;
        
        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                $totalSize += Storage::disk('public')->size($file);
            }
        }
        
        return $totalSize;
    }

    /**
     * Format bytes to human readable format
     *
     * @param int $bytes
     * @return string
     */
    private function formatBytes(int $bytes): string
    {
        if ($bytes === 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor(log($bytes, 1024));
        
        return round($bytes / pow(1024, $factor), 2) . ' ' . $units[$factor];
    }
}
