<?php

namespace App\GraphQL\Queries\Courses;

use App\Models\Rating;
use App\Models\IvlnCourse;
use App\Models\IvlnFavorite;
use App\Models\IvlnLecturesType;
use App\Models\IvlnSection;
use App\Models\Log as ModelsLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class FindCourse
{
    public function __invoke($_, array $args)
    {
        $course=IvlnCourse::where('id',$args['id'])->with('ivlnTags')->first();
        // Log::info($course);
        $log=new ModelsLog();
        if(!isset($args['admin'])){
            $log->user_id=Auth::user()->id;
            $log->model_type='App\\Models\\IvlnCourse';
            $log->model_id=$course->id;
            $log->created_by=Auth::user()->id;
            $log->save();
        }
        $fav=IvlnFavorite::where('model_type','App\\Models\\IvlnCourse')->where('user_id',Auth::user()->id)->where('model_id',$args['id'])->count();

        if($fav)
            $course->fav=true;
        else
            $course->fav=false;
        $course->views=ModelsLog::where('model_type','App\\Models\\IvlnCourse')
            ->where('model_id',$course->id)
            ->count();
        return $course;
    }
}
