<?php

namespace App\GraphQL\Mutations\CMEApplications;

use Illuminate\Support\Facades\Auth;
use App\Models\CMEApplicationLearningFormat;

final class updateCMEApplicarionLearningFormats
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cmeSEs=CMEApplicationLearningFormat::where('cme_application_id',$args['id'])->delete();
        foreach($args['learning_formats'] as $learningFormat){
            $cmeALF=new CMEApplicationLearningFormat();
            $cmeALF->cme_application_id=$args['id'];
            $cmeALF->cme_learning_formate_id=$learningFormat;
            $cmeALF->created_by=Auth::id();
            $cmeALF->save();
        }
        return 'done';
    }
}
