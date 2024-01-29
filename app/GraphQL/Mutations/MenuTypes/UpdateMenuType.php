<?php

namespace App\GraphQL\Mutations\MenuTypes;
use App\Models\MenuType;

final class UpdateMenuType
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $menu_type = MenuType::find($args['id']);
        $menu_type->name = $args['name'];
        $menu_type->status = (int)$args['status'];
        $menu_type->save();
    }
}
