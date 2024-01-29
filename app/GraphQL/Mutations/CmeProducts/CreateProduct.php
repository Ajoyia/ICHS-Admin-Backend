<?php

namespace App\GraphQL\Mutations\CmeProducts;
use App\Models\ProductCountryTypeListing;
use App\Models\CMEProduct;
use Auth;

final class CreateProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user= Auth::user();
        $product=CMEProduct::create([
            'product_id' => $args['product_id'],
            'description' => $args['description'],
            'price' => $args['price'],
            'hour_from' => $args['hour_from'],
            'hour_to'=> $args['hour_to'],
            'per_certificate_price'=> $args['per_certificate_price'],
            'tax_group_id' => $args['tax_group_id'],
            'is_published' => $args['is_published'],
            'status' => $args['status'],
            'created_by'=> $user->id,
            'updated_by'=> $user->id,
        ]);
    
        $model_types=json_decode($args['countries'],true);
        $syncData=[];    
        foreach($model_types as $type)
        {
            $syncData[]=['cme_product_id'=>$product->id,
                         'country_type_id'=>$type['id'],
                        
                         'created_by'=>$user->id,
                         'updated_by'=>$user->id,
                         ];
        }
        if(count($syncData) >0)
        {
           ProductCountryTypeListing::insert($syncData);
        }
    
        return $product;

    }
}
