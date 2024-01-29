<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMELecture extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='cme_lectures';

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

    public function presentation_format(){
        return $this->belongsTo(CMELecturePresentationFormat::class,'presentation_format_id','id');
    }

    public function interactive_technology(){
        return $this->belongsTo(CMELectureInteractiveTechnology::class,'interactive_technology_id','id');
    }
    
    public function audio_visual(){
        return $this->belongsTo(CMELectureAudioVisual::class,'audio_visual_id','id');
    }

    public function cme_session(){
        return $this->belongsTo(CMESession::class,'cme_application_id','id');
    }

    public function session_speaker()
    {
        return $this->morphMany(CMESessionSpeaker::class, 'model');
    }

    public function lecture_location()
    {
        return $this->hasOne(CMELocation::class, 'id','session_location_id');
    }
    public function lecture_interactive_technology()
    {
        return $this->belongsToMany(CMELectureInteractiveTechnology::class, 'lecture_interactive_technologies', 'lecture_id','lit_id');
    }
    public function lecture_audio_visual()
    {
        return $this->belongsToMany(CMELectureAudioVisual::class, 'lecture_audio_visuals', 'lecture_id','lecture_audio_visuals_id');
    }
    
}