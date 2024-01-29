<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='urls';

    protected $fillable = [
        'model_type',
        'model_id',
        'application_type',
        'application_id',
        'created_by',
        'updated_by',
        'deleted_by'
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
   
    public function model(){
        return $this->morphTo();
    }

    public function application(){
        return $this->morphTo();
    }

}