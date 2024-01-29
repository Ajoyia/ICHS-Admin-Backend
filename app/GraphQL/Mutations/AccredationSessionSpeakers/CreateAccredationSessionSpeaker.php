<?php

namespace App\GraphQL\Mutations\AccredationSessionSpeakers;

use App\Models\AccredationSessionSpeaker;

final class CreateAccredationSessionSpeaker
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $session_speaker = AccredationSessionSpeaker::create([
            'role_id' => $args['role_id'],
            'acc_id' => $args['acc_id'],
            'acc_speakers_id' => $args['acc_speakers_id'],
            'model_id' => $args['model_id'],
            'model_type' =>$args['model_type']
        ]);

        return $session_speaker;
    }
}
