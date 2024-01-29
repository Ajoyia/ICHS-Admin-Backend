<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'method',
        'card_no',
        'note',
        'payment_status',
        'status',
        'invoice_id',
        'receipt_id',
        'total_amount',
        'total_amount_in_usd',
        'deleted_by',
        'updated_by'
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
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
    public function reciept(){
        return $this->belongsTo(Invoice::class,'receipt_id','id');
    }
    public function model(){
        return $this->morphTo();
    }
}
