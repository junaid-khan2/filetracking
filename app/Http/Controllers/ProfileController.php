<?php



namespace App\Http\Controllers;



use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Illuminate\View\View;



class ProfileController extends Controller

{

    /**

     * Display the user's profile form.

     */

    public function edit(Request $request): View

    {

        return view('auth.profile_edit', [

            'user' => $request->user(),

        ]);

    }



    /**

     * Update the user's profile information.

     */

    public function update(ProfileUpdateRequest $request): RedirectResponse


    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(), // Unique rule except current user
            'recovery_email' => 'required|email',
            'profile' => 'mimes:jpeg,jpg,png',
        ]);

        $user = $request->user();



        // Update profile information

        $user->fill($request->validated());



        // Check if password is being updated

        if ($request->filled('password')) {

            $user->password = bcrypt($request->password);

        }
        if ($request->filled('recovery_email')) {
            $user->recovery_email = $request->recovery_email;
        }




        // Reset email verification if email is being updated

        if ($user->isDirty('email')) {

            $user->email_verified_at = null;

        }

        if ($request->hasFile('profile')) {
            $profileImage = $request->file('profile');

            // Delete old profile picture if it exists
            if ($user->profile && file_exists(public_path('uploads/profile/' . $user->profile)) && is_file(public_path('uploads/profile/' . $user->profile))) {
                unlink(public_path('uploads/profile/' . $user->profile));
            }

            // Store new profile picture
            $profileImageName = uniqid('profile_', true) . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('uploads/profile'), $profileImageName);

            // Update user's profile attribute with the new file name
            $user->profile = $profileImageName;
        }




        // Save the changes

        $user->save();



        return Redirect::route('dashboard')->with('success', 'profile updated succssfuly');

    }





    /**

     * Delete the user's account.

     */

    public function destroy(Request $request): RedirectResponse

    {

        $request->validateWithBag('userDeletion', [

            'password' => ['required', 'current_password'],

        ]);



        $user = $request->user();



        Auth::logout();



        $user->delete();



        $request->session()->invalidate();

        $request->session()->regenerateToken();



        return Redirect::to('/');

    }

}

