<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccredationApplicationTargetAudience extends Model
{
    use HasFactory, SoftDeletes;


    protected $table= 'acc_target_audiences';
    protected $appends = ['speciality_ids'];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function accredation_application(){
        return $this->belongsTo(AccredationApplication::class, 'acc_application_id','id');
    }

    public function accredation_target_audience(){
        return $this->belongsTo(AccredationTargetAudience::class,'audience_type','id');
    }

    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'target_audience_specialties', 'target_audience_id', 'speciality_id');
    }
    public function targetAudienceSpecialty()
    {
        return $this->hasMany(AccredationTargetAudienceSpecialty::class, 'target_audience_id');
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->targetAudienceSpecialty->pluck('speciality_id');
    }
}
