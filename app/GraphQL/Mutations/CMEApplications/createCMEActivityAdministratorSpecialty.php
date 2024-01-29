<?php

namespace App\GraphQL\Mutations\CMEApplications;

use App\Models\CMEActivityAdministratorSpecialty;
use Illuminate\Support\Facades\Auth;

final class createCMEActivityAdministratorSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        CMEActivityAdministratorSpecialty::where('cme_application_id',$args['cme_application_id'])->delete();

        foreach($args['activity_types'] as $activity_type){
            $cmeALF=new CMEActivityAdministratorSpecialty();
            $cmeALF->cme_application_id=$args['cme_application_id'];
            $cmeALF->model_id=$activity_type;
            $cmeALF->model_type=$args['model_type'];
            $cmeALF->created_by=Auth::id();
            $cmeALF->save();
        }
        return 'done';
    }
}
