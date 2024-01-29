<?php

namespace App\GraphQL\Mutations\CMEApplications;

use Illuminate\Support\Facades\Auth;
use App\Models\CMEApplicationSocialEvent;

final class updateCMEApplicationSocialEvents
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cmeSEs=CMEApplicationSocialEvent::where('cme_application_id',$args['id'])->get();
        foreach($cmeSEs as $cmeSE){
            $cmeSE->deleted_by=Auth::id();
            $cmeSE->delete();
        }
        foreach($args['social_events'] as $socialEvent){
            $cmeSE=new CMEApplicationSocialEvent();
            $cmeSE->cme_application_id=$args['id'];
            $cmeSE->cme_social_event_id=$socialEvent;
            $cmeSE->created_by=Auth::id();
            $cmeSE->save();
        }
        return 'done';
    }
}
