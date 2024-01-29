<?php

namespace App\GraphQL\Queries\PoliciesPermission;

use App\Models\PolicyPermission;

final class policiesPermissionsNotOfAPolicy
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return PolicyPermission::whereNull('policy_id')->get();
    }
}
