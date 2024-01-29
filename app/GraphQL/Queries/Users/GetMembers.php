<?php

namespace App\GraphQL\Queries\Users;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Lecture;
use App\Models\Alliance;
use App\Models\IvlnCourse;
use App\Models\IvlnSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class GetMembers
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $users=User::whereHas('memberships');//,function($query){
            // $query->where('status',1);
            // $query->where('end_date','>',Carbon::now());
        // });
        if(isset($args['search'])){
            $users->where('first_name','like','%'.$args['search'].'%')
                ->orWhere('last_name','like','%'.$args['search'].'%')
                ->whereHas('memberships')
                ->orWhere((DB::raw("CONCAT(users.first_name, ' ', users.last_name)")),'like','%'.$args['search'].'%')
                ->whereHas('memberships');
        }
        if (isset($args['chapter']) && ($args['chapter'] != 0)) {
            $chapter = Chapter::find($args['chapter']);
            if ($chapter->users != null) {
                $users->whereIn('id', $chapter->users->pluck('id'));
            }
        }
        if(isset($args['nationalities'])){
            $nationalitiesIds=[];
            foreach($args['nationalities'] as $nationality){
                array_push($nationalitiesIds,$nationality->id);
            }
            if(count($nationalitiesIds)>0)
                $users->whereIn('nationality_id',$nationalitiesIds);
        }
        if(isset($args['specialities'])){
            $specialitiesIds=[];
            foreach($args['specialities'] as $nationality){
                array_push($specialitiesIds,$nationality->id);
            }
            Log::info($specialitiesIds);
            if(count($specialitiesIds)>0)
                $users->whereHas('specialty',function($query) use ($specialitiesIds){
                    $query->whereIn('specialties.id',$specialitiesIds);
                });
        }
        if(isset($args['alliance'])&&$args['alliance']!=0){
            $allaince=Alliance::find($args['alliance']);
            $specialities=$allaince->specialities;
            $specialitiesIds=[];
            foreach($specialities as $speciality){
                array_push($specialitiesIds,$speciality->id);
            }
            Log::info($specialitiesIds);
            if(count($specialitiesIds)>0){
                $users->whereHas('specialty',function($query) use ($specialitiesIds){
                    $query->whereIn('specialties.id',$specialitiesIds);
                });
            }
        }
        return $users->get();
    }
}
