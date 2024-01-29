<?php

namespace App\GraphQL\Queries\ProfileCards;

use Illuminate\Support\Facades\Config;

final class GetCoreOfProfessionalsTabs
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return  Config::get("variables.core_of_professionals_tabs");
    }
}
