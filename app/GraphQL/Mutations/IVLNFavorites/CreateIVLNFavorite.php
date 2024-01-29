<?php

namespace App\GraphQL\Mutations\IVLNFavorites;

use App\Models\IvlnFavorite;
use Illuminate\Support\Facades\Auth;

final class CreateIVLNFavorite
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $fav=IvlnFavorite::where('model_type',$args['model_type'])
            ->where('model_id',$args['model_id'])
            ->where('user_id',Auth::user()->id)
            ->first();
        if(!$fav){
            $fav=new IvlnFavorite();
            $fav->model_type=$args['model_type'];
            $fav->model_id=$args['model_id'];
            $fav->user_id=Auth::user()->id;
            $fav->created_by=Auth::user()->id;
            $fav->save();
        }
        else{
            $fav->delete();
        }
        return $fav;
    }
}
