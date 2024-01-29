<?php

namespace App\GraphQL\Mutations\Rating;

use App\Models\Rating;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $rating = Rating::where('model_type',$args['model_type'])->where('model_id', $args['model_id'])->first();
        \Log::info($rating);
        if($rating){
            $rating->rating = $args['rating'];
            $rating->status = $args['status'];
            $rating->save();
        } else {
            $rating = new Rating();
            $rating->rating = $args['rating'];
            $rating->status = $args['status'];
            $rating->model_type = $args['model_type'];
            $rating->model_id = $args['model_id'];
            $rating->save();
        }
        return $rating;
    }
}
