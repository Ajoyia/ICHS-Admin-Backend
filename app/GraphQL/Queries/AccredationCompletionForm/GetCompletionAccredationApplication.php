<?php

namespace App\GraphQL\Queries\AccredationCompletionForm;

use App\Models\AccredationApplication;
use App\Models\AccredationCompletionForm;
use App\Models\CMECompletionForm;
use App\Models\CMEApplication;

final class GetCompletionAccredationApplication
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cme_completion_form_ids = AccredationCompletionForm::where('is_completed',1)->pluck('acc_id');
        $cme_applications = AccredationApplication::whereIn('id',$cme_completion_form_ids);
        return $cme_applications;
    }
    
}