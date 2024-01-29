<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMELearner extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='cme_learners';
    
    protected $fillable = [
        'completion_form_id',
        'first_name',
        'last_name',
        'degree',
        'credit_hours_awarded',
        'unique_reference_id',
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

    public function cme_completion_form(){
        return $this->belongsTo(CMECompletionForm::class,'completion_form_id','id');
    }
}
