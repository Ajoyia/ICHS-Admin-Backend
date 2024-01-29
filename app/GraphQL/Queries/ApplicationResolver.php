<?php

namespace App\GraphQL\Queries;

use stdClass;
use App\Models\CMEApplication;
use Illuminate\Support\Facades\DB;
use App\Models\HealthInnovationInitiative;

final class ApplicationResolver
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme = DB::table('cme_applications')
            ->select('statuses_id', DB::raw('count(*) as total'))
            ->groupBy('statuses_id')
            ->get();
        $cme = $this->checkStatus($cme);
        $hii = DB::table('health_innovation_initiatives')
            ->select('statuses_id', DB::raw('count(*) as total'))
            ->groupBy('statuses_id')
            ->get();
        $hii = $this->checkStatus($hii);
        $jichs = DB::table('journal_applications')
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->get();
        $jichs = $this->checkStatus($jichs, true);
        $accredation = DB::table('accredation_applications')
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->get();
        $accredation = $this->checkStatus($accredation, true);
        $grant = DB::table('grants')
            ->select('submission_status', DB::raw('count(*) as total'))
            ->groupBy('submission_status')
            ->get();

        // Creating an object
        $AllApplications = new stdClass();

        // Property added to the Object
        $AllApplications->cme = $cme;
        $AllApplications->hii = $hii;
        $AllApplications->jichs = $jichs;
        $AllApplications->accredation = $accredation;
        $AllApplications->grant = $grant;

        // $object = (object)
        // Dont change Order
        $object = ["cme"=>$cme, "hii"=>$hii, "jichs"=>$jichs,"accredation"=>$accredation, "grant"=>$grant];

        // return json_encode($object);
        return $object;
        // return $AllApplications;
    }

    public function checkStatus($object, $flag = null)
    {
        //new, approved, rejected, pending
        $status = [1, 2, 3, 6];
        if($flag == null){
            $missingfield = array_diff($status,$object->pluck('statuses_id')->toArray());
            foreach ($missingfield as $key => $value) {
                $object[] = (object)["statuses_id"=>$value, "total"=>0];
            }
            
            return $object->sortBy('statuses_id')->values();
        }else if($flag != null){
            $missingfield = array_diff($status,$object->pluck('status_id')->toArray());
            foreach ($missingfield as $key => $value) {
                $object[] = (object)["status_id"=>$value, "total"=>0];
            }
            return $object->sortBy('status_id')->values();
        }
    }
}
