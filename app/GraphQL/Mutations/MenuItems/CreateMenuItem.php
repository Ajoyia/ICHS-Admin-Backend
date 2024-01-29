<?php

namespace App\GraphQL\Mutations\MenuItems;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Storage;

final class CreateMenuItem
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $item = new MenuItem;
        
        $item->name = $args['name'];
        if($args['icon']!=null)
            $item->icon =  Storage::putFile('/menu_items/icons',$args['icon']);
        $item->link = $args['link'];
        if($args['parent_id'])
            $item->parent_id = (int)$args['parent_id'];
        if($args['order'])
            $item->order = (int)$args['order'];
        if($args['static_page_id'])
            $item->static_page_id = (int)$args['static_page_id'];
        if($args['type_id'])
            $item->type_id = (int)$args['type_id'];
        if($args['page_type'])
            $item->page_type = $args['page_type'];
        
        $item->status = $args['status'];
        $item->save();
        
        return $item;
    }
}