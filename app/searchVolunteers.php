<?php
namespace App;
use Illuminate\Support\Facades\Log;

class searchUserExperience {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('regions','volunteer.region_id','=','regions.id')
        //     ->join('chapters','volunteer.chapter_id','=','chapters.id')
        //     ->join('volunteer_types','volunteer.volunteer_type_id','=','volunteer_types.id')
        //     ->Where('regions.name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('chapters.name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('volunteer_types.name','like',$whereConditions['OR'][0]['value']);
    }
}
