<?php

namespace App\GraphQL\Mutations\IVLNAttedanceUser;

use App\Models\IvlnAttendanceUser;
use Illuminate\Support\Facades\Auth;

final class markUserAttendance
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $attendance=IvlnAttendanceUser::where('lecture_id',$args['lecture_id'])->where('user_id',Auth::id())->first();
        if(!$attendance){
            $attendance=new IvlnAttendanceUser();
            $attendance->created_by=Auth::id();
        }
        else
            $attendance->updated_by=Auth::id();
        $attendance->lecture_id=$args['lecture_id'];
        $attendance->user_id=Auth::id();
        $attendance->duration=$args['duration'];
        $attendance->time_watched=$args['time_watched'];
        $attendance->total_points=$args['total_points'];
        $attendance->points=$args['points'];
        $attendance->status=$args['status'];
        $attendance->save();
        return $attendance;
    }
}
