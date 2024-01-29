<?php

namespace App\GraphQL\Queries\ProductCountryTypes;

use App\Models\MembershipType;
use App\Models\ProductCountryType;

final class ProductCountryTypesFrontend
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $pcts=MembershipType::with('productCountryTypes')->get();
        foreach($pcts as $pct){
            foreach($pct->productCountryTypes as $ct)
                $ct->priceAed=$ct->price*config('variables.currency_rate');
        }
        return $pcts;
    }
}
