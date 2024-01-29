<?php

namespace App\GraphQL\Queries\Products;

final class GetAllProductLinks
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return config('link_products');
    }
}
