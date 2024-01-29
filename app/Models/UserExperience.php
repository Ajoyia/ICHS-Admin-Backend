<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class UserExperience extends Model
{
    use HasFactory,SoftDeletes;
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // public function jobTitle(){
    //     return $this->belongsTo(JobsTitle::class,'job_title_id','id');
    // }
}
