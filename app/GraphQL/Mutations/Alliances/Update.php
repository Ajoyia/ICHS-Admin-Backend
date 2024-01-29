<?php

namespace App\GraphQL\Mutations\Alliances;


use App\Models\Alliance;
use App\Models\AllianceSpeciality;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

final class Update
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $alliance=Alliance::find($args['id']);
        if(isset($args['title'])){
            // $alliance=new Alliance();
            $alliance->title=$args['title'];
            $alliance->created_by=Auth::id();
            if(isset($args['status'])){
                $alliance->status=$args['status'];
            }
            $alliance->save();
        }
        if(isset($args['specialities'])){
            $cs=AllianceSpeciality::where('alliance_id',$alliance->id)->get();
            Log::info($cs);
            foreach($cs as $c){
                $c->delete();
            }
            foreach($args['specialities'] as $sp){
                $as=new AllianceSpeciality();
                $as->alliance_id=$alliance->id;
                $as->speciality_id=$sp;
                $as->created_by=Auth::id();
                $as->save();
            }
        }

        return $alliance;
    }
}
