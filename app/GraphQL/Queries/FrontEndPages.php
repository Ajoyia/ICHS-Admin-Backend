<?php

namespace App\GraphQL\Queries;

final class FrontEndPages
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
      return config('front_end_pages');
    }
}
