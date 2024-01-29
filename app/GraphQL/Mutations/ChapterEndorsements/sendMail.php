<?php

namespace App\GraphQL\Mutations\ChapterEndorsements;

use App\Jobs\ChapterEnndorsementMail;

final class sendMail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        dispatch(new ChapterEnndorsementMail($args['user_id'], $args['chapter_id']));

        return "done";
    }
}
