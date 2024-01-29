<?php
namespace App\GraphQL\Mutations\Lectures;

use App\Models\IvlnSpeaker;
use App\Models\IvlnSpeakersLecture;
use App\Models\Lecture;
use App\Models\SpeakerRole;

final class CreateSpeakerLectures
{
    public function __invoke($_, array $args)
    {
        $exist=IvlnSpeakersLecture::where('lecture_id',$args["lecture_id"])->where('speaker_id',$args["speaker_id"])->where('role_id',$args["role_id"])->first();
        if(!$exist){
            $createSpeakerLectures=new IvlnSpeakersLecture();
            if(isset($args["lecture_id"])){
                $createSpeakerLectures->lecture_id=$args["lecture_id"];
            }
            if(isset($args["role_id"]))
                $createSpeakerLectures->role_id=$args["role_id"];
            if(isset($args["speaker_id"]))
                $createSpeakerLectures->speaker_id=$args["speaker_id"];
            $createSpeakerLectures->status=1;
            $createSpeakerLectures->save();
        }
        return "dddd";
    }
}
