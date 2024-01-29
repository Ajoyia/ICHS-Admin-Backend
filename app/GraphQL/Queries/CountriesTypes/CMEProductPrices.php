<?php

namespace App\GraphQL\Queries\CountriesTypes;

use App\Models\CMEProduct;

final class CMEProductPrices
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $cmePs= CMEProduct::whereHas('country_types')->with('country_types')->get();
       foreach($cmePs as $cmep){
        $cmep->usd=config('variables.currency_rate')*$cmep->price;
        $cmep->usd_percertificate=config('variables.currency_rate')*$cmep->per_certificate_price;
       }
       return $cmePs;
    }
}
