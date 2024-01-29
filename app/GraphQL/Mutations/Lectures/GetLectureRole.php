<?php
namespace App\GraphQL\Mutations\Lectures;

use App\Models\SpeakerRole;

final class GetLectureRole
{
    public function __invoke($_, array $args)
    {
        $getLectureRole=SpeakerRole::whereHas('lectureRoles',function($q) use($args){
            $q->where('lecture_id', $args['lecture_id'] );
        })->where('status',1)->get();
        return json_encode($getLectureRole);
    }
}
