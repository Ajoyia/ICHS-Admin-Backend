<?php

namespace App\GraphQL\Mutations\Memberships;

use App\Models\User;
use App\Models\Membership;
use App\classes\calculateTax;
use App\classes\generateInvoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class CreateMembership
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info('idr hi hon');
        if(Auth::user()->memberships){
            $membership=Auth::user()->memberships;
        }
        else if(Auth::user()->expiredMembership){
            Log::info('Auth::user()->expiredMembership');
            $membership=Auth::user()->expiredMembership;
        }
        else{
            Log::info('else');
            $membership = new Membership();
        }
        $membership->user_id = $args['user_id'];
        if($args['resume'])
            $membership->resume = Storage::putFile('/memberships/resumes',$args['resume']);
        $membership->product_country_type_id = $args['product_country_type_id'];
        $membership->membership_type_id = $args['membership_type_id'];
        $membership->medical_facility = $args['medical_facility'];
        $membership->medical_interests = $args['medical_interests'];
        $membership->status = $args['status'];
        Log::info('aqdasdasdasd');
        Log::info($args['membership_type_id']);
        if($args['membership_type_id']==3){
            $user=User::find(Auth::user()->id);
            $user->require_update=0;
            $user->save();
        }
        $membership->save();

        $user_id = $membership->user_id;
        $model_type = 'App\Models\Membership';
        $model_id = $membership->id;
        $product_id = $membership->product_country_type->id;
        $status = '1';
        $product_name = $membership->product_country_type->product->name;
        $taxes = $membership->product_country_type->tax_group->taxes;
        $net_amount = $membership->product_country_type->price;

        $tax = new calculateTax();
        $payload = $tax->calculateTaxAmount($taxes,$net_amount,$product_name,0);

        $invoice = new generateInvoice();
        $invoice->generateInvoice($user_id,$model_type,$model_id,$status,$payload);


        return $membership;
    }
}
