<?php

namespace App\GraphQL\Queries\HealthInnovationInitiative;

use App\Models\HealthInnovationInitiative;

final class PendingHII
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_applications = HealthInnovationInitiative::where('statuses_id', '!=' , 6)->where('statuses_id', '!=', 7);
        return $cme_applications;
    }
   
}
