<?php

namespace App\Models;

use App\Models\User;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPolicy extends Model
{
    use HasFactory,SoftDeletes;
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function policy(){
        return $this->belongsTo(Policy::class,'policy_id','id');
    }
}
