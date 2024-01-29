<?php

namespace App\Models;

use App\Models\Language;
use App\Models\IvlnFavorite;
use App\Models\IvlnSpeakersLecture;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecture extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    protected $table="ivln_lectures";

    public function section(){
        return $this->belongsTo(IvlnSection::class,'section_id','id');
    }

    public function course(){
        return $this->belongsTo(IvlnCourse::class,'course_id','id');
    }

    public function lectureType(){
        return $this->belongsTo(IvlnLecturesType::class,'lecture_type_id','id');
    }

    public function lectureTypesVideoOnly(){
        return $this->belongsTo(IvlnLecturesType::class,'lecture_type_id','id');
    }

    public function speakers(){
        return $this->belongsToMany(IvlnSpeaker::class,'ivln_speakers_lectures','lecture_id','speaker_id')->whereNull('ivln_speakers_lectures.deleted_at');
    }

    public function lectureFavorite(){
        return $this->morphMany(IvlnFavorite::class, 'model');
    }

    public function ivlnLectureSpeaker(){
        return $this->hasMany(IvlnSpeakersLecture::class,'lecture_id','id');
    }

    public function language(){
        return $this->belongsTo(Language::class,'language_id','id');
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

    public function isMyFavorite(){
        if(Auth::user()&&isset($this->id)){
            $myFav=IvlnFavorite::where('user_id',Auth::user()->id)
                ->where('model_id',$this->id)
                ->where('model_type','App\\Models\\Lecture')
                ->first();
            if($myFav)
                return 1;
            else
                return 0;
        }
        else
            return 0;
    }
}
