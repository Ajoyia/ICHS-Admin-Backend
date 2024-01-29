<?php

namespace App\GraphQL\Mutations\CMESpeakers;
use App\Models\CMESpeaker;
use Illuminate\Support\Facades\Storage;

final class CreateCMESpeaker
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if($args['image'] && isset($args['image'])){

            $filename = Storage::putFile('/cme_speakers/images',$args['image']);
        } else {
            $filename = null;
        }
        
        $template = CMESpeaker::create([
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
            'cme_application_id' => $args['cme_application_id'],
            'image' => $filename,
        ]);
        
        return $template;
    }
}
