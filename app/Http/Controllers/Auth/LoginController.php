<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginLinkEmail;
use App\Mail\OtpMail;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {

        if(Auth::check()){
             return redirect()->route('dashboardd');
        }else{

            return view('auth.login');
        }
    }

    public function sendLoginLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'=>'required',
            'g-recaptcha-response'=>'required'
        ],[
           'g-recaptcha-response.required' =>'Recaptcha is Requred'
        ]);



      $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();

            // Check if recovery_email is set
            if ($user->email) {
                // Generate OTP
                $otp = rand(100000, 999999);

                // Store OTP and its expiry time in the user's record
                $user->otp = $otp;
                $user->otp_expiry = now()->addMinutes(5); // Example: OTP expires in 5 minutes
                $user->is_otp_verified = false;
                $user->save();

                  Mail::to($user->email)->send(new OtpMail($user->otp));

                // Redirect to OTP verification page with OTP details
                return redirect()->route('otp.verify')->with([
                    'otp' => $otp,
                    'expiry_time' => $user->otp_expiry,
                ]);
            } else {
                // Handle case where recovery_email is not set
                return redirect()->back()->with('error', 'Recovery email is not set.')->withInput();
            }
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Invalid email or password.')->withInput();
        }






        // // Check if user exists
        // if (!$user) {
        //     return back()->withErrors(['email' => 'No user found with this email address.'])->withInput();
        // }

        // // Generate a temporary signed route for login
        // $loginLink = URL::temporarySignedRoute(
        //     'login.with.link', now()->addMinutes(30), ['user' => $user->id]
        // );

        // // Send email using LoginLinkEmail mailable
        // Mail::to($user->email)->send(new LoginLinkEmail($loginLink));

        // return 'Login link sent successfully!';


    }

    public function showVerifyResend(){
         // Authentication passed
         $user = Auth::user();

         // Check if recovery_email is set
         if ($user->email) {
             // Generate OTP
             $otp = rand(100000, 999999);

             // Store OTP and its expiry time in the user's record
             $user->otp = $otp;
             $user->otp_expiry = now()->addMinutes(5); // Example: OTP expires in 5 minutes
             $user->is_otp_verified = false;
             $user->save();

              Mail::to($user->email)->send(new OtpMail($user->otp));

             // Redirect to OTP verification page with OTP details
             return redirect()->route('otp.verify')->with([
                 'otp' => $otp,
                 'expiry_time' => $user->otp_expiry,
             ]);
         } else {
             // Handle case where recovery_email is not set
             return redirect()->back()->with('error', 'Recovery email is not set.')->withInput();
         }
    }

    public function loginWithLink(Request $request, $userId)
    {
        $request->validate([
            'signature' => 'required',
        ]);

        $user = User::findOrFail($userId);

        if (!URL::hasValidSignature($request)) {
            abort(403, 'Unauthorized action.');
        }

        Auth::login($user);

        return redirect()->route('dashboardd');
    }

    public function showVerifyForm()
    {
        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $user = Auth::user();

        if ($user->otp === $request->otp && now()->lt($user->otp_expiry)) {
            // OTP is valid and not expired
            // Clear OTP fields after successful verification
            $user->otp = null;
            $user->otp_expiry = null;
            $user->is_otp_verified = true;
            $user->save();

            // Redirect to dashboard or intended URL after successful verification
            Auth::login($user);
            return redirect()->intended('/dashboardd');
        } else {
            // OTP is invalid or expired
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
