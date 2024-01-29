<?php

namespace App\GraphQL\Mutations\Policies;

use App\Models\Policy;
use Illuminate\Support\Facades\Auth;

final class DeletePolicy
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $policy=Policy::find($args['id']);
        // if($policy){
        //     $policy->deleted_by=Auth::id();
            $policy->delete();
        // }
        return $policy;
    }
}
