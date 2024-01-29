<?php

namespace App\GraphQL\Queries\HealthInnovationInitiative;

use App\Models\HealthInnovationInitiative;
use Carbon\Carbon;;

final class getAllPublishedHII
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $hiis = HealthInnovationInitiative::where('publish_date' ,'<=', Carbon::now());//->orderBy('id','desc')->get();
       if(isset($args['sorting'])){
        switch($args['sorting']){
            case 'newest':
                $hiis->orderBy('id', 'desc');
                break;
            case 'most_reviewed':
                $hiis->withCount('logs')->orderBy('logs_count', 'desc');
                break;
            case 'featured':
                $hiis->orderBy('featured','desc');
                break;
            }
        }
        if(isset($args['search']))
            $hiis->where('title','like','%'.$args['search'].'%');

        if(isset($args['type'])&&$args['type']!=-1){
            $hiis->whereHas('HIITypes',function($query) use($args){
                $query->where('hii_type_id',$args['type']);
            });
        }
        return $hiis->paginate($args['data_count']);
    }
}
