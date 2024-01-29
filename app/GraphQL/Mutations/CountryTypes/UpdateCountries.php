<?php

namespace App\GraphQL\Mutations\CountryTypes;
use App\Models\CountriesTypesListing;


final class UpdateCountries
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $country_ids = $args['country_id'];
        $country_type_id=$args['country_type_id'];
        foreach($country_ids as $country_id){
            $up=new CountriesTypesListing();
            $up->country_id = $country_id;
            $up->country_type_id=$country_type_id;
            $up->save();
        }
        return "done";
    }
}
