<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCardDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_card_details';

    protected $fillable = [
        'expiry',
        'card_holder_name',
        'scheme',
        'masked_pan',
        'is_active',
        'model_type',
        'model_id',
        'card_token',
        'recapture_csc',
        'created_by',
        'deleted_by',
        'updated_by'
    ];

}
