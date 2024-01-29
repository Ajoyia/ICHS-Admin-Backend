<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\ActivityAdministratorSpecialty;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccredationActivityAdministrator extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    
    protected $table= 'accredation_activity_administrators';
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
    public function accredation_application()
    {
        return $this->belongsTo(AccredationApplication::class, 'accredation_id','id');
    }
   

    public function accredation_signature()
    {
        return $this->morphOne(AccredationSignature::class, 'model');
    }

    public function accredation_role(){
        return $this->belongsTo(AccredationRole::class,'role_id','id');
    }
    public function speciality(){
        return $this->hasMany(AccredationActivityAdministratorSpecialty::class, 'activity_id');
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->speciality->pluck('speciality_id');
    }
    
}