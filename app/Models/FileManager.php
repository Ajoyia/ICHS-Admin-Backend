<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FileManager extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'label',
        'name',
        'referance_id',
        'file_type',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function getNameAttribute($name)
    {
        if($name)
            return Storage::url($name);
        else
            return '';
    }
}