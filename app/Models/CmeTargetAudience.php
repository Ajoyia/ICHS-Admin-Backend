<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmeTargetAudience extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='cme_target_audience';
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function cme_application_target_audience(){
        return $this->hasMany(CMEApplicationTargetAudience::class,'audience_type','id');
    }
}
