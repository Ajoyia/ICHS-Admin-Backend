<?php

namespace App\GraphQL\Mutations\Blogs;

use App\Models\Tag;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $blog = new Blog;
        if(isset($args['blog_title'])){
            $blog->title = $args['blog_title'];
        }
        if(isset($args['body'])){
            $blog->body = $args['body'];
        }
        if(isset($args['description'])){
            $blog->description = $args['description'];
        }
        if(isset($args['feature'])){
            $blog->feature = $args['feature'];
        }
        if(isset($args['image'])){
            $file = $args['image'];
            if($file!=null){
                $blog->image =  Storage::putFile('/blog/images',$args['image']);
            }
        }
        $blog->user_id = Auth::id();
        $blog->updated_by = Auth::id();
        $blog->created_by = Auth::id();
        $blog->save();
        $tag_id = [];

        if(isset($args['tag_title'])){
            $arr = explode(", ",$args['tag_title']);
            for ($i=0; $i < count($arr) ; $i++) { 
                $tag = new Tag;
                $tag->title = $arr[$i];
                $tag->save();
                $tag_id[] = $tag->id;
            }
            $blog->tags()->sync($tag_id);
        }

    }
}
