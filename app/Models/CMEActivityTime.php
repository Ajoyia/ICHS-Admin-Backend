<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMEActivityTime extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='cme_activity_time';
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function CMEApplication(){
        return $this->belongsTo(CMEApplication::class,'cme_application_id','id');
    }
    // public function getStartTimeAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/y H:i');
    // }
    // public function getEndTimeAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/y H:i');
    // }

}
