<?php

namespace App\GraphQL\Mutations\Lectures;
use App\Models\Lecture;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class UpdateLectures
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
            Log::info("file path");
            Log::info($args['file_path']);
            $filename = Storage::putFile('/lectures/files',$args['file_path']);
            Log::info($filename);
        }
        if(isset($args['id'])){
            $lecture=Lecture::find($args['id']);
            $lecture->overview = $args['overview'];
            $lecture->content = $args['content'];
            $lecture->file_path = $filename;
            $lecture->total_minuts = $args['total_minuts'];
            $lecture->section_id = $args['section_id'];
            $lecture->course_id = $args['course_id'];
            $lecture->lecture_type_id = $args['lecture_type_id'];
            $lecture->language_id=$args['language_id'];
            $lecture->status = $args['status'];
            $lecture->save();
            return $lecture;
        }
    }
}
