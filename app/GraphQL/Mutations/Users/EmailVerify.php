<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\User;
use App\Models\VerifyUser;
use App\Models\UserPolicy;

final class EmailVerify
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::with('verifyUser')->where('email',$args['email'])->first();

        $up = new UserPolicy();
        $up->policy_id = 2;
        $up->user_id = $user->id;
        $up->save();

        if ($user->verifyUser === null) {
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time()),
            ]);
        } else {
            $verifyUser = $user->verifyUser;
            $verifyUser->token = sha1(time());
            $verifyUser->save();
        }
        if ($user) {
            $user->sendEmail();
            return 'Verification email sent!';
        }
        return "Sorry your email cannot be identified.";
    }
}
