<?php

namespace App\Models;

use App\Models\City;
use App\Models\State;
use App\Models\Policy;
use App\Models\Country;
use App\Models\JobsTitle;
use App\Models\Specialty;
use App\Models\RoleHourse;
use App\Models\VerifyUser;
use App\Models\Nationality;
use Illuminate\Support\Str;
use App\Models\IvlnFavorite;
use App\Models\PasswordReset;
use App\Models\MembershipType;
use App\Models\SpecialityUser;
use App\Models\TransactionDetail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Notifications\DefaultNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'salutation_id',
        'first_name',
        'last_name',
        'email_verified_at',
        'image',
        'other_specialty',
        'password',
        'organization',
        'mobile_no',
        'country_code',
        'membership_unique_id',
        'address',
        'university',
        'department',
        'city_id',
        'state_id',
        'country_id',
        'nationality_id',
        'job_title',
        'status',
        'email',
        'role_hourse_id',
        'invitation_token',
        'parent_id',
        'is_accept',
        'type',
        'time_zone_id ',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['speciality_ids','link'];

    public function getImageAttribute($value)
    {
        if($value == 'user.png'){
            return $value;
        }else {
            if($value)
                return Storage::url($value);
            else
                return $value;
        }
    }
    public function endorsements(){
        return $this->hasMany(ChapterEndorsement::class,'user_id','id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function user_chapters()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_users', 'user_id', 'chapter_id')->whereNull('chapter_users.deleted_at');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
    public function salutation()
    {
        return $this->belongsTo(Salutation::class, 'salutation_id', 'id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    
    public function cme_applications(){
        return $this->hasMany(CMEApplication::class, 'user_id', 'id');
    }

    public function health_innovation_initiativies()
    {
        return $this->hasMany(HealthInnovationInitiative::class, 'user_id', 'id');
    }

    public function accredation_applications()
    {
        return $this->hasMany(AccredationApplication::class, 'user_id', 'id');
    }

    public function grants()
    {
        return $this->hasMany(Grant::class, 'user_id', 'id');
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class, 'user_id', 'id');
    }

    public function journals()
    {
        return $this->hasMany(JournalApplication::class, 'user_id', 'id');
    }
    public function roleHourse()
    {
        return $this->belongsTo(RoleHourse::class, 'role_hourse_id', 'id');
    }
    public function policies()
    {
        return $this->belongsToMany(Policy::class, 'user_policies', 'user_id', 'policy_id')->whereNull('user_policies.deleted_at');
    }

    public function notAssignedPolicies()
    {
        $id = $this->id;
        $policiesOfOtherUsers = Policy::with('users')->whereHas('users', function ($query) use ($id) {
            $query->where('users.id', '!=', $id)
                ->orWhereNotNull('user_policies.deleted_at')
                ->where('user_policies.user_id', '!=', $id);
        })->get();

        $policiesWithoutAssignies = Policy::doesntHave('users')->get();
        $policies = new \Illuminate\Database\Eloquent\Collection;
        $policies = $policies->merge($policiesOfOtherUsers);
        $policies = $policies->merge($policiesWithoutAssignies);

        return $policies;
    }
    public function assignedToOthersPolicies()
    {
        return Policy::has('users')->get();
    }

    public function specialty()
    {
        return $this->belongsToMany(Specialty::class, 'user_specialties', 'user_id', 'speciality_id')->wherePivotNull('deleted_at');
    }
    public function specialityUser()
    {
        return $this->hasMany(SpecialityUser::class);
        // return $this->specialty->pluck('id');
    }
    public function getSpecialityIdsAttribute()
    {
        return $this->specialityUser->pluck('speciality_id');
    }
    public function userExperiences()
    {
        return $this->hasMany(UserExperience::class, 'user_id', 'id');
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'user_id', 'id');
    }
    public function membership()
    {
        return $this->belongsTo(MembershipType::class, 'membership_unique_id', 'id');
    }
    public function ivlnAttendance(){
        return $this->hasMany(IvlnAttendanceUser::class,'user_id','id');
    }
    public function memberships()
    {
        return $this->hasOne(Membership::class,'user_id','id')->whereNotNull('end_date')->whereDate('end_date','>=', (Carbon::today())->toDateString())->orderBy('end_date', 'DESC')->where('status','1');
    }

    public function memberships_all()
    {
        return $this->hasOne(Membership::class,'user_id','id')->whereDate('end_date','>=', (Carbon::today())->toDateString())->orderBy('end_date', 'DESC')->where('status','1');
    }

    public function expiredMembership()
    {
        return $this->hasOne(Membership::class,'user_id','id')
            ->whereDate('end_date','<=', (Carbon::today())->toDateString())
            ->orderBy('end_date', 'DESC')
            ->where('status','1')
            ->orWhereNull('end_date')
            ->orderBy('id','DESC');
    }

    public function allMemberships(){
        return $this->hasOne(Membership::class,'user_id','id');
    }
    public function trancastions(){
        return $this->hasMany(TransactionDetail::class,'user_id','id');
    }
    public function ivlnFavorites(){
        return $this->hasMany(IvlnFavorite::class,'user_id','id');
    }
    public function timeZone(){
        return $this->belongsTo(TimeZone::class,'time_zone_id','id');
    }
    //////Non relarional functions///////////
    public function getDegreeFilePathAttribute($value)
    {
        if ($value)
            return Storage::url($value);
        else
            return $value;

    }
    public function notifyMe()
    {
        $notification = AutomatedNotification::where(['status' => 1])->whereNull('deleted_at')->first();

        if (!empty($notification) && !empty($notification->message)) {
            $tempalte = Str::of($notification->message)->replace('{{first_name}}', $this->first_name);

            $tempalte = Str::of($tempalte)->replace('{{mobile_no}}', $this->mobile_no);

            $tempalte = Str::of($tempalte)->replace('{{id}}', $this->id);

            $notification->title = Str::of($notification->title)->replace('{{id}}', $this->id);

            $this->notify(new DefaultNotification($tempalte, $notification->subject, $this->first_name, 'itadmin@index.ae'));

        }

    }
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }
    public function forgetPassword()
    {
        return $this->hasOne(PasswordReset::class);
    }

    public function sendEmail()
    {
        $verify_user = VerifyUser::where('user_id',$this->id)->first();
        $verficationUrl = env('APP_FRONT_END', 'http://localhost:3000/');
        $verficationUrl .= "email-verified" . "?";
        if($verify_user!=null){

            $verficationUrl .= "token=" . $verify_user->token;
            $notification = AutomatedNotification::where('type', "sign_up")->whereNull('deleted_at')->first();
            if (!empty($notification) && !empty($notification->message)) {

                $tempalte = Str::of($notification->message)->replace(
                    [ '{{first_name}}', '{{last_name}}', '{{email}}', '{{token}}'],
                    [$this->first_name, $this->last_name, $this->email, $verficationUrl]
                );
                if($notification->notification_sender->from_email){
                    $email_from = $notification->notification_sender->from_email;
                } else{
                        $email_from = 'itadmin@index.ae';
                }
                $this->notify(new DefaultNotification($tempalte,
                    $notification->subject,
                    $this->first_name,
                    $email_from
                ));
            }
        }
    }
    public function resetPassword($client)
    {
        // """
        // The url used to reset the password.
        // Use the `__EMAIL__` and `__TOKEN__` placeholders to inject the reset password email and token.

        // e.g; `https://my-front-end.com?reset-password?email=__EMAIL__&token=__TOKEN__`
        // """
        if($client == 'admin'){

            $verficationUrl = env('APP_ADMIN_SIDE', 'https://devad.ichs.uk/');
        } else {

            $verficationUrl = env('APP_FRONT_END', 'http://localhost:3000/');
        }

        $password_reset = PasswordReset::where('user_id',$this->id)->first();
        $verficationUrl .= "reset-password" . "?";
        // $verficationUrl .= "email=" . $this->email;
        $verficationUrl .= "&token=" . $password_reset->token;
        if($password_reset!=null){

            $notification = AutomatedNotification::where('type', "password_reset")->whereNull('deleted_at')->first();
            if (!empty($notification) && !empty($notification->message)) {

                $tempalte = Str::of($notification->message)->replace(
                    [ '{{first_name}}', '{{last_name}}', '{{email}}', '{{url}}'],
                    [$this->first_name, $this->last_name, $this->email, $verficationUrl]
                );
                if($notification->notification_sender->from_email){
                    $email_from = $notification->notification_sender->from_email;
                } else{
                        $email_from = 'itadmin@index.ae';
                }
                $this->notify(new DefaultNotification($tempalte,
                    $notification->subject,
                    $this->first_name,
                    $email_from
                ));
            }
        }
    }
    /* for membership invitation */

    public function generateInvitationToken() {
        $this->invitation_token = substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }


    public function getLinkAttribute() {
        return urldecode(env('SUCESS_URL') . '/invitation?invitation_token=' . $this->invitation_token);
    }

    public function getAlliances(){
        $id=$this->id;
        return Alliance::whereHas('specialities',function($query) use($id){
            $query->whereHas('users',function($q) use($id){
                $q->where('users.id',$id);
            });
        })->get();
    }

}
