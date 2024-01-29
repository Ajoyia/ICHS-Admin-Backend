<?php

namespace App\Models;

use App\Models\CMEActivity;
use Illuminate\Support\Facades\Storage;
use App\Models\CMESocialEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccredationApplication extends Model
{
    use HasFactory, SoftDeletes;


    protected $table= 'accredation_applications';

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
    public function congress_commissioner(){
        return $this->belongsTo(User::class,'congress_commissioner_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function AccredationActivity(){
        return $this->belongsTo(AccredationApplicationActvity::class, 'acc_activity_id ','id');
    }
    public function accredation_activity_administrators(){
        return $this->hasMany(AccredationActivityAdministrator::class,'accredation_id','id');
    }
    public function all_accredation_activity_administrators(){
        return $this->hasMany(AccredationActivityAdministrator::class, 'accredation_id','id');
    }
    public function AccredationLearningFormats(){
        return $this->belongsToMany(AccredationLearningFormat::class, 'accredation_application_learning_formats','acc_id','acc_format_id')->whereNull('accredation_application_learning_formats.deleted_at');
    }
    public function AccredationSocialEvents(){
        return $this->belongsToMany(AccredationSocialEvent::class, 'accredation_application_social_events', 'acc_id', 'acc_social_id')->whereNull('accredation_application_social_events.deleted_at');
    }
    public function AccredationActivities()
    {
        return $this->belongsToMany(AccredationActivity::class, 'accredation_application_activities', 'acc_id', 'acc_activity_id')->whereNull('accredation_application_activities.deleted_at');
    }


    public function accredation_target_audiences(){
        return $this->hasMany(AccredationApplicationTargetAudience::class, 'acc_application_id','id');
    }
    public function educational_gaps(){
        return $this->hasMany(AccredationEducationalGap::class,'acc_application_id','id');
    }
    public function speakers(){
        return $this->hasMany(AccredationSpeaker::class,'acc_id','id');
    }
    public function allAccredationSpeakers(){
        return $this->hasMany(AccredationSpeaker::class,'acc_id','id');
    }
    public function locations(){
        return $this->hasMany(AccredationLocation::class,'acc_id','id');
    }
    public function sessions(){
        return $this->hasMany(AccredationSession::class,'acc_id','id');
    }
    public function lectures(){
        return $this->hasMany(AccredationLecture::class,'acc_id','id');
    }
    public function AccredationPromotionActivities(){
        return $this->belongsToMany(AccredationPromotionActivity::class,'accredation_promotion_activity', 'acc_id','promotion_activity_id')->whereNull('accredation_promotion_activity.deleted_at');
    }
    public function AccredationActivityTime(){
        return $this->hasMany(AccredationActivityTime::class,'accredation_application_id','id');
    }

    public function accredation_product(){
        return $this->belongsTo(AccredationProduct::class, 'accredation_product_id','id');
    }


    public function remarks()
    {
        return $this->morphMany(Remark::class, 'model')->orderBy('id', 'desc');
    }

    public function accredation_completion_forms()
    {
        return $this->hasOne(AccredationCompletionForm::class, 'acc_id');
    }

    public function medical_professionals()
    {
        return $this->hasMany(AccredationMedicalProfessional::class, 'acc_id');
    }

    public function allAccredationLocations(){
        return $this->hasMany(AccredationLocation::class,'acc_id','id');
    }
    public function allAccredationSessions(){
        return $this->hasMany(AccredationSession::class,'acc_id','id');
    }

    public function getSessionsUploadAttribute($value)
    {
        if($value)
            return Storage::url($value);
        else
            return $value;
    }

}
