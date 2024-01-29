<?php

namespace App\GraphQL\Mutations\MenuTypes;
use App\Models\MenuType;

final class DeleteMenuType
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return MenuType::find($args['id'])->delete();
    }
}