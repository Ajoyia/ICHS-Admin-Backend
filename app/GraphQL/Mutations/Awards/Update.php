<?php

namespace App\GraphQL\Mutations\Awards;

use App\Models\Award;
use Illuminate\Support\Facades\Auth;

final class Update
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $award = Award::find($args['id']);
        if (isset($args['title'])) {
            $award->title = $args['title'];
        }
        if (isset($args['description'])) {
            $award->description = $args['description'];
        }

        if (isset($args['award_date'])) {
            $award->award_date = $args['award_date'];
        }

        if (isset($args['is_voting_allowed'])) {
            $award->is_voting_allowed = $args['is_voting_allowed'];
        }

        if (isset($args['is_show_result'])) {
            $award->is_show_result = $args['is_show_result'];
        }

        $award->updated_by = Auth::id();

        $award->save();

        if ($args['is_show_result'] == 1) {
            Award::where('id', '!=', $award->id)->update(['is_show_result' => 0]);
        }

        if ($args['is_voting_allowed'] == 1) {
            Award::where('id', '!=', $award->id)->update(['is_voting_allowed' => 0]);
        }
        
        
        
        return $award;
    }
}
