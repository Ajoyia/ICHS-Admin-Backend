<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationSignature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'model_id',
        'model_type',
        'signature_path',
        'pdf_path',
        'signature_type',
        'signature_unique_id',
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

    public function getPdfPathAttribute($value)
    {

        if($value)
            return Storage::url($value);
        else
            return $value;
    }

}
