<?php

namespace App\GraphQL\Mutations\JobTitles;
use App\Models\JobsTitle;

final class CreateJobTitle
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $type = JobsTitle::create([
            'name' => $args['name'],
            'status' => $args['status']
        ]);
        return $type;
    }
}
