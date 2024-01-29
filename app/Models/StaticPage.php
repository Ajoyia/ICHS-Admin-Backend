<?php

namespace App\Models;

use App\Services\FindCodes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaticPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['content'];

    protected $fillable = [
        'title',
        'detail',
        'slug',
        'parent_id',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function MenuItems(){
        return $this->hasMany(MenuItem::class,'static_page_id','id');
    }

    public function static_pages(){
        return $this->belongsTo(StaticPage::class,'parent_id','id');
    }


    public function getContentAttribute()
    {
        $obj=new FindCodes($this->detail);
        return $obj->findMergeCode();  
    }

    public function tags()
    {
        return $this->hasOne(TagKeyWord::class,'page_id','id');
    }

    
}
