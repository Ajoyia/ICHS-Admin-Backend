<?php

namespace App\GraphQL\Queries\PageCategory;

use Illuminate\Support\Facades\Config;

final class GetPageTemplate
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $arr = Config::get("variables.pages_categories_templates");
        return $arr;
    }
}
