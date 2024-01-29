<?php

namespace App\Models;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function menu_items(){
        return $this->hasMany(MenuItem::class,'type_id','id')->whereNull('parent_id')->where('status','=',1)->orderBy('order', 'ASC');
    }
    
}
