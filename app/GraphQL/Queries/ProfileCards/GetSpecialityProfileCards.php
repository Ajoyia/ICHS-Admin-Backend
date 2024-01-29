<?php

namespace App\GraphQL\Queries\ProfileCards;

use App\Models\ProfileCard;
use App\Models\Specialty;

final class GetSpecialityProfileCards
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $speciatilty=Specialty::where('name','like','%'.$args['specility'].'%')
           ->whereNull('parent_id')->first();
        return ProfileCard::where('speciality_id',$speciatilty->id)->get();
    }
}
