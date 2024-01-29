<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'rate',
        'tax_group_id',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

    public function tax_group(){
        return $this->belongsTo(TaxGroup::class,'tax_group_id','id');
    }
    
}
