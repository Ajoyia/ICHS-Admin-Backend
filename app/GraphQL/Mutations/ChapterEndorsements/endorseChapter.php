<?php

namespace App\GraphQL\Mutations\ChapterEndorsements;

use App\Jobs\ChapterEnndorsementMail;
use App\Models\AutomatedNotification;
use App\Models\Chapter;
use App\Models\ChapterEndorsement;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;

final class endorseChapter
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $chapter_endorsement = ChapterEndorsement::find($args['chapter_id']);

        // Update the record with new data
        $chapter_endorsement->update([
            'is_endorsed' => 1,
            'endorsed_date' => Carbon::now()
        ]);
        return "done";
    }
}
