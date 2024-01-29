<?php

namespace App\GraphQL\Queries\Variables;

final class GetAllVariables
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return config('variables');
    }
}
