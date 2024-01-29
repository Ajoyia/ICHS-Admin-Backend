<?php

namespace App\GraphQL\Mutations\ProfileCards;

use App\Models\ProfileCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class CreateProfileCard
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info($args);
        $image = $args['image'];
        $imagePath="";
        if($image!=null){
            $imagePath =  Storage::putFile('/profile_cards/images',$args['image']);
        }

        $profileCard=new ProfileCard();
        $profileCard->image = $imagePath;
        $profileCard->name = $args['name'];
        $profileCard->detail = $args['detail'];
        $profileCard->category_id = $args['category_id'];
        $profileCard->country_id= $args['country_id'];
        $profileCard->job_title= $args['jobTitle'];
        $profileCard->designation= $args['designation'];
        $profileCard->credentails = $args['credentials'];
        if(isset($args['speciality_id'])&&$args['speciality_id'])
            $profileCard->speciality_id=$args['speciality_id'];
        $profileCard->created_by = Auth::id();
        $profileCard->save();
        return $profileCard;
    }
}
