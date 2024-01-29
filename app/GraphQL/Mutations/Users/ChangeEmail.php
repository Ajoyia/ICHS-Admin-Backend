<?php

namespace App\GraphQL\Mutations\Users;
use Illuminate\Support\Facades\Auth;


final class ChangeEmail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        $user->email = $args["email"];
        $user->save();
        return $user;
    }
}
