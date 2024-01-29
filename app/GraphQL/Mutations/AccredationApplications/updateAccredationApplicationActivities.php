<?php

namespace App\GraphQL\Mutations\AccredationApplications;

use App\Models\AccredationApplicationActvity;
use Illuminate\Support\Facades\Auth;
use App\Models\AccredationApplicationLearningFormat;

final class updateAccredationApplicationActivities
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        AccredationApplicationActvity::where('acc_id',$args['id'])->delete();
        
        foreach($args['activity_types'] as $learningFormat){
            $cmeALF=new AccredationApplicationActvity();
            $cmeALF->acc_id=$args['id'];
            $cmeALF->acc_activity_id=$learningFormat;
            $cmeALF->created_by=Auth::id();
            $cmeALF->save();
        }
        return 'done';
    }
}
