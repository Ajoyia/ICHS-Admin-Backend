<?php

namespace App\GraphQL\Mutations\CMESessionSpeakers;

use App\Models\CMESession;
use App\Models\CMESessionSpeaker;

final class CreateCMESessionSpeaker
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $session_speaker = CMESessionSpeaker::create([
            'role_id' => $args['role_id'],
            'cme_application_id' => $args['cme_application_id'],
            'cme_speakers_id' => $args['cme_speakers_id'],
            'model_id' => $args['model_id'],
            'model_type' => 'App\Models\CMESession'
        ]);

        return $session_speaker;
    }
}
