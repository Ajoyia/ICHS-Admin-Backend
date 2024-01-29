<?php

namespace App\GraphQL\Mutations\Journals;

use App\Models\JournalApplication;
use Carbon\Carbon;

final class ReviewRequiredJICHS
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    
    public function __invoke($_, array $args)
    {
        $hii= JournalApplication::find($args['id']);
        
        $hii->status_id = 9;
        $hii->no_of_reviews_requested = $hii->no_of_reviews_requested + 1;
        $hii->review_requested_time = Carbon::now();
        $hii->save();

        return $hii;
      

    }

   


}
