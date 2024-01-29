<?php

namespace App\GraphQL\Mutations;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Error;
use Illuminate\Support\Facades\Auth;


final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = auth();
        if( ! $guard->attempt(['email' => $args['email'], 'password' => $args['password']])) {
            throw new Error('Invalid credentials.');
        }

        /**
         * Since we successfully logged in, this can no longer be `null`.
         *
         * @var \App\Models\User $user
         */
        $user = $guard->user();
        if($user->type==2||$user->type==$args['system']){
            $user->token=$user->createToken("web")->plainTextToken;
            return $user;
        }
        else
            throw new Error('These Invalid credentials.');
    }
}
