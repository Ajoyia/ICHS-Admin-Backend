<?php

namespace App\classes;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Membership;
use App\Models\UserPolicy;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class membershipHandler{
    public function assignMembership($userId,$inv=null,$membershipId=null){
        $now = Carbon::now();

        $up = new UserPolicy();
        $up->policy_id = 4;
        $up->user_id = $userId;
        $up->save();
        if(!is_null($inv))
            $membership = Membership::find($inv->model_id);
        else if(!is_null($membershipId))
            $membership = Membership::find($membershipId);
        $productCountryType=ProductCountryType::where('id',$membership->product_country_type_id)->first();

        $membership->status = 1;
        $membership->membership_id = $now->year.'-ICHS-'.$membership->id;

        $start_date=Carbon::now()->toDateTimeString();
        if(!$membership->start_date)
            $membership->start_date=$start_date;
        if(is_null($inv)||($productCountryType->memberhsip_type_id==3&&$inv->total_amount==$productCountryType->price)||$productCountryType->memberhsip_type_id!=3){
            if($productCountryType->type=='yearly'){
                if(is_null($membership->end_date)){
                    $end_date=Carbon::now()->addYears($membership->product_country_type->validity)->toDateTimeString();
                    $membership->end_date=$end_date;
                }
                else{
                    $end_date=(new Carbon($membership->end_date))->addYears($membership->product_country_type->validity)->toDateTimeString();
                    $membership->end_date=$end_date;
                }
            }else if($productCountryType->type=='monthly'){
                if(is_null($membership->end_date)){
                    $end_date=Carbon::now()->addMonths($membership->product_country_type->validity)->toDateTimeString();
                    $membership->end_date=$end_date;
                    $membership->status=1;
                }
                else{
                    $end_date=(new Carbon($membership->end_date))->addMonths($membership->product_country_type->validity)->toDateTimeString();
                    $membership->end_date=$end_date;
                }
            }else if($productCountryType->type=='expired_on'){
                $membership->end_date=$membership->product_country_type->expire_on;
                $membership->status=1;
            }
            if($membership->membership_type_id==3){
                if(!is_null($inv)){
                    Log::info('net='.$inv->total_amount.' p='.($productCountryType->price*($productCountryType->percentage_required/100)));
                    if($inv->total_amount>($productCountryType->price*($productCountryType->percentage_required/100))){
                        $u=$membership->user;
                        $u->require_update=3;
                        $u->save();
                    }
                    else{
                        $u=$membership->user;
                        $u->require_update=2;
                        $u->save();
                    }
                }else{
                    $u=$membership->user;
                    $u->require_update=3;
                    $u->save();
                }
            }
            $membership->save();
    }
}
}
