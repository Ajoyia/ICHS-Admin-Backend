<?php

namespace App\Models;

use App\Models\User;
use App\Models\IvlnCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnSupporter extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='discamus_supporters';

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
    public function getImageAttribute($value)
    {
        return ($value)? Storage::url($value) : null;
    }
}
