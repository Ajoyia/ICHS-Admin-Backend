<?php

namespace App\GraphQL\Queries\Lectures;

use Illuminate\Support\Facades\Storage;

final class getThumbnail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $curl = curl_init();
        curl_setopt_array($curl,[
        CURLOPT_URL => 'https://vimeo.com/api/oembed.json?url='.$args['url'],
        CURLOPT_RETURNTRANSFER => true,
        ]);
        $response = curl_exec($curl);

        if(isset(json_decode($response)->thumbnail_url))
            $thumbImg=json_decode($response)->thumbnail_url;
        else
            $thumbImg=Storage::url('ivln_courses_thumbnails/images/Black_Background.png');;

        return $thumbImg;
    }
}
