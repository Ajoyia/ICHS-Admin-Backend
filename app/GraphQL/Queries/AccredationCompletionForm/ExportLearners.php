<?php

namespace App\GraphQL\Queries\AccredationCompletionForm;

use App\Models\CMECompletionForm;
use App\Models\CMEApplication;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LearnersExport;
use App\Models\AccredationCompletionForm;
use App\Models\CMELearner;
use Illuminate\Support\Facades\Storage;

final class ExportLearners
{
    
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info($args['acc_id']);
        $completion_form = AccredationCompletionForm::where('acc_id',$args['acc_id'])
                        ->where('is_completed',1)
                        ->first();
        Excel::store(new LearnersExport($completion_form->id), 'export_files/' . time() . '.xlsx');
        return Storage::url('export_files/' . time() . '.xlsx');
    }
}