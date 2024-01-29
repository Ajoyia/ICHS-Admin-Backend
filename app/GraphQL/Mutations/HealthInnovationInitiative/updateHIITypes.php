<?php

namespace App\GraphQL\Mutations\HealthInnovationInitiative;

use Illuminate\Support\Facades\Auth;
use App\Models\HIIType;

final class updateHIITypes
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cmeSEs=HIIType::where('hii_id',$args['id'])->delete();
        foreach($args['HIIType'] as $hii_type){
            $cmeALF=new HIIType();
            $cmeALF->hii_id=$args['id'];
            $cmeALF->hii_type_id= $hii_type;
            $cmeALF->created_by=Auth::id();
            $cmeALF->save();
        }
        return 'done';
    }
}
