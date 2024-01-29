<?php

namespace App\GraphQL\Mutations;

use App\Models\VerifyUser;
use Carbon\Carbon;
use App\Models\UserPolicy;

final class UserEmailVerify
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $verifyUser = VerifyUser::where('token', $args["token"])->first();
        $Object = new \stdClass;
        $Object->message = "Invalid Attempt!!!";
        $Object->status = 0;
        

            if (isset($verifyUser)) {
                $exp_date = $verifyUser->updated_at->addHour();
                if ($current_date_time < $exp_date) {
                $user = $verifyUser->user;
                if (!$user->email_verified_at) {
                    $verifyUser->user->email_verified_at = $current_date_time;
                    $verifyUser->user->save();
                    $Object->message = "Your e-mail is verified. You can now login.";
                    $Object->status = 1;
                    $up = new UserPolicy();
                    $up->policy_id = 3;
                    $up->user_id = $verifyUser->user->id;
                    $up->save();
                } else {
                    $Object->message = "Your e-mail is already verified. You can now login.";
                    $Object->status = 1;
                }
            } else {
                return $Object;
            }
        } else {
            $Object->message = "Your link is expired, resend your verification link form dashboard.";
            $Object->status = 0;
        }
        return $Object;
    }
}
