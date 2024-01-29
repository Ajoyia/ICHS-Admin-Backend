<?php

namespace App\GraphQL\Mutations\AccredationActivityTime;

use App\Models\AccredationActivityTime;
use Illuminate\Support\Facades\Auth;

final class createAccredationActivityTime
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
 
        $at=new AccredationActivityTime();
        $at->start_time=$args['start_time'];
        $at->end_time=$args['end_time'];
        $at->accredation_application_id=$args['cme_application_id'];
        $at->created_by=Auth::id();
        $at->save();
        return 'done';

    }
   
}
