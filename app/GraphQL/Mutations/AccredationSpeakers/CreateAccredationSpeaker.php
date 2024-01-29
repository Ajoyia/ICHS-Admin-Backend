<?php

namespace App\GraphQL\Mutations\AccredationSpeakers;
use App\Models\AccredationSpeaker;
use Illuminate\Support\Facades\Storage;

final class CreateAccredationSpeaker
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if($args['image'] && isset($args['image'])){

            $filename = Storage::putFile('/accredation_speakers/images',$args['image']);
        } else {
            $filename = null;
        }
        
        $template = AccredationSpeaker::create([
            'salutation_id' => $args['salutation_id'],
            'first_name' => $args['first_name'],
            'middle_name' => $args['middle_name'],
            'last_name' => $args['last_name'],
            'email' => $args['email'],
            'entity' => $args['entity'],
            'designation' => $args['designation'],
            'bio' => $args['bio'],
            'title' => $args['title'],
            // 'feature' => $args['feature'],
            // 'is_publish' => $args['is_publish'],
            // 'status' => $args['status'],
            // 'country_id' => $args['country_id'],
            'acc_id' => $args['acc_id'],
            'image' => $filename,
        ]);
        
        return $template;
    }
}
