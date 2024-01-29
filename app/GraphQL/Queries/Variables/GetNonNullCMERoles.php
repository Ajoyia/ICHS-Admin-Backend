<?php

namespace App\GraphQL\Queries\Variables;

use App\Models\CMERole;

final class GetNonNullCMERoles
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $roles = CMERole::whereNotNull('link_role')->get();
       return $roles;
    }
}