<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MedicalHealthProfessional extends Model
{
    use HasFactory, SoftDeletes;

    public function medical_health_professional(){
        return $this->belongsTo(MedicalHealthProfessional::class,'parent_id','id');
    }

    public function medical_health_professionals(){
        return $this->hasMany(MedicalHealthProfessional::class,'parent_id','id');
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
}
