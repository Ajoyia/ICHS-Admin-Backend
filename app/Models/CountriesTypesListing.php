<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesTypesListing extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='countries_types_listing';

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id','id');
    }
    public function country_type()
    {
        return $this->belongsTo(CountriesType::class,'country_type_id','id');
    }
}
