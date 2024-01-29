<?php

namespace App\GraphQL\Mutations\IVLNCourses;

use App\Models\IvlnCourse;
use Illuminate\Support\Str;
use App\Models\IvlnCourseIvlnTag;
use Illuminate\Support\Facades\Log;
use App\Models\IvlnCourseSpeciality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// Test
final class UpdateIVLNCourse
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $course=IvlnCourse::find($args['id']);
        if(isset($args['name'])){
            $course->name=$args['name'];
        }
        if(isset($args['content'])){
            $course->content=$args['content'];
        }
        if(isset($args['status'])){
            $course->status=$args['status'];
        }
        if(isset($args['model_type'])){
            $course->model_type=null;
        }
        if(isset($args['model_id'])){
            $course->model_id=null;
        }
        if(isset($args['tempalate_id'])){
            $course->tempalate_id=$args['tempalate_id'];
        }
        // Log::info($args['featured']);
        if(isset($args['featured'])){
            $course->featured=$args['featured'];
        }

        if(isset($args['thumbnail'])){
            $course->thumbnail= Storage::putFile('/ivln_courses_thumbnails/images',$args['thumbnail']);
        }
        if(isset($args['paid'])){
            $course->paid= $args['paid'];
        }
        $course->slug=Str::slug($args['name']);
        $chkP=IvlnCourse::where('slug',$course->slug)->get();
        if(count($chkP)){
            $course->slug=$course->slug.'-'.IvlnCourse::max('id');
        }
        $course->created_by=Auth::id();
        // Log::info($course);
        $course->save();
        if(isset($args['tags'])){
            $tags=IvlnCourseIvlnTag::where('ivln_course_id',$course->id)->get();
            foreach($tags as $t){
                $t->delete();
            }
            if(!is_string($args['tags'])){
                foreach($args['tags'] as $tag){
                    $ivlnCourseTag=new IvlnCourseIvlnTag();
                    $ivlnCourseTag->ivln_course_id=$course->id;
                    $ivlnCourseTag->ivln_tag_id=$tag->id;
                    $ivlnCourseTag->save();
                }
            }
        }
        if(isset($args['specialities'])){
            if(!is_string($args['specialities'])){
                $ivlnCourseSpecialities=IvlnCourseSpeciality::where('ivln_course_id',$course->id)->get();
                foreach($ivlnCourseSpecialities as $ivlnCourseSpeciality){
                    $ivlnCourseSpeciality->delete();
                }
                foreach($args['specialities'] as $speciality){
                    $ivlnCourseSpeciality=new IvlnCourseSpeciality();
                    $ivlnCourseSpeciality->ivln_course_id=$course->id;
                    $ivlnCourseSpeciality->specialty_id=$speciality->id;
                    $ivlnCourseSpeciality->save();
                }
            }
        }
        return $course;
    }
}
