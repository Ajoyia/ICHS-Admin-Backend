<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class SpecialityResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // \Log::info($args['speciality_id']);
        // die();
        $user =  User::find($args['user_id']);
        if(!is_null($user)){
            \DB::table('user_specialties')->where('user_id', $args['user_id'])->delete();
        }
        // foreach($args['speciality_id'] as $sp){
            // $array = explode(',', $sp);
            foreach($args['speciality_id'] as $speciality){

                \DB::table('user_specialties')->insert(
                    ['user_id'=>$args['user_id'], 'speciality_id'=>$speciality]
                );
            }
        // }
        return "done";
        // TODO implement the resolver
    }
}
