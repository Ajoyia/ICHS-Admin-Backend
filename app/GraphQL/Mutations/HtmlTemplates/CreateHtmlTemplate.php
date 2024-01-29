<?php

namespace App\GraphQL\Mutations\HtmlTemplates;
use App\Models\HtmlTemplate;
use Illuminate\Support\Facades\Storage;

final class CreateHtmlTemplate
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $filename = Storage::putFile('/html_templates/images',$args['image']);

        $template = HtmlTemplate::create([
            'name' => $args['name'],
            'content' => $args['content'],
            'image' => $filename,
        ]);
        // $args['image']->storePublicly('images\html-templates');
        return $template;
    }
}
