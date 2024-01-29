<?php

namespace App\GraphQL\Mutations\HealthInnovationInitiative;

use App\Models\HealthInnovationInitiative;
use Illuminate\Support\Facades\Auth;
use App\Models\HIIType;
use Carbon\Carbon;

final class completeHIIApplication
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $hii = HealthInnovationInitiative::find($args['id']);
        $hii->is_approved_london_office = 1;
        $hii->statuses_id = 7;
        $hii->publish_date = Carbon::now();
        $hii->save();
        return "done";
    }
}
