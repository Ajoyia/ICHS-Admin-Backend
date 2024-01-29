<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Membership extends Model
{
    use HasFactory,SoftDeletes;

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function membership_publications()
    {
        return $this->hasMany(MembershipPublication::class,'membership_id','id');
    }


    public function all_membership_publications()
    {
        return $this->membership_publications();
    }

    public function membership_innovation_initiatives()
    {
        return $this->hasMany(MembershipInnovationInitiative::class,'membership_id','id');
    }


    public function all_membership_innovation_initiatives()
    {
        return $this->membership_innovation_initiatives();
    }

    public function membership_research_activities()
    {
        return $this->hasMany(MembershipResearchActivity::class,'membership_id','id');
    }


    public function all_membership_research_activities()
    {
        return $this->membership_research_activities();
    }


    public function membership_organizations()
    {
        return $this->hasOne(MembershipOrganization::class,'membership_id','id');
    }


    public function product_country_type()
    {
        return $this->belongsTo(ProductCountryType::class,'product_country_type_id','id');
    }

    public function invoice()
    {
        return $this->morphMany(Invoice::class, 'model');
    }

    public function receipt()
    {
        return $this->morphMany(Receipt::class, 'model');
    }


     public function getResumaDownloadAttribute()
    {
        if($this->resume != null){
            return Storage::url($this->resume);

        }else {
            return null;
        }
    }
}
