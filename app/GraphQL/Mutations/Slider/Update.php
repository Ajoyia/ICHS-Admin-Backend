<?php

namespace App\GraphQL\Mutations\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class Update
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $slider = Slider::find($args['id']);
        if(isset($args['title'])){
            $slider->title = $args['title'];
        }
        if(isset($args['link'])){
            $slider->link = $args['link'];
        }
        if(isset($args['description'])){
            $slider->description = $args['description'];
        }
        if(isset($args['content'])){
            $slider->content = $args['content'];
        }
        if(isset($args['image'])){
            $file = $args['image'];
            if($file!=null){
                $slider->image =  Storage::putFile('/slider/images',$args['image']);
            }
        }
        $slider->updated_by = Auth::id();
        $slider->created_by = Auth::id();
        $slider->save();
    }
}
