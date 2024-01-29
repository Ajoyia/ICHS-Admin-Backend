<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

final class DecryptUrlId
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info($args['id']);
        $id = Crypt::decrypt($args['id']);
        return $id;
    }
}
