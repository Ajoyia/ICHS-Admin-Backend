<?php

namespace App\GraphQL\Queries\Award;

use App\Models\AwardNominee;

final class getCurrentAwardNominees
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $award = AwardNominee::where('award_id' , $args['award_id'])->where('award_type_id', $args['award_type_id'])->orderBy('is_winner','DESC');
        return $award;
    }
   
}
