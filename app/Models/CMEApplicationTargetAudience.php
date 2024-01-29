<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMEApplicationTargetAudience extends Model
{
    use HasFactory, SoftDeletes;


    protected $table='cme_application_target_audience';
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

    public function cme_application(){
        return $this->belongsTo(CMEApplication::class,'cme_application_id','id');
    }

    public function cme_target_audience(){
        return $this->belongsTo(CmeTargetAudience::class,'audience_type','id');
    }

    public function cme_role(){
        return $this->belongsTo(CMERole::class,'role_id','id');
    }

    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'target_audience_specialties', 'target_audience_id', 'speciality_id');
    }
    public function targetAudienceSpecialty()
    {
        return $this->hasMany(TargetAudienceSpecialty::class, 'target_audience_id');
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->targetAudienceSpecialty->pluck('speciality_id');
    }
}
