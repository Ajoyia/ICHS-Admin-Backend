<?php

namespace App\GraphQL\Queries\JICHS;

use Carbon\Carbon;;
use App\Models\Log as ModelsLog;
use App\Models\JournalApplication;
use Illuminate\Support\Facades\Auth;

final class findJICHS
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       $journal = JournalApplication::find($args['id']);
       $log=new ModelsLog();
       if(!isset($args['admin'])){
            $log->user_id=Auth::user()->id;
            $log->model_type='App\\Models\\JournalApplication';
            $log->model_id=$journal->id;
            $log->created_by=Auth::user()->id;
            $log->save();
        }
        $journal->views=ModelsLog::where('model_type','App\\Models\\JournalApplication')
            ->where('model_id',$journal->id)
            ->count();
        return $journal;
    }
}
