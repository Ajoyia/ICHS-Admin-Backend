<?php

namespace App\GraphQL\Mutations\Alliances;

use App\Models\Alliance;
use App\Models\AllianceSpeciality;
use Illuminate\Support\Facades\Auth;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if(isset($args['title'])){
            $alliance=new Alliance();
            $alliance->title=$args['title'];
            $alliance->created_by=Auth::id();
            $alliance->save();
        }
        if(isset($args['specialities'])){
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
