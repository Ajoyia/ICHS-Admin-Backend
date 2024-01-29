<?php

namespace App\GraphQL\Queries;

use App\Models\CMEApplication;
use App\Models\Specialty;

final class PendingCMEApplications
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_applications = CMEApplication::where('statuses_id',1);
        return $cme_applications;
    }
   
}
