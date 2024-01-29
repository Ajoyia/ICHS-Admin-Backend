<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\UserPolicy;

final class UpdateUserPolicies
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $policies=$args['policies'];
        $user=$args['user_id'];
        foreach($policies as $policy){
            $up=new UserPolicy();
            $up->policy_id=$policy;
            $up->user_id=$user;
            $up->save();
        }
        return "done";
    }
}
