<?php

namespace App\Models;

use App\Models\IvlnSpeakersLecture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpeakerRole extends Model
{
    use HasFactory,SoftDeletes;

    public function lectureRoles(){
        return $this->belongsToMany(Lecture::class,'ivln_speakers_lectures','role_id','lecture_id')->whereNull('ivln_speakers_lectures.deleted_at');
    }
    public function ivlnLectureSpeaker(){
        return $this->hasMany(IvlnSpeakersLecture::class,'role_id','id');
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
