<?php

namespace App\GraphQL\Mutations\AccredationApplications;

use Illuminate\Support\Facades\Auth;
use App\Models\AccredationApplicationLearningFormat;

final class updateAccredationApplicationLearningFormats
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cmeSEs=AccredationApplicationLearningFormat::where('acc_id',$args['id'])->delete();
        foreach($args['learning_formats'] as $learningFormat){
            $cmeALF=new AccredationApplicationLearningFormat();
            $cmeALF->acc_id=$args['id'];
            $cmeALF->acc_format_id=$learningFormat;
            $cmeALF->created_by=Auth::id();
            $cmeALF->save();
        }
        return 'done';
    }
}
