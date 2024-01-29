<?php

namespace App\GraphQL\Mutations\JobTitles;
use App\Models\JobsTitle;

final class UpdateJobTitle
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $menu_type = JobsTitle::find($args['id']);
        $menu_type->name = $args['name'];
        $menu_type->status = (int)$args['status'];
        $menu_type->save();
    }
}
