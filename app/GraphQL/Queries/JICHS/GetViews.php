<?php

namespace App\GraphQL\Queries\JICHS;

use Carbon\Carbon;;
use App\Models\Log as ModelsLog;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthInnovationInitiative;
use Illuminate\Support\Facades\Log;

final class GetViews
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $views=ModelsLog::where('model_type','App\\Models\\JournalApplication')
            ->where('model_id',$args['id'])
            ->count();
        return $views;
    }
}
