<?php

namespace App\GraphQL\Mutations\AccredationApplications;

use App\Models\AccredationApplication;
use App\Models\AccredationProduct;
use App\Models\CountriesTypesListing;

final class saveProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $country = CountriesTypesListing::where('country_id',$args['country_id'])->first();
       $product = AccredationProduct::where('country_type_id', $country->country_type_id)->first();
        $acc_app = AccredationApplication::find($args['id']);
        $acc_app->accredation_product_id = $product->id;
        $acc_app->save();

        return 'done';
    }
}
