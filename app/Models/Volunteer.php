<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chapter;
use App\Models\VolunteerType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer extends Model
{
    use HasFactory,SoftDeletes;
    public function region(){
        return $this->belongsTo(Chapter::class,'region_id','id');
    }
    public function chapter(){
        return $this->belongsTo(Chapter::class,'chapter_id','id');
    }
    public function volunteerType(){
        return $this->belongsTo(VolunteerType::class,'volunteer_type_id','id');
    }

    
    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
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
