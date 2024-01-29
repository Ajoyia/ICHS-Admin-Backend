<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\Models\ActivityAdministratorSpecialty;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMEActivityAdministrator extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    
    protected $table='cme_activity_administrators';
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
    public function cme_application()
    {
        return $this->belongsTo(CMEApplication::class,'cme_application_id','id');
    }
    public function url()
    {
        return $this->morphMany(Url::class, 'model');
    }

    public function application_signature()
    {
        return $this->morphOne(ApplicationSignature::class, 'model');
    }

    public function cme_role(){
        return $this->belongsTo(CMERole::class,'role_id','id');
    }
    public function speciality(){
        return $this->hasMany(ActivityAdministratorSpecialty::class, 'activity_id');
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->speciality->pluck('speciality_id');
    }
    
}