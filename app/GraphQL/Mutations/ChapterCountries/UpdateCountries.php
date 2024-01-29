<?php

namespace App\GraphQL\Mutations\ChapterCountries;
use Illuminate\Support\Facades\DB;

final class UpdateCountries
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $country_ids = $args['country_id'];
        foreach($country_ids as $country_id){
            DB::table('chapter_countries')->insert([
                'country_id' => $country_id,
                'chapter_id' => $args['chapter_id']
            ]);
        }
        return "done";
    }
}
