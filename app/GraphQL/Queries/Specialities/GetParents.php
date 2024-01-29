<?php

namespace App\GraphQL\Queries\Specialities;

use App\Models\Specialty;

final class GetParents
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Specialty::whereNull('parent_id')->get();
    }
}
