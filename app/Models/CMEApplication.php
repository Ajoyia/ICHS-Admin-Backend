<?php

namespace App\Models;

use App\Models\CMEActivity;
use Illuminate\Support\Facades\Storage;
use App\Models\CMESocialEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CMEApplication extends Model
{
    use HasFactory, SoftDeletes;


    protected $table='cme_applications';

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
    public function CMEActivity(){
        return $this->belongsTo(CMEActivity::class,'cme_activity_id','id');
    }
    public function activity_administrators(){
        return $this->hasMany(CMEActivityAdministrator::class,'cme_application_id','id');
    }
    public function all_activity_administrators(){
        return $this->hasMany(CMEActivityAdministrator::class,'cme_application_id','id');
    }
    public function CMELearningFormates(){
        return $this->belongsToMany(CMELearningFormate::class,'cme_application_learning_formate','cme_application_id','cme_learning_formate_id')->whereNull('cme_application_learning_formate.deleted_at');
    }
    public function CMESocialEvents(){
        return $this->belongsToMany(CMESocialEvent::class,'cme_application_social_events','cme_application_id','cme_social_event_id')->whereNull('cme_application_social_events.deleted_at');
    }
    public function target_audiences(){
        return $this->hasMany(CMEApplicationTargetAudience::class,'cme_application_id','id');
    }
    public function educational_gaps(){
        return $this->hasMany(EducationalGap::class,'cme_application_id','id');
    }
    public function speakers(){
        return $this->hasMany(CMESpeaker::class,'cme_application_id','id');
    }
    public function allSpeakers(){
        return $this->hasMany(CMESpeaker::class,'cme_application_id','id');
    }
    public function locations(){
        return $this->hasMany(CMELocation::class,'cme_application_id','id');
    }
    public function sessions(){
        return $this->hasMany(CMESession::class,'cme_application_id','id');
    }
    public function lectures(){
        return $this->hasMany(CMELecture::class,'cme_application_id','id');
    }
    public function CMEApplicationPromotionActivities(){
        return $this->belongsToMany(CMEPromotionActivity::class,'cme_application_promotion_activity','cme_application_id','cme_promotion_activity_id')->whereNull('cme_application_promotion_activity.deleted_at');
    }
    public function CMEActivityTime(){
        return $this->hasMany(CMEActivityTime::class,'cme_application_id','id');
    }

    public function cme_activity_administrators_specialties(){
        return $this->hasMany(CMEActivityAdministratorSpecialty::class,'cme_application_id','id');
    }

    public function cme_product(){
        return $this->belongsTo(CMEProduct::class,'cme_product_id','id');
    }

    public function url()
    {
        return $this->morphMany(Url::class, 'application');
    }

    public function application_signature()
    {
        return $this->morphMany(ApplicationSignature::class, 'model');
    }

    public function remarks()
    {
        return $this->morphMany(Remark::class, 'model')->orderBy('id', 'desc');
    }

    public function cme_completion_forms()
    {
        return $this->hasOne(CMECompletionForm::class, 'cme_application_id');
    }

    public function cme_application_medical_professionals()
    {
        return $this->hasMany(CMEApplicationMedicalProfessional::class, 'cme_application_id');
    }

    public function allLocations(){
        return $this->hasMany(CMELocation::class,'cme_application_id','id');
    }
    public function allSessions(){
        return $this->hasMany(CMESession::class,'cme_application_id','id');
    }

    public function getSessionsUploadAttribute($value)
    {
        if($value)
            return Storage::url($value);
    }

}
