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

final class ShowCoursesLectureVideo
{
    public function __invoke($_, array $args)
    {
        if(isset($args['search'])){
            $IvlnCourse=IvlnCourse::where('name','like','%'.$args['search'].'%')
                ->with(
                ['lectures' => function($query) {
                        $query->where('status', 1);

                    },

                ])
                ->where('status',1)
                ->whereHas('lectures')
                ->withAvg('courseRating','rating');
        }
        else{
            $IvlnCourse=IvlnCourse::with(
                ['lectures' => function($query) {
                        $query->where('status', 1);
                    }
                ])
                ->where('status',1)
                ->whereHas('lectures')
                ->withAvg('courseRating','rating');
            }
        if(Auth::user()&&isset(Auth::user()->memberships->status)&&Auth::user()->memberships->status==1){
            $IvlnCourse=$IvlnCourse->paginate($args['data_count']);
        }
        else{
            $IvlnCourse=$IvlnCourse->where('paid',0)->paginate($args['data_count']);
            Log::info($IvlnCourse);
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
                $course->totalTime=0;

                $ratings=$course->courseRating;
                if(count($ratings)){
                    $course->course_rating_avg_rating=round($course->course_rating_avg_rating,2);
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
                    $course->by='------';
            }
        }
        $arr=[];
        $arr['courses']=$IvlnCourse;
        if(isset($args['patch'])){
            $arr['patch']=$args['patch'];
        }
        else{
            $arr['patch']=0;
        }

        // Log::info($arr);
        return json_encode($arr);
    }
}
