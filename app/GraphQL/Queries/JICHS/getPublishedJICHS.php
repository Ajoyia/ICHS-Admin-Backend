<?php

namespace App\GraphQL\Queries\JICHS;

use App\Models\JournalApplication;
use Carbon\Carbon;;

final class getPublishedJICHS
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $hiis = JournalApplication::where('publish_date', '<=', Carbon::now())->orderBy('id', 'desc')->limit(3)->get();
        return $hiis;
    }
}
