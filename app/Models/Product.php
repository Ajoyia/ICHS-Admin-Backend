<?php

namespace App\Models;

use App\Models\ProductCountryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    public function productCountryTypes(){
        return $this->hasMany(ProductCountryType::class,'product_id','id');
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

    public function cme_products(){
        return $this->hasMany(CMEProduct::class,'product_id','id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'product_id', 'id');
    }

    public function ProductCountryType($productCountryId){
        return ProductCountryType::where('product_id',$this->id)->where('country_type_id',$productCountryId)->first();
    }
}
