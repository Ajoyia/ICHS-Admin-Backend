<?php

namespace App\GraphQL\Queries\IVLNAttedanceUser;

use App\Models\IvlnAttendanceUser;
use App\Models\Lecture;
use Illuminate\Support\Facades\Log;

final class attendaceOfACourse
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $attendance=IvlnAttendanceUser::whereHas('lecture',function($query) use($args){
            $query->where('course_id',$args['course']);
        });
        if(isset($args['search'])&&!is_null($args['search'])&&$args['search']!='')
            $attendance->whereHas('lecture',function($query)use($args){
                $query->where('overview','like','%'.$args['search'].'%');
            })->orWhereHas('user',function($query)use($args){
                $query->where('first_name','like','%'.$args['search'].'%');
            });

        else if(isset($agrs['orderColumn']))
            $attendance->whereHas('lecture',function($query)use($args){
                if($args['orderColumn']=='lecture'){
                    if($args['order']=='ASC'){
                        $query->orderByAsc('overview');
                    }
                    if($args['order']=='DESC')
                        $query->orderByDesc('overview');
                }

            })->whereHas('user',function($query)use($args){
                if($args['orderColumn']=='user'){
                    if($args['order']=='ASC')
                        $query->orderByAsc('first_name');
                    if($args['order']=='DESC')
                        $query->orderByDesc('first_name');
                }
            });
        return $attendance->get();
    }
}
