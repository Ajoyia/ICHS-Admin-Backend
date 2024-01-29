<?php
namespace App;
use Illuminate\Support\Facades\Log;

class seachLectureSpeakers {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        // TODO make calls to $builder depending on $whereConditions

        // $builder->join('speaker_roles','cme_session_speakers.role_id','=','speaker_roles.id')
        //     ->join('cme_speakers','cme_session_speakers.cme_speakers_id','=','cme_speakers.id')
        //     ->where('speaker_roles.name','like',$whereConditions['OR'][0]['value'])
        //     ->orWhere('cme_speakers.first_name','like',$whereConditions['OR'][0]['value']);
        //     // ->orWhere('countries_type.name','like',$whereConditions['OR'][0]['value']);
    }
}
