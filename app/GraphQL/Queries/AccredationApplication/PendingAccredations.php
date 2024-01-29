<?php

namespace App\GraphQL\Queries\AccredationApplication;

use App\Models\AccredationApplication;

final class PendingAccredations
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_applications = AccredationApplication::where('status_id', '!=' , 6)->where('status_id', '!=', 7);
        return $cme_applications;
    }
   
}
