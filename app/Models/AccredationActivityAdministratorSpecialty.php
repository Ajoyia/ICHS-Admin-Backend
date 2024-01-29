<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccredationActivityAdministratorSpecialty extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'acc_admin_specialties';

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
        return $this->belongsTo(AccredationApplication::class,'deleted_by','id'); 
    }
    
}
