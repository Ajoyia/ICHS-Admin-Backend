<?php

namespace App\GraphQL\Mutations\Volunteers;

use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdateVolunteer
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $volunteer=Volunteer::find($args['id']);
        if($args['is_approved'] == 1){
           $is_exist =  DB::table('user_policies')
            ->where('user_id', $volunteer->user_id)
            ->where('policy_id', $volunteer->policy_id)
            ->first();
            if($is_exist === null){
                DB::table('user_policies')->insert([
                     'user_id' => $volunteer->user_id,
                     'policy_id' => $volunteer->policy_id
                 ]);
            }

        }
        $volunteer->is_approved = $args['is_approved'];
        $volunteer->save();
        return $volunteer;
    }
}