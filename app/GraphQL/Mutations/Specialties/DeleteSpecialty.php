<?php

namespace App\GraphQL\Mutations\Specialties;
use App\Models\Specialty;

final class DeleteSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Specialty::find($args['id'])->delete();
    }
}