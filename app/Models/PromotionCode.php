<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['promotion_type',
                         'value',
                         'promotion_code',
                         'usage_limit',
                         'error_message_line1',
                         'error_message_exceeded',
                         'approved_by',
                         'valid_from',
                         'valid_to',
                         'description',
                         'status',
                         'created_by',
                         'updated_by'];

    protected $appends = ['valid_from_date','valid_to_date'];


    public function getValidFromDateAttribute()
    {
        return  date('Y-m-d', strtotime($this->valid_from));
    }

    public function getValidToDateAttribute()
    {
        return  date('Y-m-d', strtotime($this->valid_to));
    }

    public function promotionCodeProduct()
    {
        return $this->hasMany(PromotionCodeProduct::class,'promotion_code_id','id');
    }

}
