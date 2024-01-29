<?php

namespace App\GraphQL\Mutations;

use App\Models\CMEApplicationTargetAudience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class TargetSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info($args);
        $user =  CMEApplicationTargetAudience::find($args['target_audience_id']); 
        if(!is_null($user)){
            DB::table('target_audience_specialties')->where('target_audience_id', $args['target_audience_id'])->delete();
        }
            foreach($args['speciality_id'] as $speciality){
            
                DB::table('target_audience_specialties')->insert(
                    ['target_audience_id'=>$args['target_audience_id'], 'speciality_id'=>$speciality]
                );
            }
        
        return "done";
    }
}