<?php
namespace App\GraphQL\Mutations\Lectures;

use App\Models\IvlnSpeaker;
final class GetSpeakerLectures
{
    public function __invoke($_, array $args)
    {
        $getSpeakerLectures=IvlnSpeaker::whereHas('lectureSpeakers',function($q) use($args){
            $q->where('lecture_id', $args['lecture_id'] );
        })->where('status',1)->get();
        return json_encode($getSpeakerLectures);
    }
}
