<?php

namespace App\GraphQL\Queries\MedicalHealthProfessionals;

use App\Models\MedicalHealthProfessional;

final class GetParents
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return MedicalHealthProfessional::whereNull('parent_id')->get();
    }
}
