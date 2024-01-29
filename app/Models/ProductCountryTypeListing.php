<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCountryTypeListing extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='product_country_type_listing';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function country_type()
    {
        return $this->belongsTo(CountriesType::class, 'country_type_id','id');
    }
    public function cme_product()
    {
        return $this->belongsTo(CMEProduct::class,'cme_product_id','id');
    }
}
