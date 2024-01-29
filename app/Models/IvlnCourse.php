<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rating;
use App\Models\IvlnTag;
use App\Models\Lecture;
use App\Models\Specialty;
use App\Models\IvlnSection;
use App\Models\IvlnSpeaker;
use Illuminate\Support\Str;
use App\Models\IvlnFavorite;
use App\Models\IvlnSupporter;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnCourse extends Model
{
    use HasFactory,SoftDeletes;
    public function sections(){
        return $this->hasMany(IvlnSection::class,'course_id','id');
    }
    public function supporter(){
        return $this->hasMany(IvlnSupporter::class,'course_id','id');
    }
    public function allSupporter(){
        return $this->hasMany(IvlnSupporter::class,'course_id','id');
    }
    public function allSections(){
        return $this->hasMany(IvlnSection::class,'course_id','id');
    }
    public function lectures(){
        return $this->hasMany(Lecture::class,'course_id','id');
    }
    public function allLectures(){
        return $this->hasMany(Lecture::class,'course_id','id');
    }
    public function speakers(){
        return $this->hasMany(IvlnSpeaker::class,'course_id','id');
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
    public function courseRating(){
        return $this->morphMany(Rating::class, 'model');
    }
    public function courseFavorite(){
        return $this->morphMany(IvlnFavorite::class, 'model');
    }
    public function specialities(){
        return $this->belongsToMany(Specialty::class,'ivln_course_specialities','ivln_course_id','specialty_id')->whereNull('ivln_course_specialities.deleted_at');
    }
    public function ivlnTags(){
        return $this->belongsToMany(IvlnTag::class,'ivln_course_ivln_tags','ivln_course_id','ivln_tag_id')->whereNull('ivln_course_ivln_tags.deleted_at');
    }

    public function getThumbnailAttribute($thumbnail)
    {
        if(strpos($thumbnail,"://")){
            return $thumbnail;
        }
        else if($thumbnail)
            return Storage::url($thumbnail);
        else
            return Storage::url('ivln_courses_thumbnails/images/Black_Background.png');
    }
    public function avgRating(){
        $course=$this->withAvg('courseRating','rating')->first();
        return round($course->course_rating_avg_rating,2);
    }
}
