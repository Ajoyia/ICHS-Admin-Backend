<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMEProduct extends Model
{

    use HasFactory,SoftDeletes;

    protected $table='cme_products';
    protected $fillable = [
        'product_id',
        'description',
        'price',
        'hour_from',
        'hour_to',
        'per_certificate_price',
        'tax_group_id',
        'is_published',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
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

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function cme_applications(){
        return $this->hasMany(CMEApplication::class,'cme_product_id','id');
    }

    public function country_types(){
        return $this->belongsToMany(CountriesType::class,'product_country_type_listing','cme_product_id','country_type_id')->whereNull('product_country_type_listing.deleted_at');
    }


    public function product_country_type(){
        return $this->hasMany(ProductCountryTypeListing::class,'cme_product_id','id');
    }
}
