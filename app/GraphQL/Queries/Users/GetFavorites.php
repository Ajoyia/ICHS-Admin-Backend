<?php

namespace App\GraphQL\Queries\Users;

use App\Models\Lecture;
use App\Models\IvlnCourse;
use App\Models\IvlnSection;
use App\Models\JournalApplication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthInnovationInitiative;

final class GetFavorites
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $favs=Auth::user()->ivlnFavorites;
        $preCourse=null;
        foreach($favs as $fav){
            switch($fav->model_type){
                case 'App\\Models\\IvlnCourse':
                    if($preCourse!=$fav->model_id){
                        $fav->course=IvlnCourse::where('id',$fav->model_id)->with(
                            ['lectures' => function($query) {
                                    $query->where('status', 1)
                                        ->where('lecture_type_id',1);
                                }
                            ])->first();
                        $fav->course->avgRating=$fav->course->avgRating();
                        $preCourse=$fav->model_id;
                        if(isset($fav->course->lectures[0]->speakers[0]->name))
                            $fav->course->by=$fav->course->lectures[0]->speakers[0]->name;
                        else
                            $fav->course->by='------';
                    }
                    break;
                case 'App\\Models\\Lecture':
                    $fav->lecture=Lecture::find($fav->model_id);
                    if($preCourse!=$fav->lecture->course_id){
                        $fav->course=IvlnCourse::where('id',$fav->lecture->course_id)->with(
                            ['lectures' => function($query) {
                                    $query->where('status', 1)
                                        ->where('lecture_type_id',1);
                                }
                            ])->first();
                        $fav->course->avgRating=$fav->course->avgRating();
                        $preCourse=$fav->lecture->course_id;
                    }
                    break;
                case 'App\\Models\\IvlnSection':
                    $fav->section=IvlnSection::find($fav->model_id);
                    if($preCourse!=$fav->section->course_id){
                        $fav->course=IvlnCourse::where('id',$fav->section->course_id)->with(
                            ['lectures' => function($query) {
                                    $query->where('status', 1)
                                        ->where('lecture_type_id',1);
                                }
                            ])->first();
                        $fav->course->avgRating=$fav->course->avgRating();
                        $preCourse=$fav->section->course_id;
                        }
                    break;
                case 'App\\Models\\JournalApplication':
                    $fav->journal=JournalApplication::where('id',$fav->model_id)->with(['user','journalContent'])->first();
                    break;
                case 'App\\Models\\HealthInnovationInitiative':
                    $fav->hii=HealthInnovationInitiative::where('id',$fav->model_id)->with('user')->first();
                    break;
            }
        }
        return $favs;
    }
}
