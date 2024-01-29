<?php

namespace App\GraphQL\Mutations\CountryTypes;
use App\Models\CountriesTypesListing;


final class DeleteCountries
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        CountriesTypesListing::where('country_id',$args['country_id'])
                            ->where('country_type_id',$args['country_type_id'])
                            ->delete();
        return "done";
    }
}