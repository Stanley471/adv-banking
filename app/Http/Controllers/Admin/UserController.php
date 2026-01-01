<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);
        
        // Toggle block status
        $user->is_blocked = !$user->is_blocked;
        $user->save();
        
        $status = $user->is_blocked ? 'blocked' : 'unblocked';
        
        // Create audit trail
        createAudit("User {$status}: {$user->email}", auth()->user());
        
        // Optional: Send email to user
        if ($user->is_blocked) {
            // dispatch(new \App\Jobs\CustomEmail('account_blocked', $user->id));
        }
        
        return redirect()->back()->with('success', "User successfully {$status}");
    }
}