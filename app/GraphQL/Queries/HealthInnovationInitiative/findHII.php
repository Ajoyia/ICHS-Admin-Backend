<?php

namespace App\GraphQL\Queries\HealthInnovationInitiative;

use Carbon\Carbon;;
use App\Models\Log as ModelsLog;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthInnovationInitiative;
use Illuminate\Support\Facades\Log;

final class findHII
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $hii = HealthInnovationInitiative::find($args['id']);
       $log=new ModelsLog();
       if(!isset($args['admin'])){
            Log::info('logging.....');
            $log->user_id=Auth::user()->id;
            $log->model_type='App\\Models\\HealthInnovationInitiative';
            $log->model_id=$args['id'];
            $log->created_by=Auth::user()->id;
            $log->save();
        }
        $hii->views=ModelsLog::where('model_type','App\\Models\\HealthInnovationInitiative')
            ->where('model_id',$hii->id)
            ->count();
        return $hii;
    }
}
