<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lecture;
use App\Models\IvlnCourse;
use App\Models\IvlnSpeakersLecture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnSpeaker extends Model
{
    use HasFactory,SoftDeletes;
    public function courses(){
        return $this->belongsTo(IvlnCourse::class,'course_id','id');
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
    public function ivlnLectureSpeaker(){
        return $this->hasMany(IvlnSpeakersLecture::class,'speaker_id','id');
    }
    public function lectureSpeakers(){
        return $this->belongsToMany(Lecture::class,'ivln_speakers_lectures','speaker_id','lecture_id')->whereNull('ivln_speakers_lectures.deleted_at');
    }
    public function getImageAttribute($value)
    {
        return ($value)? Storage::url($value) : null;
    }
}
