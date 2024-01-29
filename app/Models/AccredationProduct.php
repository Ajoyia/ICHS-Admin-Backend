<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccredationProduct extends Model
{

    use HasFactory,SoftDeletes;

    protected $table= 'accredation_products';
    protected $fillable = [
        'product_id',
        'description',
        'price',
        'country_type_id',
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

    public function country_type()
    {
        return $this->belongsTo(CountriesType::class, 'country_type_id', 'id');
    }

    public function accredation_applications(){
        return $this->hasMany(AccredationApplication::class,'accredation_product_id','id');
    }

}
