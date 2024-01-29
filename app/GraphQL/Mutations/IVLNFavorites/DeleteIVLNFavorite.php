<?php

namespace App\GraphQL\Mutations\IVLNFavorites;

use App\Models\IvlnFavorite;
use Illuminate\Support\Facades\Auth;

final class DeleteIVLNFavorite
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $fav=IvlnFavorite::where('model_type',$args['model_type'])
            ->where('model_id',$args['model_id'])
            ->where('user_id',Auth::user()->id)
            ->first();
        $fav->deleted_by=Auth::user()->id;
        $fav->save();
        $fav->delete();
        return $fav;
    }
}
