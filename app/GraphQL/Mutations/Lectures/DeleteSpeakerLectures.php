<?php
namespace App\GraphQL\Mutations\Lectures;

use App\Models\IvlnSpeakersLecture;

final class DeleteSpeakerLectures
{
    public function __invoke($_, array $args)
    {
        $response=IvlnSpeakersLecture::where('lecture_id',$args['lecture_id'])->where('speaker_id',$args['speaker_id'])->delete();
        return json_encode($response);
    }
}
