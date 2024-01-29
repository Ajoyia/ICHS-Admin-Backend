<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipOrganization extends Model
{
    use HasFactory;
    // protected $table="membership_organizations";
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
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
    public function membership(){
        return $this->belongsTo(Membership::class,'membership_id','id');
    }
    public function headQuaterCountry(){
        return $this->belongsTo(Country::class,'headquarter_country_id','id');
    }
    public function branchCountry(){
        return $this->belongsTo(Country::class,'branch_country_id','id');
    }
    public function headQuaterCity(){
        return $this->belongsTo(City::class,'headquarter_city_id','id');
    }
    public function branchCity(){
        return $this->belongsTo(Country::class,'branch_city_id','id');
    }
    public function headQuaterState(){
        return $this->belongsTo(State::class,'headquarter_state_id','id');
    }
    public function branchState(){
        return $this->belongsTo(State::class,'branch_state_id','id');
    }
}
