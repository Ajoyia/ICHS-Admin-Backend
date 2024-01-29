<?php

namespace App\GraphQL\Mutations\ChapterUsers;
use Illuminate\Support\Facades\DB;

final class UpdateUsers
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $data = [
            'user_id' => $args['user_id'],
            'chapter_id' => $args['chapter_id'],
        ];
        $chapter_user = DB::table('chapter_users')
                        ->where('user_id', $args['user_id'])
                        ->where('chapter_id', $args['chapter_id'])
                        ->first();

        if ($chapter_user === null)
            DB::table('chapter_users')->insert($data);

    
    }
}
