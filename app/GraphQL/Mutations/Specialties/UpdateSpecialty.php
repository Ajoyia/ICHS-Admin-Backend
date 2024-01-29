<?php

namespace App\GraphQL\Mutations\Specialties;
use App\Models\Specialty;

final class UpdateSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $specialty = Specialty::find($args['id']);
        $specialty->name = $args['name'];
        if($args['parent_id'])
            $specialty->parent_id = (int)$args['parent_id'];
        else
            $specialty->parent_id = null;
        $specialty->save();
    }
}
