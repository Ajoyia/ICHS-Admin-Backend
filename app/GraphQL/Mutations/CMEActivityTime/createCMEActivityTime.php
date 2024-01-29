<?php

namespace App\GraphQL\Mutations\CMEActivityTime;

use Carbon\Carbon;
use App\Models\CMEApplication;
use App\Models\CMEActivityTime;
use App\Models\CMEProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class createCMEActivityTime
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $timeDiff=0;
        $cmeApp=CMEApplication::find($args['cme_application_id']);
        $activityTimes=$cmeApp->CMEActivityTime;

        foreach($activityTimes as $activityTime){
            $timeDiff+=$this->calTimeDiff($activityTime->start_time,$activityTime->end_time);
            if($timeDiff>1440)
                return -1;
        }
        $timeDiff+=$this->calTimeDiff($args['start_time'],$args['end_time']);
        if($timeDiff>1440)
            return -1;
        $at=new CMEActivityTime();
        $at->start_time=$args['start_time'];
        $at->end_time=$args['end_time'];
        $at->cme_application_id=$args['cme_application_id'];
        $at->created_by=Auth::id();
        $at->save();
        $timeInHours=$timeDiff/60;
        $country_type_id = $cmeApp->country->country_types->first()->id;
        Log::info($country_type_id);
        if($country_type_id==1 || $country_type_id==2){
            $cmePro=CMEProduct::where('hour_from','<=',$timeInHours)->where('hour_to','>=',$timeInHours)
                                ->where('id','>',4)->first();
        }
        else{
            $cmePro=CMEProduct::where('hour_from','<=',$timeInHours)->where('hour_to','>=',$timeInHours)
            ->where('id','<=',4)->first();
        }
        $cmePro->first();
        $cmeApp->cme_product_id=$cmePro->id;
        $cmeApp->save();
        return $timeDiff;

    }
    private function calTimeDiff($st,$et){
        $startTime=Carbon::parse($st);
        $endTime=Carbon::parse($et);
        return $startTime->diffInMinutes($endTime);
    }
}
