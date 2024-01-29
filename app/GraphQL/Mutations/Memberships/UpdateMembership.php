<?php

namespace App\GraphQL\Mutations\Memberships;
use App\Models\Membership;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class UpdateMembership
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // $file = $args['resume'] ;

        $membership = Membership::find($args['id']);
        // if(array_key_exists('user_id', $args)  ){
        //     $membership->user_id = $args['user_id'];
        // }
        // if($file!=null){
        //     $membership->resume = Storage::putFile('/memberships/resumes',$args['resume']);
        // }
        // if(array_key_exists('resume', $args)  ){
        //     return 'hello';
        //     $membership->resume = Storage::putFile('/memberships/resumes',$args['resume']);
        // }
        if($args['product_country_type_id']!=null){
            $product_country_type = ProductCountryType::where('id',$args['product_country_type_id'])->first();
            $membership->membership_type_id = $product_country_type->membership_type_id;
            $membership->product_country_type_id = $args['product_country_type_id'];
            $membership->save();
        }
        // $membership->membership_type_id = $args['membership_type_id'];
        // if(array_key_exists('medical_facility', $args)  ){
        //     $membership->medical_facility = $args['medical_facility'];
        // }
        // if(array_key_exists('medical_interests', $args)){
        //     $membership->medical_interests =$args['medical_interests'];
        // }
        // $membership->status = $args['status'];

        return $membership;
    }
}
