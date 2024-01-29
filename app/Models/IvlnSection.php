<?php

namespace App\Models;

use App\Models\IvlnFavorite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IvlnSection extends Model
{
    use HasFactory,SoftDeletes;
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function ivlnLectures(){
        return $this->hasMany(Lecture::class,'section_id','id');
    }
    public function sectionFavorite(){
        return $this->morphMany(IvlnFavorite::class, 'model');
    }
    public function isMyFavorite(){
        $myFav=IvlnFavorite::where('user_id',Auth::user()->id)
            ->where('model_id',$this->id)
            ->where('model_type','App\\Models\\IvlnSection')
            ->first();
        // Log::info($myFav);
        if($myFav)
            return 1;
        else
            return 0;
    }
}
