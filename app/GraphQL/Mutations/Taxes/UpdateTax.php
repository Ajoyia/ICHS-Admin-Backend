<?php

namespace App\GraphQL\Mutations\Taxes;
use App\Models\Tax;

final class UpdateTax
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $page = Tax::find($args['id']);
       
        $page->name = $args['name'];
        if($args['tax_group_id'])
            $page->tax_group_id = (int)$args['tax_group_id'];
        else
            $page->tax_group_id = null;   
        if($args['rate'])
            $page->rate = (double)$args['rate'];
        else
            $page->rate = null;  
        $page->save();
        
        return $page;
    }
}
