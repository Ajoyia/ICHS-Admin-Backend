<?php

namespace App\GraphQL\Mutations\HtmlTemplates;
use App\Models\HtmlTemplate;
use Illuminate\Support\Facades\Storage;

final class UpdateHtmlTemplate
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['image'] ;

        $template = HtmlTemplate::find($args['id']);
        $template->name = $args['name'];
        $template->content = $args['content'];
        if($file!=null){
            $template->image = Storage::putFile('/html_templates/images',$args['image']);
        }
        $template->save();
    }
}
