<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'link',
        'icon',
        'static_page_id',	            
        'parent_id',
        'type_id',
        'order',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    // protected static function booted() 
    // {
    //     static::addGlobalScope('ancient', function (Builder $builder) { 
    //         $builder->where('status', '=', 1); 
    //     }); 
    // }

    public function menu_items(){
        return $this->belongsTo(MenuItem::class,'parent_id','id')->where('status','=',1)->orderBy('order', 'ASC');
    }

    public function menu_type(){
        return $this->belongsTo(MenuType::class,'type_id','id');
    }

    public function static_page(){
        return $this->belongsTo(StaticPage::class,'static_page_id','id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->where('status','=',1)->orderBy('order', 'ASC');
    }
    
}