<?php

namespace App\GraphQL\Mutations\Taxes;
use App\Models\Tax;

final class DeleteTax
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $template = Tax::find($args['id']);
        
        $template->delete();
    }
}
