<?php

namespace App\GraphQL\Mutations\Supporter;

use App\Models\IvlnSupporter;
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
        $discamus = new IvlnSupporter;
        if(isset($args['name'])){
            $discamus->name = $args['name'];
        }
        if(isset($args['course_id'])){
            $discamus->course_id = $args['course_id'];
        }
        if(isset($args['image'])){
            $file = $args['image'];
            if($file!=null){
                $discamus->image =  Storage::putFile('/discamus/images',$args['image']);
            }
        }
        $discamus->created_by = Auth::id();
        $discamus->save();
        return $discamus;
    }
}
