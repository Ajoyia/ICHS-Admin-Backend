<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='countries_type';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function countries(){
        return $this->belongsToMany(Country::class,'countries_types_listing','country_type_id','country_id')->whereNull('countries_types_listing.deleted_at');
    }

    public function cme_products(){
        return $this->belongsToMany(CMEProduct::class,'product_country_type_listing','country_type_id','cme_product_id')->whereNull('product_country_type_listing.deleted_at');
    }

    public function product_country_types(){
        return $this->hasMany(ProductCountryType::class,'country_type_id','id');

    }

    public function not_included_countries(){
        return Country::doesntHave('country_types')->get();
    }

    public function countries_types_listing()
    {
        return $this->hasMany('App\Models\CountriesTypesListing','country_type_id','id');
    }

}
