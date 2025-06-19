<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PHSSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PHSController extends Controller
{
    public function index(Request $request)
    {
        $query = PHSSubmission::with('user')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->date_from, function ($query, $date) {
                $query->whereDate('created_at', '>=', $date);
            })
            ->when($request->date_to, function ($query, $date) {
                $query->whereDate('created_at', '<=', $date);
            });

        // Handle sorting
        if ($request->sort) {
            $direction = $request->direction === 'asc' ? 'asc' : 'desc';
            
            switch ($request->sort) {
                case 'name':
                    $query->join('users', 'phs_submissions.user_id', '=', 'users.id')
                          ->orderBy('users.name', $direction)
                          ->select('phs_submissions.*');
                    break;
                case 'status':
                    $query->orderBy('status', $direction);
                    break;
                case 'created_at':
                    $query->orderBy('created_at', $direction);
                    break;
                case 'updated_at':
                    $query->orderBy('updated_at', $direction);
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $submissions = $query->paginate(10)->withQueryString();

        // Get searchable fields for the search bar
        $searchFields = collect((new PHSSubmission())->getSearchableFields())->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();

        return view('admin.phs.index', compact('submissions', 'searchFields'));
    }

    public function show(PHSSubmission $submission)
    {
        $submission->load(['user', 'personalInfo', 'familyHistory', 'educationalBackground', 'employmentHistory', 'militaryHistory']);
        return view('admin.phs.show', compact('submission'));
    }

    public function edit(PHSSubmission $submission)
    {
        $submission->load(['user', 'personalInfo', 'familyHistory', 'educationalBackground', 'employmentHistory', 'militaryHistory']);
        return view('admin.phs.edit', compact('submission'));
    }

    public function update(Request $request, PHSSubmission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $submission->update($validated);

        return redirect()->route('admin.phs.index')
            ->with('success', 'PHS submission status updated successfully.');
    }

    public function destroy(PHSSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.phs.index')
            ->with('success', 'PHS submission deleted successfully.');
    }
} 