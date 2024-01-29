<?php

namespace App\GraphQL\Mutations\ChapterCountries;
use Illuminate\Support\Facades\DB;

final class DeleteCountries
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        DB::table('chapter_countries')->where('country_id', $args['country_id'])
                                ->where('chapter_id', $args['chapter_id'])
                                ->delete();
        return "done";
    }
}