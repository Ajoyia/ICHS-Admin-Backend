<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMESession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='cme_sessions';

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

    public function cme_lectures(){
        return $this->hasMany(CMELecture::class,'cme_session_id','id');
    }

    public function session_speaker()
    {
        return $this->morphMany(CMESessionSpeaker::class, 'model');
    }
}