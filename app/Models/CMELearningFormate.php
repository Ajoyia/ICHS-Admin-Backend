<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMELearningFormate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='cme_learning_formate';
    protected $fillable = [
        'name',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function CMEApplications(){
        return $this->belongsToMany(CMEApplication::class,'cme_application_learning_formate','cme_learning_formate_id','cme_application_id');
    }
}
