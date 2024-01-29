<?php

namespace App\GraphQL\Mutations\ChapterEndorsements;

use App\Jobs\ChapterEnndorsementMail;
use App\Models\AutomatedNotification;
use App\Models\Chapter;
use App\Models\ChapterEndorsement;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\DefaultNotification;

final class createChapterEndorsement
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        foreach($args['user_id'] as $user_id){
            ChapterEndorsement::create([
                'user_id' => $user_id,
                'chapter_id' => $args['chapter_id']
            ]);
        }
        dispatch(new ChapterEnndorsementMail($args['user_id'], $args['chapter_id']));

        return "done";
    }
}
