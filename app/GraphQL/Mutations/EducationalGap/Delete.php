<?php

namespace App\GraphQL\Mutations\EducationalGap;

use App\Models\EducationalGap;

final class Delete
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        EducationalGap::find($args['id'])->delete();
        return "done";
    }
}
