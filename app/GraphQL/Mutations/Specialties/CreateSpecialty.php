<?php

namespace App\GraphQL\Mutations\Specialties;
use App\Models\Specialty;

final class CreateSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $specialty = new Specialty;
 
        $specialty->name = $args['name'];
        if($args['parent_id'])
            $specialty->parent_id = (int)$args['parent_id'];
        $specialty->save();
        return $specialty;
    }
}
