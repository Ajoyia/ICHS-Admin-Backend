<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory,SoftDeletes;

   
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function countries(){
        return $this->hasMany(Country::class,'region_id','id');
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'region_id', 'id')->where('is_approved_by_admin',1);
    }
}
