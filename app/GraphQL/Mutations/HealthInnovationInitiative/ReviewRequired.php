<?php

namespace App\GraphQL\Mutations\HealthInnovationInitiative;

use App\Models\HealthInnovationInitiative;
use Carbon\Carbon;

final class ReviewRequired
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    
    public function __invoke($_, array $args)
    {
        $hii= HealthInnovationInitiative::find($args['id']);
        
        $hii->statuses_id = 9;
        $hii->no_of_reviews_requested = $hii->no_of_reviews_requested + 1;
        $hii->review_requested_time = Carbon::now();
        $hii->save();

        return $hii;
      

    }

   


}
