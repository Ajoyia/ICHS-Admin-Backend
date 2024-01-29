<?php

namespace App\GraphQL\Mutations\IVLNSections;

use App\Models\IvlnSection;

final class DeleteSection
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $sec=IvlnSection::find($args['id']);
        $lectures=$sec->ivlnLectures;
        foreach($lectures as $lecture){
            $lecture->delete();
        }
        $sec->delete();
        return $sec;
    }
}
