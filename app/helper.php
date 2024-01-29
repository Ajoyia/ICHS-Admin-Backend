<?php

use App\Services\PromotionCodeService;

  function getPriceWithPromoCode($promo_code_id,$price)
 {
    if($promo_code_id!=null)
    {
         $array['amount']=$price;
         $obj= new PromotionCodeService($array,$promo_code_id);
         $response=$obj->retrunMessage();

         if($response['status']==true)
         {
             if($response['discount_type']=='value')
             {
                 $discount=$price-$response['discount'];
                 
                 return ['price'=>$price,'discount'=>$response['discount'],'discounted_price'=>$discount];
             }else{
                 return ['price'=>$price,'discount'=>$response['discount'],'discounted_price'=>$price-$response['discount']]; 
             }
         }
     }
     return ['price'=>$price,'discount'=>0,'discounted_price'=>$price];
 }
?>