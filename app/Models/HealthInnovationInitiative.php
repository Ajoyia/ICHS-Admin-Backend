<?php

namespace App\Models;

use App\Traits\LoggerManager;
use Illuminate\Support\Facades\DB;
use Psy\VersionUpdater\SelfUpdate;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthInnovationInitiative extends Model
{
    use HasFactory,SoftDeletes,LoggerManager;
    protected $table = 'health_innovation_initiatives';


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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function HIITypes()
    {
        return $this->belongsToMany(HealthInnovationInitiativeType::class, 'hii_types', 'hii_id', 'hii_type_id')->whereNull('hii_types.deleted_at');
    }

    // public function hii_authors()
    // {
    //     return $this->hasMany(HIIAuthor::class, 'hii_id', 'id');
    // }

    public function hii_authors()
    {
        return $this->morphMany(HIIAuthor::class, 'authorable');
    }

    public function all_hii_authors()
    {
        return $this->morphMany(HIIAuthor::class, 'authorable');
    }

    public function getFilePathAttribute($value)
    {
        if($value)
            return Storage::url($value);
        else
            return $value;
    }

    public function remarks()
    {
        return $this->morphMany(Remark::class, 'model')->orderBy('id','desc');
    }
    public function transactions()
    {
        return $this->morphMany(TransactionDetail::class, 'model');
    }
    public function logs()
    {
        return $this->morphMany(Log::class, 'model');
    }
    
}
