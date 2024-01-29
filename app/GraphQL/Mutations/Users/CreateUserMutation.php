<?php

namespace App\GraphQL\Mutations\Users;

use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\VerifyUser;

final class CreateUserMutation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $args['password'] = bcrypt($args["password"]);

        $args['is_accept'] = true;

        $user = User::create($args);

        // event(new Registered($user));

        $accessToken = $user->createToken("web")->accessToken;
        $user->token = $accessToken;

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time()),
        ]);
        if($args['send_creds'])
            $user->sendEmail();

        // \Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }
    public function verifyEmail($_, array $args)
    {
        $user = User::where('email', $args['email'])->get();
        if ($user) {
            $user->sendEmail();
            return 'Verification email sent!';
        }
        return "Sorry your email cannot be identified.";
    }

}
