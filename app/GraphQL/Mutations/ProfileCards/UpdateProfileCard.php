<?php

namespace App\GraphQL\Mutations\ProfileCards;

use App\Models\ProfileCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class UpdateProfileCard
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $image = $args['image'];

        $profileCard = ProfileCard::find($args['id']);
        $profileCard->name = $args['name'];
        $profileCard->detail = $args['detail'];
        $profileCard->category_id = $args['category_id'];
        $profileCard->country_id=$args['country_id'];
        $profileCard->job_title=$args['jobTitle'];
        $profileCard->designation=$args['designation'];
        $profileCard->credentails=$args['credentials'];
        $profileCard->updated_by= Auth::id();
        if($image!=null){
            $profileCard->image =  Storage::putFile('/profile_cards/images',$args['image']);
        }
        if(isset($args['speciality_id'])&&$args['speciality_id'])
            $profileCard->speciality_id=$args['speciality_id'];
        $profileCard->save();
    }
}
