<?php
namespace App;
use Illuminate\Support\Facades\Log;

class searchDonations {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('users','donations.user_id','=','users.id')
        //     ->where('users.first_name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('users.last_name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('donations.amount','=',$whereConditions['OR'][0]['value']);
    }
}
