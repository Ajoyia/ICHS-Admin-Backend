<?php

namespace App\GraphQL\Mutations\Events;

use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $event = new Events;
        if(isset($args['title'])){
            $event->title = $args['title'];
        }
        if(isset($args['link'])){
            $event->link = $args['link'];
        }
        if(isset($args['date'])){
            $event->date = $args['date'];
        }
        if(isset($args['location'])){
            $event->location = $args['location'];
        }
        if(isset($args['cme_points'])){
            $event->cme_points = $args['cme_points'];
        }
        if(isset($args['recent_flag'])){
            $event->recent_flag = $args['recent_flag'];
        }
        if(isset($args['upcoming_flag'])){
            $event->upcoming_flag = $args['upcoming_flag'];
        }
        if(isset($args['order'])){
            $event->order = $args['order'];
        }
        if(isset($args['image'])){
            $file = $args['image'];
            if($file!=null){
                $event->image =  Storage::putFile('/event/images',$args['image']);
            }
        }
        $event->updated_by = Auth::id();
        $event->created_by = Auth::id();
        $event->save();

    }
}

