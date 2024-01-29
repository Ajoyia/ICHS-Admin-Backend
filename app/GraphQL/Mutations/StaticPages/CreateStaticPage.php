<?php

namespace App\GraphQL\Mutations\StaticPages;
use App\Models\StaticPage;
use Illuminate\Support\Str;

final class CreateStaticPage
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $page = new StaticPage;

        $page->title = $args['title'];
        $page->slug = Str::slug($args['title']);
        $page->detail = $args['detail'];
        if($args['parent_id'])
            $page->parent_id = (int)$args['parent_id'];
        $page->save();

        return $page;
    }
}
