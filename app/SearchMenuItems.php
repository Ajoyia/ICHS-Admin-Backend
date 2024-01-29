<?php
namespace App;
use Illuminate\Support\Facades\Log;

class SearchMenuItems {
    /**
     * @param  \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder  $builder
     * @param  array<string, mixed>  $whereConditions
     */
    public function __invoke(object $builder, array $whereConditions): void
    {
        if(count($whereConditions['OR']) > 0){

            // TODO make calls to $builder depending on $whereConditions
            // $builder->join('menu_types','menu_items.type_id','=','menu_types.id')
            // ->select(
            //     'menu_types.name as menu_types_name',
            //     'menu_types.id as menu_types_id',
            //     'menu_items.id as id',
            //     'menu_items.name as name',
            //     'menu_items.name as name',
            //     'menu_items.link as link',
            //     'menu_items.icon as icon',
            //     'menu_items.static_page_id as static_page_id',
            //     'menu_items.parent_id as parent_id',
            //     'menu_items.type_id as type_id',
            //     'menu_items.order as order',
            //     'menu_items.status as status',
            //     'menu_items.created_by as created_by',
            //     'menu_items.updated_by as updated_by',
            //     'menu_items.deleted_by as deleted_by',
            //     'menu_items.created_at as created_at',
            //     'menu_items.updated_at as updated_at',
            //     'menu_items.deleted_at as deleted_at',
            //     )
            // ->whereNull('menu_items.deleted_at')
            // ->where('menu_items.name','like',$whereConditions['OR'][0]['value'])
            // ->orWhere('menu_items.link','like',$whereConditions['OR'][0]['value'])
            // ->orWhere('menu_types.name','like',$whereConditions['OR'][0]['value']);
        }
    }

}
