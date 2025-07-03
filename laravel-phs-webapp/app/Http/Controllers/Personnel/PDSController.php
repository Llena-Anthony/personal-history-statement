<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Models\PDSSubmission;
use Illuminate\Http\Request;

class PDSController extends Controller
{
    public function index()
    {
        // Get current user's PDS submissions
        $pdsSubmissions = PDSSubmission::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get latest PDS submission
        $latestPDS = PDSSubmission::where('user_id', auth()->id())
            ->latest()
            ->first();
        
        // Calculate PDS completion status
        $pdsStatus = $this->calculatePDSStatus($latestPDS);
        
        return view('personnel.pds.index', compact('pdsSubmissions', 'latestPDS', 'pdsStatus'));
    }
    
    private function calculatePDSStatus($latestPDS)
    {
        if (!$latestPDS) {
            return [
                'status' => 'Not Started',
                'percentage' => 0,
                'color' => 'gray',
                'icon' => 'fas fa-times-circle'
            ];
        }
        
        // Simple status calculation - you can expand this based on your PDS requirements
        $status = $latestPDS->status ?? 'In Progress';
        
        switch ($status) {
            case 'completed':
                return [
                    'status' => 'Completed',
                    'percentage' => 100,
                    'color' => 'green',
                    'icon' => 'fas fa-check-circle'
                ];
            case 'submitted':
                return [
                    'status' => 'Submitted',
                    'percentage' => 90,
                    'color' => 'blue',
                    'icon' => 'fas fa-paper-plane'
                ];
            case 'in_progress':
                return [
                    'status' => 'In Progress',
                    'percentage' => 50,
                    'color' => 'yellow',
                    'icon' => 'fas fa-clock'
                ];
            default:
                return [
                    'status' => 'In Progress',
                    'percentage' => 25,
                    'color' => 'yellow',
                    'icon' => 'fas fa-edit'
                ];
        }
    }
} 