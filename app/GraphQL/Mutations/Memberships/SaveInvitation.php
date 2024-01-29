<?php

namespace App\GraphQL\Mutations\Memberships;

use App\Models\MembershipInnovationInitiative;
use App\Models\MembershipResearchActivity;
use App\Models\MembershipOrganization;
use App\Models\MembershipPublication;
use App\Models\ProductCountryType;
use App\Models\UserExperience;
use App\Models\Membership;
use App\Models\User;
use Carbon\Carbon;
use Auth;

final class SaveInvitation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

		
	    $user = User::where('email',$args['email'])->first();
	    if(!empty($user)){
		    $user->first_name=$args['first_name'];
		    $user->last_name=$args['last_name'];
		    $user->mobile_no=$args['mobile_no'];
		    
		    $user->address=$args['address'];
		    $user->password=bcrypt($args['password']);
		    $user->job_title=$args['job_title'];
		    $user->organization=$args['organization'];
		    $user->city_id=$args['city_id'];
		    $user->nationality_id=$args['nationality_id'];
		    $user->country_id=$args['country_id'];
		    $user->state_id=$args['state_id'];
		    $user->created_by=$user->id;
		    $user->updated_by=$user->id;
		    $user->is_accept=true;
		    $user->invitation_token=null;
		    $user->save();

		    foreach($args['speciality_id'] as $sp){
            $array = explode(',', $sp);
	            foreach($array as $speciality){
	            
	                \DB::table('user_specialties')->insert(
	                    ['user_id'=>$user->id, 'speciality_id'=>$speciality]
	                );
	            }
        	}

	        $user_experiencesInput=json_decode($args['user_experiences'],true);
	        UserExperience::where('user_id',$user->id)->delete();
	        for($i=0;$i< count($user_experiencesInput);$i++){
	            $userExperiences=new UserExperience();
	            $userExperiences->user_id= $user->id;
	            $userExperiences->company_name=$user_experiencesInput[$i]["company_name"];
	            $userExperiences->jobs_responsibility=$user_experiencesInput[$i]["jobs_responsibility"];
	            $userExperiences->start_date=$user_experiencesInput[$i]["start_date"];
	            $userExperiences->end_date=$user_experiencesInput[$i]["end_date"];
	            $userExperiences->save();
	        }

	        /* get parent information*/
	          
	          	$parent_membership = Membership::where(['user_id'=>$user->parent_id,'status'=>1])->first();
	          	if(!empty($parent_membership)){
		            $membership = new Membership();
		           	$now = Carbon::now();
		            $membership->user_id = $user->id;
		            $membership->medical_facility = $args['medical_facility'];
		            $membership->medical_interests= $args['medical_interests'];
		            $membership->created_by = $user->id;
		            $membership->membership_id = $now->year.'-ICHS-'.$membership->id;
		            $membership->start_date=Carbon::now()->toDateTimeString();
		            $membership->end_date=$parent_membership->end_date;
					$membership->status=1;

		            $membership->membership_type_id = $parent_membership->membership_type_id;
		            $membership->product_country_type_id = $parent_membership->product_country_type_id;
	           
		        }

	           
	            if(isset($args['resume']) && $args['resume']!=null){
	                // $template->image = Storage::putFile('/html_templates/images',$args['image']);
	                $membership->resume=\Storage::putFile('/membership/resume',$args['resume']);
	            }
	             $membership->save();
	             $now = Carbon::now();
	             $membership->membership_id = $now->year.'-ICHS-'.$membership->id;
	             $membership->save();

	            if(array_key_exists('membership_publications', $args)  ){                
	                $membershipPublications=json_decode($args['membership_publications'],true);
	                MembershipPublication::where('membership_id',$membership->id)->delete();
	                for($i=0;$i<count($membershipPublications);$i++){
	                    $mpublication=new MembershipPublication();
	                    $mpublication->name=$membershipPublications[$i]['name'];
	                    $mpublication->membership_id=$membership->id;
	                    $mpublication->status=1;
	                    $mpublication->created_by=$user->id;
	                    $mpublication->save();
	                }
	            }
	            if(array_key_exists('membership_research_activities', $args)  ){
	                $membershipResearchActivity=json_decode($args['membership_research_activities'],true);
	                MembershipResearchActivity::where('membership_id',$membership->id)->delete();
	                for($i=0;$i<count($membershipResearchActivity);$i++){
	                    $mResearchActivity=new MembershipResearchActivity();
	                    $mResearchActivity->name=$membershipResearchActivity[$i]['name'];
	                    $mResearchActivity->membership_id=$membership->id;
	                    $mResearchActivity->status=1;
	                    $mResearchActivity->created_by=$user->id;
	                    $mResearchActivity->save();
	                }
	            }
	            if(array_key_exists('membership_innovation_initiatives', $args)  ){
	                $membershipInnovationInitiative=json_decode($args['membership_innovation_initiatives'],true);
	                MembershipInnovationInitiative::where('membership_id',$membership->id)->delete();
	                for($i=0;$i<count($membershipInnovationInitiative);$i++){
	                    $mInnovationInitiative=new MembershipInnovationInitiative();
	                    $mInnovationInitiative->name=$membershipInnovationInitiative[$i]['name'];
	                    $mInnovationInitiative->membership_id=$membership->id;
	                    $mInnovationInitiative->status=1;
	                    $mInnovationInitiative->created_by=$user->id;
	                    $mInnovationInitiative->save();
	                }
	            }
	            return json_encode(['status'=>true,"message"=>"Membership created successfully"]);
	        }else{
	        	 return json_encode(['status'=>false,"message"=>"data not found"]);
	        }
      
    }
}