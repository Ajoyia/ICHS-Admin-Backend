<?php

namespace App\GraphQL\Mutations\CountryTypes;
use App\Models\CountriesTypesListing;
use App\Models\CountriesType;

final class DeleteCountryType
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        CountriesTypesListing::where('country_type_id',$args['id'])->delete();
        CountriesType::find($args['id'])->delete();
        return "done";
    }
}