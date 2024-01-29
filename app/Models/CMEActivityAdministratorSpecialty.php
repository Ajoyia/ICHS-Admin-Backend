<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMEActivityAdministratorSpecialty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='cme_activity_administrators_specialties';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
   
    public function cme_application(){
        return $this->belongsTo(CMEApplication::class,'deleted_by','id'); 
    }
    
    public function model(){
        return $this->morphTo();
    }
    
}
