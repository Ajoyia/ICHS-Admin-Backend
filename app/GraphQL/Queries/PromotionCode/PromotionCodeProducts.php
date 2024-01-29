<?php

namespace App\GraphQL\Queries\PromotionCode;
use App\Models\Product;

final class PromotionCodeProducts
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       /* get memebership products */
       $products=Product::with(['productCountryTypes'=>function($q){
            $q->with(['country_type','membershipTypes']);
        },'cme_products.country_types','packages'])->get();

       $options=[];
       foreach($products as $product)
       {
           /* for membership products */
            if(count($product->productCountryTypes)  >0)
            {
                $childProducts=[];
                foreach($product->productCountryTypes as $child)
                {
                   $childProducts[]=['name' => "{$product->name}, {$child->description}",
                                     'model' => get_class($child),
                                     'model_id' => $child->id];
                }
                 $options[]=['product'=>$product->name,'libs' => $childProducts];
            }

            /* for cme products */
            if(count($product->cme_products)  >0)
            {
                $childProducts=[];
                foreach($product->cme_products as $child)
                {
                       $country_type=($child->country_types && count($child->country_types) > 0 ? ', ('.$child->country_types->pluck('name')->implode(',').')' : '');
                       $childProducts[]=['name' => $product->name.$country_type,
                                         'model' => get_class($child),
                                         'model_id' => $child->id];

                }
                 $options[]=['product'=>$product->name,'libs' => $childProducts];
            }


             /* for cme products */
            if(count($product->packages)  >0)
            {
                $journalProducts=[];
                $hiiProducts=[];
                foreach($product->packages as $child)
                {
                       /* journal */
                       if($product->link_product==3)
                       {

                              $journalProducts[]=['name' => "{$product->name}, ($child->label)",
                                         'model' => get_class($child),
                                         'model_id' => $child->id];
                       }
                       /* HII */
                       if($product->link_product==4)
                       {
                            $hiiProducts[]=['name' =>  "{$product->name}, ($child->label)",
                                         'model' => get_class($child),
                                         'model_id' => $child->id];
                       }


                }
                 $options[]=['product'=>$product->name,'libs' => $journalProducts];
                 $options[]=['product'=>$product->name,'libs' => $hiiProducts];
            }


       }

       return json_encode($options);
    }
}
