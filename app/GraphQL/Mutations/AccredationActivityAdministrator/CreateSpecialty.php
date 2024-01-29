<?php

namespace App\GraphQL\Mutations\AccredationActivityAdministrator;

use App\Models\AccredationActivityAdministrator;
use App\Models\CMEActivityAdministrator;
use Illuminate\Support\Facades\DB;

final class CreateSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user =  AccredationActivityAdministrator::find($args['activity_id']); 
        if(!is_null($user)){
            DB::table('acc_admin_specialties')->where('activity_id', $args['activity_id'])->delete();
        }
        foreach($args['speciality_id'] as $speciality){
        
            DB::table('acc_admin_specialties')->insert(
                ['activity_id'=>$args['activity_id'], 'speciality_id'=>$speciality]
            );
        }
        return "done";
    }
}
