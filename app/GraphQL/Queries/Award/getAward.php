<?php

namespace App\GraphQL\Queries\Award;

use App\Models\Award;

final class getAward
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $award = Award::where('is_voting_allowed' , 1)->first();
        return $award;
    }
   
}
