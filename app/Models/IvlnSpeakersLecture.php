<?php

namespace App\Models;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnSpeakersLecture extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='ivln_speakers_lectures';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function lecture(){
        return $this->belongsTo(Lecture::class,'lecture_id','id');
    }
    public function speaker(){
        return $this->belongsTo(IvlnSpeaker::class,'speaker_id','id');
    }
    public function role(){
        return $this->belongsTo(SpeakerRole::class,'role_id','id');
    }
}
