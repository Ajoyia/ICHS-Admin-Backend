<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMELecturePresentationFormat extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='cme_lecture_presentation_formats';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function cme_lectures(){
        return $this->hasMany(CMELecture::class,'cme_application_id','id');
    }
}
