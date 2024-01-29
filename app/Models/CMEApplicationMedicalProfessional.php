<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMEApplicationMedicalProfessional extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='cme_application_medical_professionals';
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
        return $this->belongsTo(CMEApplication::class,'cme_application_id','id');
    }

    public function parent_medical(){
        return $this->belongsTo(MedicalHealthProfessional::class,'medical_parent_id','id');
    }

    public function child_medical(){
        return $this->belongsTo(MedicalHealthProfessional::class,'medical_child_id','id');
    }




}
