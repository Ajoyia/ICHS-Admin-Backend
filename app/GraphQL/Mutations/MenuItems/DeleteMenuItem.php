<?php

namespace App\GraphQL\Mutations\MenuItems;
use App\Models\MenuItem;

final class DeleteMenuItem
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return MenuItem::find($args['id'])->delete();
    }
}