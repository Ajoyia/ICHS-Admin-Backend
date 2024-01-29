<?php

namespace App\GraphQL\Queries\JICHS;

use App\Models\CMEApplication;
use App\Models\JournalApplication;
use App\Models\Specialty;

final class PendingJournals
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_applications = JournalApplication::where('status_id', '!=' , 6)->where('status_id', '!=', 7);
        return $cme_applications;
    }
   
}
