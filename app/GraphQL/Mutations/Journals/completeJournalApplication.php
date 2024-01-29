<?php

namespace App\GraphQL\Mutations\Journals;

use App\Models\JournalApplication;
use Illuminate\Support\Facades\Auth;
use App\Models\HIIType;
use Carbon\Carbon;

final class completeJournalApplication
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $hii = JournalApplication::find($args['id']);
        $hii->is_approved_london_office = 1;
        $hii->status_id = 7;
        $hii->publish_date = Carbon::now();
        $hii->save();
        return "done";
    }
}
