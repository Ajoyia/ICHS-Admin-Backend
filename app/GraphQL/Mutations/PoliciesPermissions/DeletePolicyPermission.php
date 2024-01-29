<?php

namespace App\GraphQL\Mutations\PoliciesPermissions;

use App\Models\PolicyPermission;
use Illuminate\Support\Facades\Auth;

final class DeletePolicyPermission
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $policyPermission=PolicyPermission::find($args['id']);
        if($policyPermission){
            $policyPermission->deleted_by=Auth::id();
            $policyPermission->deleted_at=now();
            $policyPermission->save();
        }
        return $policyPermission;
    }
}
