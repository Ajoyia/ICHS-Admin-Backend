<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory,SoftDeletes;

    public function users(){
        return $this->hasMany(User::class,'city_id','id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function cme_applications(){
        return $this->hasMany(CMEApplication::class,'state_id','id');
    }

    
    public function cities(){
        return $this->hasMany(City::class,'state_id','id');
    }

    public function state_cities(){
        return $this->hasMany(City::class,'state_id','id')->orderBy('name', 'ASC');
    }
}
