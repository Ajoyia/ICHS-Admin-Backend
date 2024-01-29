<?php

namespace App\GraphQL\Mutations\Journals;

use App\Models\Package;
use App\Models\JournalApplication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class UploadPDF
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $pdf = file_get_contents($args['file_path']);
        $number = preg_match_all("/\/Page\W/", $pdf);
        $package = Package::where('product_id', 3)->where('page_from', '<=', $number)->where('page_to', '>=', $number)->first();
        
        // $packages = Package::where('product_id',3)->get();

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

        $journals = JournalApplication::find($args['id']);
        $journals->file_path = Storage::putFile('/journals/documents', $args['file_path']);
        $journals->total_no_pages = $number;
        $journals->price = $package->price;
        $journals->save();
        return $package;
    }
}
