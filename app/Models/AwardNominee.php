<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardNominee extends Model
{
    use HasFactory, SoftDeletes;
 
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by','id');
    }
    public function deletedBy(){
        return $this->belongsTo(User::class,'deleted_by','id');
    }

    public function nominee_votes(){
        return $this->hasMany(NomineeVote::class, 'nominee_id', 'id');
    }

    public function getVoteCounts()
    {
        return $this->nominee_votes->count();
    }

    public function award()
    {
        return $this->belongsTo(Award::class, 'award_id', 'id');
    }


    public function award_type()
    {
        return $this->belongsTo(AwardType::class, 'award_type_id', 'id');
    }

    public function nominee()
    {
        return $this->belongsTo(User::class, 'nominee_id', 'id');
    }
    
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id', 'id');
    }
}
