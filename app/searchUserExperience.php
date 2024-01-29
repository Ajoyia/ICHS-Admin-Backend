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

        // $builder->Where('user_experiences.company_name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('user_experiences.jobs_responsibility','like',$whereConditions['OR'][0]['value']);
    }
}
