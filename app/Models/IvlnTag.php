<?php

namespace App\Models;

use App\Models\IvlnCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnTag extends Model
{
    use HasFactory,SoftDeletes;

    public function ivlnCourses(){
        return $this->belongsToMany(IvlnCourse::class,'ivln_course_ivln_tags','ivln_tag_id','ivln_course_id')->whereNull('ivln_course_ivln_tags.deleted_at');
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
