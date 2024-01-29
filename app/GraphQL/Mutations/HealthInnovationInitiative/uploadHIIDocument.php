<?php

namespace App\GraphQL\Mutations\HealthInnovationInitiative;

use Illuminate\Support\Facades\Auth;
use App\Models\HIIType;
use App\Models\HealthInnovationInitiative;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class uploadHIIDocument
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $hii = HealthInnovationInitiative::find($args['id']);
        $hii->file_path = Storage::putFile('/hii/documents', $args['file_path']);
        // $package = null;
        // $packages = Package::where('product_id',4)->get();
        $pdf = file_get_contents($args['file_path']);
        
        $number = preg_match_all("/\/Page\W/", $pdf);
        $hii->no_of_pages = $number;
        $hii->save();
        $package = Package::where('product_id', 4)->where('page_from','<=', $number)->where('page_to', '>=', $number)->first();
        // if($number >= 1 && $number <= 3){
        //     $package=$packages[0];
        // }
        // else if($number >= 4 && $number <= 6){
        //     $package = $packages[1];
        // } 
        // else if ($number >= 7 && $number <= 10) {
        //     $package = $packages[2];
        // }
        // else if($number >= 11 && $number <= 13){
        //     $package = $packages[3];
        // }else{
        //     $package = $packages[4];
        // }
        return $package;

        
    }
}
