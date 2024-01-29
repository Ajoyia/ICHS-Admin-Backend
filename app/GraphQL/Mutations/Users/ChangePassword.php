<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class ChangePassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if($args['newPassword']!=$args['cNewPassword']){
            return 'New Password and Confirm New Password doesnot match';
        }
        $user=User::find($args['id']);
        $password = Hash::make($args['newPassword']);
        $user->password=$password;
        $user->save();
        return 'changed';
    }


}
