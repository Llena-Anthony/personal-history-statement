<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

trait ProfilePictureHandler
{
    /**
     * Handle profile picture upload with efficient cleanup
     *
     * @param UploadedFile $file
     * @param string $oldPicturePath
     * @param int $userId
     * @return string
     */
    protected function handleProfilePictureUpload(UploadedFile $file, ?string $oldPicturePath, int $userId): string
    {
        try {
            // Generate a unique filename with user ID and timestamp
            $filename = 'profile_' . $userId . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Store in organized directory structure
            $directory = 'profile-pictures/' . date('Y/m');
            $path = $file->storeAs($directory, $filename, 'public');
            
            // Ensure the directory exists
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory, 0755, true);
            }
            
            // Delete old profile picture if it exists and is different
            if ($oldPicturePath && $oldPicturePath !== $path) {
                $this->deleteProfilePicture($oldPicturePath);
            }
            
            Log::info('Profile picture uploaded successfully', [
                'user_id' => $userId,
                'old_path' => $oldPicturePath,
                'new_path' => $path,
                'file_size' => $file->getSize(),
                'file_type' => $file->getMimeType()
            ]);
            
            return $path;
            
        } catch (\Exception $e) {
            Log::error('Profile picture upload failed', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'file_name' => $file->getClientOriginalName()
            ]);
            
            throw $e;
        }
    }
    
    /**
     * Delete profile picture safely
     *
     * @param string $picturePath
     * @return bool
     */
    protected function deleteProfilePicture(?string $picturePath): bool
    {
        if (!$picturePath) {
            return false;
        }
        
        try {
            // Check if file exists before attempting to delete
            if (Storage::disk('public')->exists($picturePath)) {
                Storage::disk('public')->delete($picturePath);
                
                Log::info('Profile picture deleted successfully', [
                    'path' => $picturePath
                ]);
                
                return true;
            }
            
            return false;
            
        } catch (\Exception $e) {
            Log::error('Failed to delete profile picture', [
                'path' => $picturePath,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }
    
    /**
     * Clean up orphaned profile pictures (optional maintenance method)
     *
     * @param array $validPaths Array of valid profile picture paths from database
     * @return int Number of files deleted
     */
    protected function cleanupOrphanedProfilePictures(array $validPaths): int
    {
        try {
            $deletedCount = 0;
            $profilePicturesDir = 'profile-pictures';
            
            // Get all files in profile-pictures directory
            $allFiles = Storage::disk('public')->allFiles($profilePicturesDir);
            
            foreach ($allFiles as $file) {
                // Skip if this is a valid path
                if (in_array($file, $validPaths)) {
                    continue;
                }
                
                // Delete orphaned file
                if (Storage::disk('public')->delete($file)) {
                    $deletedCount++;
                    Log::info('Orphaned profile picture deleted', ['path' => $file]);
                }
            }
            
            Log::info('Profile picture cleanup completed', [
                'deleted_count' => $deletedCount,
                'total_files_checked' => count($allFiles)
            ]);
            
            return $deletedCount;
            
        } catch (\Exception $e) {
            Log::error('Profile picture cleanup failed', [
                'error' => $e->getMessage()
            ]);
            
            return 0;
        }
    }
    
    /**
     * Validate profile picture file
     *
     * @param UploadedFile $file
     * @return bool
     */
    protected function validateProfilePicture(UploadedFile $file): bool
    {
        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        
        return in_array($file->getMimeType(), $allowedMimes) && 
               $file->getSize() <= $maxSize &&
               $file->isValid();
    }
} 