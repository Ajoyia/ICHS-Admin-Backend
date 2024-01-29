<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class AccredationSpeaker extends Model
{
    use HasFactory, SoftDeletes, Notifiable;


    protected $table='accredation_speakers';
    
    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'salutation_id',
        'degree',
        'phone_no',
        'is_financial_relation_with_entity',
        'company_name',
        'relation_type',
        'content_area',
        'is_financial_relation_with_content',
        'activity_planned' .
        'order',
        'email',
        'title',
        'application_signed_id',
        'is_policy_agreement_email_sent',
        'policy_agreement_email_sent_date',
        'is_policy_agreement_signed',
        'policy_agreement_signed_date',
        'is_disclosure_email_sent',
        'disclosure_email_sent_date',
        'is_disclosure_signed',
        'disclosure_signed_date',
        'is_approved',
        'entity',
        'designation',
        'bio',
        'image',
        'feature',
        'is_publish',
        'status',
        'country_id',
        'acc_id',
        'created_by',
        'deleted_by',
        'updated_by'
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
    public function accredation_application(){
        return $this->belongsTo(AccredationApplication::class,'acc_id','id');
    }

    public function url()
    {
        return $this->morphMany(Url::class, 'model');
    }

    public function accredation_signature()
    {
        return $this->morphOne(AccredationSignature::class, 'model');
    }
}
