<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Specialty;
use App\Models\VerifyUser;

class TestController extends Controller
{
    public function index(&$elements=null, $parentId = 0)
    {
        $specialities = Specialty::all();
        foreach($specialities as $speciality){
            if(count($speciality->children) > 0){
                $cchildIDs = $speciality->children->pluck('id');
                $childIDs = $speciality->children->pluck('id')->implode(',');
                $speciality->ids = $speciality->id . ',' . $childIDs;
                foreach($cchildIDs as $cchildID){
                    $specialities2 = Specialty::find($cchildID);
                    if(count($specialities2->children)>0){
                        $cchildID2s =  $specialities2->children->pluck('id');
                        $childID2s =  $specialities2->children->pluck('id')->implode(',');
                        $speciality->ids .= ',' . $childID2s;
                        foreach($cchildID2s as $cchildID2){
                            $specialities3 = Specialty::find($cchildID2);
                            if(count($specialities3->children)>0){
                                $cchildID3s =  $specialities3->children->pluck('id');
                                $childID3s =  $specialities3->children->pluck('id')->implode(',');
                                $speciality->ids .= ',' . $childID3s;
                            }
                        }
                    }

                }

                                
            }
        }
        dd($specialities->find(75));
        // foreach($speciality as &$element){
        //     if($element->parent_id == $parentId ){
        //         $children = $this->index($speciality, $element->id);
        //         if ($children) {
        //             $element['children'] = $children;
        //         }
        //         $branch[$element->id] = $element;
        //         unset($element);
        //     }
        // }
        dump($branch);
        // $verifyUser = VerifyUser::where('token', "22dc7f5ddf3203157610f3c2e945a2d81f80ddde")->first();
        // $exp_date = $verifyUser->updated_at->addHour();
        // $current_date_time = Carbon::now()->toDateTimeString();
        // // dd($current_date_time, $exp_date, $verifyUser->updated_at, ($current_date_time < $exp_date));

        // $user = User::with('verifyUser')->findOrFail(92);
        // if ($user->verifyUser === null) {
        //     $verifyUser = VerifyUser::create([
        //         'user_id' => $user->id,
        //         'token' => sha1(time()),
        //     ]);
        // } else {
        //     $verifyUser = $user->verifyUser;
        //     $verifyUser->token = sha1(time());
        //     $verifyUser->save();
        // }
        // if ($user) {
        //     $user->sendEmail();
        //     return 'Verification email sent!';
        // }

        // $array = [];
        // $specialities = Specialty::whereNull('parent_id')->get();
        // foreach ($specialities as $key => $speciality) {
        //     if ($speciality->children->count() > 0) {
        //         $speciality->child = $speciality->children;
        //         $this->getChild($specialities, $speciality->children);
        //     }
        // }
        // return $specialities;
    }

    public function getChild(&$specialities, &$speciality)
    {
        // foreach ($speciality as $key => $sp) {
        //     if ($sp->children->count() > 0) {
        //         $sp->child = $sp->children;
        //         $this->getChild($specialities, $sp->children);
        //     }
        // }
        // dd($speciality);
        // if ($speciality->children->count() > 0) {
        //     $speciality->child = $speciality->children;
        //     $this->getChild($specialities, $speciality->children);
        // }
    }

    // public function index(Type $var = null)
    // {
    //     echo "index";
    //     $array = [];
    //     for ($i = 0; $i < $specialities->count(); $i++) {
    //         $array[] = $specialities[$i];
    //         for ($j = 0; $j < $specialities[$i]->children->count(); $j++) {
    //             if (isset($specialities[$i]->children[$j])) {
    //                 $array[] = $specialities[$i]->children[$j];
    //                 $subChild = $specialities[$i]->children[$j]->children;
    //                 for ($k = 0; $k < $subChild->count(); $k++) {
    //                     if (isset($subChild[$k])) {
    //                         $array[] = $subChild[$k];
    //                         $subChild2 = $subChild[$k]->children;
    //                         for ($l = 0; $l < $subChild2->count(); $l++) {
    //                             if (isset($subChild2[$l])) {
    //                                 $array[] = $subChild2[$l];
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     dd($specialities, $array, $specialities[0]->children);

    // }
}
