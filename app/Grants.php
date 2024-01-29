<?php
namespace App;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

class Grants {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('users as u', 'grants.user_id', "=", "u.id")
        //         // ->where(function($q) use ($whereConditions){
        //     ->where('u.first_name','like','%'.$whereConditions['OR'][0]['value'].'%')
        //     ->orWhere('u.last_name','like','%'.$whereConditions['OR'][0]['value'].'%');
            // ->select('grants.id as id','users.first_name as first_name','users.last_name','grants.requested_amount','grants.status'));

                // });
    }
}
