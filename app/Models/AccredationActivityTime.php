<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccredationActivityTime extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='accredation_activity_times';
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function AccredationApplication(){
        return $this->belongsTo(AccredationApplication::class,'accredation_application_id','id');
    }
    

}
