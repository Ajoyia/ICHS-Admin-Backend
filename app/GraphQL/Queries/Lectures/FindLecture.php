<?php

namespace App\GraphQL\Queries\Lectures;

use App\Models\Lecture;
use App\Models\Log as ModelsLog;

final class FindLecture
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $lecture=Lecture::find($args['id']);
        $lecture->views=ModelsLog::where('model_type','App\\Models\\Lecture')
        ->where('model_id',$lecture->id)
        ->count();
        return $lecture;
    }
}
