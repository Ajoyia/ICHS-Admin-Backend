<?php

namespace App\GraphQL\Mutations\StaticPages;
use App\Models\StaticPage;
use Illuminate\Support\Str;

final class UpdateStaticPage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        
        $page = StaticPage::find($args['id']);
       
        $page->title = $args['title'];
        if($args['slug'])
            $page->slug = $args['slug'];
        else
            $page->slug = Str::slug($args['title']);
        $page->detail = $args['detail'];
        if($args['parent_id'])
            $page->parent_id = (int)$args['parent_id'];
        else
            $page->parent_id = null;
        $page->save();
        
        return $page;
    }
}
