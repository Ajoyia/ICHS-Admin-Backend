<?php

namespace App\GraphQL\Queries\Variables;

use App\Models\AccredationRole;

final class GetNonNullAccredationRoles
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $roles = AccredationRole::whereNotNull('link_role')->get();
       return $roles;
    }
}