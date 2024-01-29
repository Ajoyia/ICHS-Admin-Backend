<?php

namespace App\GraphQL\Mutations\JobTitles;
use App\Models\JobsTitle;

final class DeleteJobTitle
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return JobsTitle::find($args['id'])->delete();
    }
}