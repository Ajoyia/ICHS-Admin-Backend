<?php

namespace App\GraphQL\Queries\CMECompletionForm;

use App\Models\CMECompletionForm;
use App\Models\CMEApplication;

final class GetCompletionCMEApplication
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_completion_form_ids = CMECompletionForm::where('is_completed',1)->pluck('cme_application_id');
        $cme_applications = CMEApplication::whereIn('id',$cme_completion_form_ids);
        return $cme_applications;
    }
    
}