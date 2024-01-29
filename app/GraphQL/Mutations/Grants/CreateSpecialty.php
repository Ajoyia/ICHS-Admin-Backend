<?php

namespace App\GraphQL\Mutations\Grants;

use App\Models\Grant;
use Illuminate\Support\Facades\DB;

final class CreateSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user =  Grant::find($args['grant_id']); 
        if(!is_null($user)){
            DB::table('grant_specialties')->where('grant_id', $args['grant_id'])->delete();
        }
        foreach($args['speciality_id'] as $speciality){
        
            DB::table('grant_specialties')->insert(
                ['grant_id'=>$args['grant_id'], 'speciality_id'=>$speciality]
            );
        }
        return "done";
    }
}
