<?php

namespace App\GraphQL\Mutations\Users;
use Log;
use App\Models\User;
use App\Models\FileManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class UpdateUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // Log::info($args['image']);
        $user = User::find($args['id']);

        if(isset($args['image'])){
            $file = $args['image'];
            if($file!=null){
                $user->image =  Storage::putFile('/user_profile/images',$args['image']);
            }
        }
        if(isset($args["other_specialty"])){
            $user->other_specialty = $args["other_specialty"];
        }
        if(isset($args["salutation_id"])){
            $user->salutation_id = $args["salutation_id"];
        }
        if(isset($args["first_name"])){
            $user->first_name = $args["first_name"];
        }
        if(isset($args["last_name"])){
            $user->last_name = $args["last_name"];
        }
        if(isset($args["organization"])){
            $user->organization = $args["organization"];
        }
        if(isset($args["mobile_no"])){
            $user->mobile_no = $args["mobile_no"];
        }
        if(isset($args["address"])){
            $user->address = $args["address"];
        }
        if(isset($args["city_id"])){
            $user->city_id = $args["city_id"];
        }
        if(isset($args["state_id"])){
            $user->state_id = $args["state_id"];
        }
        if(isset($args["country_id"])){
            $user->country_id = $args["country_id"];
        }
        if(isset($args["nationality_id"])){
            $user->nationality_id = $args["nationality_id"];
        }
        if(isset($args["job_title"])){
            $user->job_title = $args["job_title"];
        }
        if(isset($args["department"])){
            $user->department = $args["department"];
        }
        if(isset($args["university"])){
            $user->university = $args["university"];
        }
        if(isset($args["type"])){
            $user->type = $args["type"];
        }
        if(isset($args["time_zone_id"])){
            $user->time_zone_id = $args["time_zone_id"];
        }
        $user->updated_by = Auth::id();
        $user->save();
        return $user;
    }
}
