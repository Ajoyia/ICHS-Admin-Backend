<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HtmlTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'image',
        'status',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function getImageAttribute($value)
    {
        if($value)
            return Storage::url($value);
        else
            return $value;
    }
}
