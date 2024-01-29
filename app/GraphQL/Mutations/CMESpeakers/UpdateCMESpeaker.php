<?php

namespace App\GraphQL\Mutations\CMESpeakers;
use App\Models\CMESpeaker;
use Illuminate\Support\Facades\Storage;

final class UpdateCMESpeaker
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['image'];
        $speaker = CMESpeaker::find($args['id']);
        $speaker->first_name = $args['first_name'];
        $speaker->middle_name = $args['middle_name'];
        $speaker->last_name = $args['last_name'];
        $speaker->salutation_id = $args['salutation_id'];
        // $speaker->country_id = $args['country_id'];
        $speaker->email= $args['email'];
        $speaker->title = $args['title'];
        $speaker->entity = $args['entity'];
        $speaker->designation = $args['designation'];
        $speaker->bio = $args['bio'];
        // $speaker->feature = $args['feature'];
        // $speaker->is_publish = $args['is_publish'];
        // $speaker->status = $args['status'];
        if($file!=null){
            $speaker->image = Storage::putFile('/cme_speakers/images',$args['image']);
        }
        $speaker->save();
    }
}
