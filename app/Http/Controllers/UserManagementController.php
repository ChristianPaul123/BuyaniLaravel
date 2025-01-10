<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyFarmerRequest;
use App\Models\FarmerForm;
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

    /**
     * Verify the specified form.
     *
     * This method finds the FarmerForm by its ID, marks it as verified,
     * saves the changes, and redirects back with a success message.
     *
     * @param int $id The ID of the form to verify.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyForm($id)
    {
        $form = FarmerForm::findOrFail($id);

        $form->form_verified = true;
        $form->verified_by = Auth::guard('admin')->user()->id;

        $form->save();

        return redirect()
            ->back()->with('success', 'Form verified successfully.');
    }

    /**
     * Verify the identification of a farmer form.
     *
     * This method finds the FarmerForm by its ID, sets the id_verified attribute to true,
     * saves the changes, and then redirects back with a success message.
     *
     * @param int $id The ID of the FarmerForm to verify.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyIdentification($id)
    {
        $form = FarmerForm::findOrFail($id);

        $form->id_verified = true;
        $form->verified_by = Auth::guard('admin')->user()->id;

        $form->save();

        return redirect()
            ->back()->with('success', 'Identification verified successfully.');
    }
}
