<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'status',
        'data',
        'link',
        'total_amount',
        'net_amount',
        'vat',
        'currency',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'promo_code_id',
        'discount',
        'gross',
        'currency_rate',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

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
}
