<?php

namespace App\GraphQL\Mutations\AccredationApplications;

use Illuminate\Support\Facades\Auth;
use App\Models\AccredationApplicationSocialEvent;

final class updateAccredationApplicationSocialEvents
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cmeSEs= AccredationApplicationSocialEvent::where('acc_id',$args['id'])->get();
        foreach($cmeSEs as $cmeSE){
            $cmeSE->deleted_by=Auth::id();
            $cmeSE->delete();
        }
        foreach($args['social_events'] as $socialEvent){
            $cmeSE=new AccredationApplicationSocialEvent();
            $cmeSE->acc_id=$args['id'];
            $cmeSE->acc_social_id=$socialEvent;
            $cmeSE->created_by=Auth::id();
            $cmeSE->save();
        }
        return 'done';
    }
}
