<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCountryType extends Model
{
    use HasFactory;

    use HasFactory,SoftDeletes;

    protected $table='product_country_type';

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

    public function country_type(){
        return $this->belongsTo(CountriesType::class,'country_type_id','id');
    }

    public function membershipTypes(){
        return $this->belongsTo(MembershipType::class,'membership_type_id','id');
    }

    public function tax_group(){
        return $this->belongsTo(TaxGroup::class,'tax_group_id','id');
    }

}
