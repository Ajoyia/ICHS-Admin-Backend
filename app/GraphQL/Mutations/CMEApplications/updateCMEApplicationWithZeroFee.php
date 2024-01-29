<?php

namespace App\GraphQL\Mutations\CMEApplications;

use App\Jobs\CMESuccessMail;
use App\Models\CMEApplication;

final class updateCMEApplicationWithZeroFee
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */

    public function __invoke($_, array $args)
    {
        $completion_form = CMEApplication::find($args['id']);
        $completion_form->statuses_id = 1;
        $completion_form->save();
        dispatch(new CMESuccessMail($completion_form->id));
        return 'done';
    }
}



