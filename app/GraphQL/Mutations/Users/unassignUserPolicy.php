<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\UserPolicy;
use Illuminate\Support\Facades\Auth;

final class unassignUserPolicy
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $up=UserPolicy::where('user_id',$args['user'])->where('policy_id',$args['policy'])->first();
        $up->deleted_by=Auth::id();
        $up->save();
        $up->delete();
        return (string)$up;
    }
}
