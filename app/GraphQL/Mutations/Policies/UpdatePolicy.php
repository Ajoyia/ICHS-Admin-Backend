<?php

namespace App\GraphQL\Mutations\Policies;

use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdatePolicy
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // Log::info($args);
        $policy=Policy::where('id',$args['slug'])->first();
        $json_array = array();
        $policy->name=$args['name'];
        $policy->description = $args['description'];
        $policy->is_deleteable = $args['is_deleteable'];
        $policy->slug = Str::slug($args['name']);
        $chkP = Policy::where('slug', $policy->slug)->get();
        if (count($chkP)) {
            $policy->slug = $policy->slug . '-' . Policy::max('id') + 1;
        }
        if($args['is_volunteer'] == 1)
        {
            foreach ($args['time_breakup'] as $time_breakup) {
                array_push($json_array, [
                    'description' => $time_breakup->description,
                    'hours' => $time_breakup->hours,
                ]);
            }
            $policy->is_volunteer = 1;
            $policy->hours = $args['hours'];
            $policy->time_breakup = json_encode($json_array);
        }else{
            $policy->is_volunteer = 0;
            $policy->hours = null;
            $policy->time_breakup = null;
        }
        $policy->is_guest=$args['is_guest'];
        $policy->created_by=Auth::id();
        $policy->save();
        return $policy;
    }
}