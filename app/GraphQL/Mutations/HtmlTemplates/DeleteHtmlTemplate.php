<?php

namespace App\GraphQL\Mutations\HtmlTemplates;
use App\Models\HtmlTemplate;

final class DeleteHtmlTemplate
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $template = HtmlTemplate::find($args['id']);        
        $template->delete();
    }
}
