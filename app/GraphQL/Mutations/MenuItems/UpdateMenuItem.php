<?php

namespace App\GraphQL\Mutations\MenuItems;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Storage;

final class UpdateMenuItem
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        \Log::info($args);
        $item = MenuItem::find($args['id']);
        $item->name = $args['name'];
        if($args['icon']!=null)
            $item->icon =  Storage::putFile('/menu_items/icons',$args['icon']);

        $item->link = $args['link'];
        if($args['parent_id']!="")
            $item->parent_id = (int)$args['parent_id'];
        else
            $item->parent_id = null;
        if($args['static_page_id']!="")
            $item->static_page_id = (int)$args['static_page_id'];
        else
            $item->static_page_id = null;
        if($args['type_id']!="")
            $item->type_id = (int)$args['type_id'];
        else
            $item->type_id = null;
        if($args['order'])
            $item->order = (int)$args['order'];
        else
            $item->order = null;


        if($args['page_type'])
            $item->page_type = $args['page_type'];
        else
            $item->page_type = null;



        
            $item->status = $args['status'];
        
        
        $item->save();
        return $item;
    }
}
