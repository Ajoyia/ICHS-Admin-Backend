<?php

namespace App\GraphQL\Queries\Courses;

use App\Models\Rating;
use App\Models\IvlnCourse;
use App\Models\IvlnFavorite;
use App\Models\IvlnLecturesType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class ShowFeaturedCoursesLectureVideo
{
    public function __invoke($_, array $args)
    {
        $IvlnCourse=IvlnCourse::with(
            ['lectures' => function($query) {
                    $query->where('status', 1)
                        ->where('lecture_type_id',1);
                }
            ])
            ->where('paid',0)
            ->where('status',1)
            ->where('featured',1)
            ->whereHas('lectures')
            ->withAvg('courseRating','rating')
            ->get();
        if(Auth::user()&&isset(Auth::user()->memberships->status)&&Auth::user()->memberships->status==1){
            $IvlnCoursePaid=IvlnCourse::with(
                ['lectures' => function($query) {
                        $query->where('status', 1)
                            ->where('lecture_type_id',1);
                    }
                ])
                ->where('paid',1)
                ->where('status',1)
                ->where('featured',1)
                ->whereHas('lectures')
                ->withAvg('courseRating','rating')
                ->get();
            $IvlnCourse->merge($IvlnCoursePaid);
            $merged=$IvlnCourse->merge($IvlnCoursePaid);
            $IvlnCourse=$merged;
        }

        foreach($IvlnCourse as $key=>$course){

            if(count($course->lectures)){
                $curl = curl_init();
                curl_setopt_array($curl,[
                    CURLOPT_URL => 'https://vimeo.com/api/oembed.json?url='.$course->lectures[0]->file_path,
                    CURLOPT_RETURNTRANSFER => true,
                ]);
                $response = curl_exec($curl);

                if(isset(json_decode($response)->thumbnail_url)){
                    $course->thumbnail=json_decode($response)->thumbnail_url;
                    $course->save();
                }
                else{
                    if(!$course->thumbnail){
                        $course->thumbnail=Storage::url('ivln_courses_thumbnails/images/Black_Background.png');;
                        $course->save();
                    }else{

                    }
                }

                $fav=IvlnFavorite::where('model_type','App\Models\IvlnCourse')
                    ->where('model_id',$course->id)
                    ->where('user_id',Auth::user()->id)
                    ->first();
                if($fav)
                    $course->favorite=true;
                else
                    $course->favorite=false;
                if(isset($course->lectures[0]->speakers[0]->name))
                    $course->by=$course->lectures[0]->speakers[0]->name;
                else
                    $course->by='-------';
                $course->course_rating_avg_rating=round($course->course_rating_avg_rating,2);
            }

        }

        return json_encode($IvlnCourse);
    }
}
