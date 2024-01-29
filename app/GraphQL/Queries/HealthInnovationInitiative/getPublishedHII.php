<?php

namespace App\GraphQL\Queries\HealthInnovationInitiative;

use App\Models\HealthInnovationInitiative;
use Carbon\Carbon;;

final class getPublishedHII
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $hiis = HealthInnovationInitiative::where('publish_date' ,'<=', Carbon::now())->orderBy('id', 'desc')->limit(3)->get();
        return $hiis;
    }
}
