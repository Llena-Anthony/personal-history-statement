<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PHSController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['userDetail.nameDetail'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhereHas('userDetail.nameDetail', function ($q2) use ($search) {
                          $q2->where('first_name', 'like', "%{$search}%")
                             ->orWhere('last_name', 'like', "%{$search}%");
                      });
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('phs_status', $status);
            });

        $query->orderBy('phs_status')->orderBy('username');
        $submissions = $query->paginate(10)->withQueryString();
        
        $data = compact('submissions');
        if (request()->ajax()) {
            return view('admin.phs.index', $data)->render();
        }
        return view('admin.phs.index', $data);
    }

    public function show($username)
    {
        $user = User::with(['userDetail.nameDetail'])->where('username', $username)->firstOrFail();
        return view('admin.phs.show', compact('user'));
    }

    public function edit($username)
    {
        $user = User::with(['userDetail.nameDetail'])->where('username', $username)->firstOrFail();
        return view('admin.phs.edit', compact('user'));
    }

    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        
        $validated = $request->validate([
            'phs_status' => 'required|in:pending,in_progress,completed,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return redirect()->route('admin.phs.index')
            ->with('success', 'PHS submission status updated successfully.');
    }

    public function destroy($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();

        return redirect()->route('admin.phs.index')
            ->with('success', 'PHS submission deleted successfully.');
    }
} 