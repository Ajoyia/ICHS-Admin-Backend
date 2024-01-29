<?php

namespace App\GraphQL\Mutations\MenuTypes;
use App\Models\MenuType;

final class CreateMenuType
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $type = MenuType::create([
            'name' => $args['name'],
            'status' => $args['status']
        ]);
        return $type;
    }
}
