<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory,SoftDeletes;
    
    public function users(){
        return $this->hasMany(User::class,'country_id','id');
    }
    public function paginated_users()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
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

    public function region(){
        return $this->belongsTo(Region::class,'region_id','id');
    }
    
    public function states(){
        return $this->hasMany(State::class,'country_id','id');
    }

    public function cme_applications(){
        return $this->hasMany(CMEApplication::class,'country_id','id');
    }

    public function country_states(){
        return $this->hasMany(State::class,'country_id','id')->orderBy('name', 'ASC');
    }

    public function country_types(){
        return $this->belongsToMany(CountriesType::class,'countries_types_listing','country_id','country_type_id')->whereNull('countries_types_listing.deleted_at');
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_countries', 'country_id', 'chapter_id')->whereNull('chapter_countries.deleted_at');
    }
}
