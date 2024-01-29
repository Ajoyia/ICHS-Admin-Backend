<?php
namespace App;
use Illuminate\Support\Facades\Log;

class Jichs {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        Log::info($whereConditions);


        // $builder->join('users', 'journal_applications.user_id', "=", "users.id")
        //         ->where(function($q) use ($whereConditions){

        //                 $q->where('users.first_name','like','%'.$whereConditions['OR'][0]['value'].'%');
        //                 $q->orWhere('users.last_name','like','%'.$whereConditions['OR'][0]['value'].'%');

        //         });
    }
}
