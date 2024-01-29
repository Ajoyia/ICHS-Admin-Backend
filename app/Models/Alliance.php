<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alliance extends Model
{
    use HasFactory,SoftDeletes;
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
    public function specialities(){
        return $this->belongsToMany(Specialty::class,'alliance_specialities','alliance_id','speciality_id')->wherePivotNull('deleted_at');
    }
    public function users(){
        $id=$this->id;
        return User::whereHas('specialty',function($query) use($id){
            $query->whereHas('allainces',function($q) use($id){
                $q->where('alliances.id',$id);
            });
        })
        ->whereHas('memberships')
        ->get();
    }
}
