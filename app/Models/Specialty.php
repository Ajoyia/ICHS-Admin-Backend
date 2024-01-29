<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
        'created_by',
        'deleted_by',
        'updated_by',
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'parent_id', 'id');
    }

    public function sub_specialties()
    {

        return $this->belongsTo(Specialty::class, 'parent_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_specialties', 'speciality_id', 'user_id');
    }

    public function ancestor_speciality()
    {
        return Specialty::whereNull('parent_id')->get();
    }

    public function parent()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Specialty::class, 'parent_id');
    }

    public function secondChildren()
    {
        return $this->children()->with('secondChildren');
    }
    public function allainces(){
        return $this->belongsToMany(Alliance::class,'alliance_specialities','speciality_id','alliance_id')->wherePivotNull('deleted_at');
    }
}
