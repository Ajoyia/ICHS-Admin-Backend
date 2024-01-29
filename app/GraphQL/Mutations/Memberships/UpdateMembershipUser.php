<?php

namespace App\GraphQL\Mutations\Memberships;
use App\Models\User;
use App\Models\Membership;
use App\Models\UserExperience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class UpdateMembershipUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // DB::beginTransaction();
        try {
            // $user = Auth::user();
            // $user->first_name=$args['first_name'];
            // $user->last_name=$args['last_name'];
            // $user->mobile_no=$args['mobile_no'];
            // $user->country_code=$args['country_code'];
            // $user->address=$args['address'];
            // $user->university=$args['university'];
            // $user->department=$args['department'];
            // $user->city_id=$args['city_id'];
            // $user->nationality_id=$args['nationality_id'];
            // $user->country_id=$args['country_id'];
            // $user->save();
            $user_experiences=json_decode($args['user_experiences'],true);
            UserExperience::where('user_id',$args['user_id'])->delete();
            for($i=0;$i<count($user_experiences);$i++){
                $userExperiences=new UserExperience();
                $userExperiences->user_id= Auth::id();
                $userExperiences->company_name=$user_experiences[$i]["company_name"];

                $userExperiences->jobs_responsibility=$user_experiences[$i]["jobs_responsibility"];
                $userExperiences->start_date=$user_experiences[$i]["start_date"];
                $userExperiences->end_date=$user_experiences[$i]["end_date"];
                $userExperiences->save();
            }
            // $this->createSpeciality($args);
            // DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }
        return "done";
    }
    // public function createSpeciality(array $args)
    // {
    //     $user = Auth::user();
    //     if(!is_null($user)){
    //         \DB::table('user_specialties')->where('user_id', Auth::id())->delete();
    //     }
    //     foreach($args['speciality_id'] as $sp){
    //         $array = explode(',', $sp);
    //         foreach($array as $speciality){
            
    //             \DB::table('user_specialties')->insert(
    //                 ['user_id'=>Auth::id(), 'speciality_id'=>$speciality]
    //             );
    //         }
    //     }
    // }
}
