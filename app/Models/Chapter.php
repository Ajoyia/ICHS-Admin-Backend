<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory,SoftDeletes;
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function endorsements()
    {
        return $this->hasMany(ChapterEndorsement::class, 'chapter_id', 'id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function region() {
    return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'chapter_countries', 'chapter_id', 'country_id')->whereNull('chapter_countries.deleted_at');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chapter_users', 'chapter_id', 'user_id')->whereNull('chapter_users.deleted_at');
    }

    public function all_countries()
    {
        return $this->belongsToMany(Country::class, 'chapter_countries', 'chapter_id', 'country_id')->whereNull('chapter_countries.deleted_at');
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

    public function not_included_countries()
    {
        return Country::doesntHave('chapters')->get();
    }

}
