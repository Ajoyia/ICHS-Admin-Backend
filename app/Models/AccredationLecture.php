<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccredationLecture extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='accredation_lectures';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function acc_application(){
        return $this->belongsTo(AccredationApplication::class,'acc_id','id');
    }

    public function presentation_format(){
        return $this->belongsTo(AccredationPresentationFormat::class,'presentation_format_id','id');
    }

    public function interactive_technology(){
        return $this->belongsTo(CMELectureInteractiveTechnology::class,'interactive_technology_id','id');
    }
    
    public function audio_visual(){
        return $this->belongsTo(AccredationLectureAudioVisual::class,'audio_visual_id','id');
    }

    public function acc_session(){
        return $this->belongsTo(AccredationSession::class,'cme_application_id','id');
    }

    public function session_speaker()
    {
        return $this->morphMany(AccredationSessionSpeaker::class, 'model');
    }

    public function lecture_location()
    {
        return $this->hasOne(AccredationLocation::class, 'id','session_location_id');
    }
    public function lecture_interactive_technology()
    {
        return $this->belongsToMany(AccredationInteractiveTechnology::class, 'acc_lecture_interactive_technologies', 'lecture_id','lit_id');
    }
    public function lecture_audio_visual()
    {
        return $this->belongsToMany(AccredationLectureAudioVisual::class, 'acc_lecture_audio_visuals', 'lecture_id','lav_id');
    }
    
}