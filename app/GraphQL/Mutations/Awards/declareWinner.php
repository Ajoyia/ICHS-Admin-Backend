<?php

namespace App\GraphQL\Mutations\Awards;

use App\Models\AwardNominee;
use Illuminate\Support\Facades\Auth;

final class declareWinner
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $nominee = AwardNominee::find($args['nominee_id']);
        $nominee->is_winner = 1;
        $nominee->updated_by = Auth::id();

        $nominee->save();

        AwardNominee::where('id','!=', $args['nominee_id'])
                    ->where('award_type_id', $args['award_type_id'])
                    ->where('award_id', $args['award_id'])
                    ->update(['is_winner' => 0]);

        return $nominee;
    }
}
