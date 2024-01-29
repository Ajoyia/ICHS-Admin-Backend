<?php

namespace App\GraphQL\Queries\Lectures;

use App\Models\Lecture;
use Illuminate\Support\Facades\Storage;

final class getFilePath
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $ivlnLecture=Lecture::find($args['id']);
        return Storage::url($ivlnLecture->file_path);
    }
}
