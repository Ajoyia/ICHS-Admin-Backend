<?php

namespace App\Models;

use App\Models\CMERole;
use App\Models\CMESpeaker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMESessionSpeaker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='cme_session_speakers';

    protected $fillable = [
        'role_id',
        'cme_speakers_id',
        'model_type',
        'model_id',
        'cme_application_id',
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
    public function cme_application(){
        return $this->belongsTo(CMEApplication::class,'cme_application_id','id');
    }
    public function model(){
        return $this->morphTo();
    }
    public function role(){
        return $this->belongsTo(CMESpeakerRole::class,'role_id','id');
    }
    public function speaker(){
        return $this->belongsTo(CMESpeaker::class,'cme_speakers_id','id');
    }
}
