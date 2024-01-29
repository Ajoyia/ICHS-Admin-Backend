<?php

namespace App\GraphQL\Queries;

use App\Models\Specialty;

final class AllSpecialty
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // $specialities = Specialty::whereNull('parent_id')->get();
        // foreach($specialities as $speciality){
        //     if(count($speciality->children) > 0){
        //         $cchildIDs = $speciality->children->pluck('id');
        //         $childIDs = $speciality->children->pluck('id')->implode(',');
        //         $speciality->ids = $speciality->id . ',' . $childIDs;
        //         $speciality->child = $speciality->children;
        //         foreach($cchildIDs as $cchildID){
        //             $specialities2 = Specialty::find($cchildID);
        //             if(count($specialities2->children)>0){
                        
        //                 $cchildID2s =  $specialities2->children->pluck('id');
        //                 $childID2s =  $specialities2->children->pluck('id')->implode(',');
        //                 $speciality->ids .= ',' . $childID2s;
        //                 foreach($cchildID2s as $cchildID2){
        //                     $specialities3 = Specialty::find($cchildID2);
        //                     if(count($specialities3->children)>0){
        //                         $cchildID3s =  $specialities3->children->pluck('id');
        //                         $childID3s =  $specialities3->children->pluck('id')->implode(',');
        //                         $speciality->ids .= ',' . $childID3s;
        //                     }
        //                 }
        //             }

        //         }              
        //     }
        // }
        $array = [];
        $id = null;
        $specialities = Specialty::whereNull('parent_id')->get()->sortBy("name");
        foreach ($specialities as $key => $speciality) {
            $speciality->ids = $speciality->id;
            if ($speciality->children->count() > 0) {
                $childIDs = $speciality->children->pluck('id')->implode(',');
                // foreach($speciality->children as $child_spe){
                //     $id .= ",".$child_spe->id;
                // }
                $speciality->ids .= ',' . $childIDs;
                $speciality->child = $speciality->children;
                $this->getChild($specialities, $speciality->children);
            }
        }
        return $specialities;
    }

    public function getChild(&$specialities, &$speciality)
    {
        $id = null;
        foreach ($speciality as $key => $sp) {
            $sp->ids = $sp->id;
            if ($sp->children->count() > 0) {
                $childID2s = $sp->children->pluck('id')->implode(',');
                // foreach($sp->children as $child_spe){
                //     $id .= ",".$child_spe->id;
                // }
                $sp->ids .=',' . $childID2s;
                $sp->child = $sp->children;
                $this->getChild($specialities, $sp->children);
            }
            
        }
    }
}
