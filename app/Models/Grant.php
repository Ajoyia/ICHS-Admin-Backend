<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\Chapter;
use App\Models\GrantPurpose;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grant extends Model
{
    use HasFactory,SoftDeletes;
    protected $appends = ['speciality_ids'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function chapter(){
        return $this->belongsTo(Chapter::class,'chapter_id','id');
    }
    public function grantPurpose(){
        return $this->belongsTo(GrantPurpose::class,'grant_purpose_id','id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function remarks()
    {
        return $this->morphMany(Remark::class, 'model')->orderBy('id', 'desc');
    }

    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'grant_specialties', 'grant_id', 'speciality_id');
    }
    public function grantSpecialty()
    {
        return $this->hasMany(GrantSpecialty::class);
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->grantSpecialty->pluck('speciality_id');
    }

    public function getExpensesFilePathAttribute($value)
    {
        if(!is_null($value))
            return Storage::url($value);
        else
            return $value;

    }

    public function getRevenuesFilePathAttribute($value)
    {
        if(!is_null($value))
            return Storage::url($value);
        else
            return $value;

    }
    public function getGrantExpensesFilePathAttribute($value)
    {
        if(!is_null($value))
            return Storage::url($value);
        else
            return $value;

    }
}
