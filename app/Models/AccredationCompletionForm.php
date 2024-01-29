<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccredationCompletionForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='accredation_completion_forms';

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
        return $this->belongsTo(AccredationApplication::class,'acc_id','id');
    }
    public function accredation_learners(){
        return $this->hasMany(AccredationLearner::class,'completion_form_id','id');
    }
    public function completed_forms(){
        return $this->cme_application()::where('is_completed',1)->get();
    }

    public function getPdfPathAttribute($value)
    {

        if($value)
            return Storage::url($value);
        else
            return $value;
    }

}
