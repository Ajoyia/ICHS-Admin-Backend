<?php

namespace App\GraphQL\Mutations\StaticPages;
use App\Models\StaticPage;

final class DeleteStaticPage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $template = StaticPage::find($args['id']);
        
        $template->delete();
    }
}
