<?php
namespace App;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

class searchMembership {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('users',function(JoinClause $join){
        //     $join->on('memberships.user_id','=','users.id')
        //         ->whereNull('users.deleted_at');
        // })
        // ->where(function($query) use($whereConditions){
        //     $query->where('memberships.membership_id','like',$whereConditions['OR'][0]['value'])
        //         ->orWhere('memberships.start_date','like',$whereConditions['OR'][0]['value'])
        //         ->orWhere('memberships.end_date','like',$whereConditions['OR'][0]['value'])
        //         ->orWhere('users.first_name','like',$whereConditions['OR'][0]['value'])
        //         ->orWhere('users.last_name','like',$whereConditions['OR'][0]['value']);
        // });
    }
}
