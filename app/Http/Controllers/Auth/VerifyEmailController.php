<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\VerifyUser;
use Carbon\Carbon;

class VerifyEmailController extends Controller
{
    public function verifyUser($token)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->verified) {
                $verifyUser->user->email_verified_at = $current_date_time;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return $status;
            // return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return $status;
        // return redirect('/login')->with('status', $status);
    }
}
