<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMECompletionForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='cme_completion_forms';

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
    public function cme_learners(){
        return $this->hasMany(CMELearner::class,'completion_form_id','id');
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
