<?php

namespace App\GraphQL\Mutations\PromoCode;
use App\Models\PromotionCodeProduct;
use App\Models\PromotionCode;
use Auth;
final class UpdatePromoCode
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user= Auth::user();
        $promo_code=PromotionCode::where('id',$args['id'])
                      ->update(['promotion_type'=>$args['promotion_type'],
                                'value'=>$args['value'],
                                'promotion_code'=>$args['promotion_code'],
                                'usage_limit'=>$args['usage_limit'],
                                'error_message_line1'=>$args['error_message_line1'],
                                'error_message_exceeded'=>$args['error_message_exceeded'],
                                'approved_by'=>$args['approved_by'],
                                'valid_from'=>$args['valid_from'],
                                'valid_to'=>$args['valid_to'],
                                'description'=>$args['description'],
                                'status'=>$args['status'],
                                'updated_by'=>$user->id,
                                ]
                              );

        PromotionCodeProduct::where('promotion_code_id','=',$args['id'])->update(['deleted_at'=>now()]);
        $promotionCodeProduct=$args['promotionCodeProduct'];
        $model_types=json_decode($promotionCodeProduct,true);
        $syncData=[];    
        foreach($model_types as $type)
        {
            $syncData[]=['model_type'=>$type['model'],
                         'model_id'=>$type['model_id'],
                         'promotion_code_id'=>$args['id'],
                         'created_by'=>$user->id,
                         'updated_by'=>$user->id,
                         ];
        }
        if(count($syncData) >0)
        {
           PromotionCodeProduct::insert($syncData);
        }
        return PromotionCode::where('id',$args['id'])->first();
    }
}
