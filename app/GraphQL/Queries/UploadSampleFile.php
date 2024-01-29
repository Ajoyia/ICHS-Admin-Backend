<?php

namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Storage;

final class UploadSampleFile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Storage::url('sample_files/cme_learners_sample_file.xlsx');
    }

    
}
