<?php

namespace App\GraphQL\Queries\Users;

use App\Models\IvlnCourse;
use App\Models\IvlnSection;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class GetUserTypes
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return config('variables.user_types');
    }
}
