<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMEPromotionActivity extends Model
{
    use HasFactory, SoftDeletes;


    protected $table='cme_promotion_activity';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function CMEApplications(){
        return $this->belongsToMany(CMEApplication::class,'cme_application_promotion_activity','cme_promotion_activity_id','cme_application_id')->whereNull('cme_application_promotion_activity.deleted_at');
    }
}
