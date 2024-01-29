<?php
namespace App;
use Illuminate\Support\Facades\Log;

class SearchCountryTypeOfAProduct {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('countries_type','product_country_type.country_type_id','=','countries_type.id')
        //     ->where('product_country_type.description','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('product_country_type.price','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('countries_type.name','like',$whereConditions['OR'][0]['value']);
    }
}
