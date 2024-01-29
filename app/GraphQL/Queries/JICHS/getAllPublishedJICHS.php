<?php

namespace App\GraphQL\Queries\JICHS;

use App\Models\JournalApplication;
use Carbon\Carbon;;

final class getAllPublishedJICHS
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $hiis = JournalApplication::where('publish_date', '<=', Carbon::now());
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
            $hiis->whereHas('journalContent',function($query) use($args){
                    $query->where('title','like','%'.$args['search'].'%');
                });
        if(isset($args['type'])&&$args['type']!=-1){
            $hiis->where('form_type_id',$args['type']);
        }

        return $hiis->paginate($args['data_count']);
    }
}
