<?php

namespace App\GraphQL\Queries;

final class GetLectureTypes
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return config('variables.lecture_types');
    }
}
