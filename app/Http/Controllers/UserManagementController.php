<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function showUsers()
    {
        // Fetch consumers (user_type = 1) and farmers (user_type = 2)
        $consumers = User::where('user_type', 1)->get();
        $farmers = User::where('user_type', 2)->get();

        return view('admin.management.management-index', compact('consumers', 'farmers'));
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.management.user-view-information', compact('user'));
    }

    /**
     * Deactivate a user.
     */
    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);

        // Set deactivated status
        $user->deactivated_status = true;
        $user->deactivated_date = now();
        $user->deactivated_by = Auth::guard('admin')->user()->id; // Assuming the admin performing the action is logged in

        $user->save();


           // Redirect based on user type
        if ($user->user_type == 1) {
            return redirect()->route('admin.management', ['tab' => 'consumers'])
                ->with('success', 'User deactivated successfully.');
        } elseif ($user->user_type == 2) {
            return redirect()->route('admin.management', ['tab' => 'farmers'])
                ->with('success', 'User deactivated successfully.');
        }

        return redirect()->route('admin.management', ['tab' => 'consumers'])
        ->with('success',' User deactivated successfully.');
    }

    /**
     * Reactivate a user.
     */
    public function reactivateUser($id)
    {
        $user = User::findOrFail($id);

        // Reset deactivated status
        $user->deactivated_status = false;
        $user->deactivated_date = null;
        $user->deactivated_by = null;

        $user->save();

                   // Redirect based on user type
                   if ($user->user_type == 1) {
                    return redirect()->route('admin.management', ['tab' => 'consumers'])
                        ->with('success', 'User reactivated successfully.');
                } elseif ($user->user_type == 2) {
                    return redirect()->route('admin.management', ['tab' => 'farmers'])
                        ->with('success', 'User reactivated successfully.');
                }

        return redirect()->route('admin.management', ['tab' => 'consumers'])
        ->with('success',' User reactivated successfully.');
    }
}
