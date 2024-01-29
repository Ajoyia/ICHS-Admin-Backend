<?php

namespace App\Models;

use App\Models\CMESpeaker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccredationSessionSpeaker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='accredation_session_speakers';
    protected $fillable = [
        'role_id',
        'acc_speakers_id',
        'model_type',
        'model_id',
        'acc_id',
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
    public function accredation_application(){
        return $this->belongsTo(AccredationApplication::class,'acc_id','id');
    }
    public function model(){
        return $this->morphTo();
    }
    public function role(){
        return $this->belongsTo(CMESpeakerRole::class,'role_id','id');
    }
    public function speaker(){
        return $this->belongsTo(AccredationSpeaker::class,'acc_speakers_id','id');
    }
}
