<?php

namespace App\GraphQL\Mutations\Lectures;
use App\Models\Lecture;
use Illuminate\Support\Facades\Storage;

final class CreateLectures
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if($args['iframe_path']!=="" || !is_null($args['iframe_path'])){
            $filename = $args['iframe_path'];
        }
        if($args['file_path']!="" || !is_null($args['file_path']) ){
            $filename = Storage::putFile('/lectures/files',$args['file_path']);
        }
        $lecture = Lecture::create([
            'overview' => $args['overview'],
            'content' => $args['content'],
            'file_path' => $filename,
            'total_minuts' => $args['total_minuts'],
            'section_id' => $args['section_id'],
            'course_id' => $args['course_id'],
            'lecture_type_id' => $args['lecture_type_id'],
            'language_id' => $args['language_id'],
            'status' => $args['status']
        ]);
        return $lecture;
    }
}
