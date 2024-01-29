<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccredationSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='accredation_sessions';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function accredation_application(){
        return $this->belongsTo(AccredationApplication::class,'acc_id','id');
    }

    // public function accredation_lectures(){
    //     return $this->hasMany(AccredationLecture::class,'accredation_session_id','id');
    // }

    public function session_speaker()
    {
        return $this->morphMany(AccredationSessionSpeaker::class, 'model');
    }
}