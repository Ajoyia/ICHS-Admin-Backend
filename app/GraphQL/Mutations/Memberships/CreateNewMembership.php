<?php

namespace App\GraphQL\Mutations\Memberships;

use App\Models\JobsTitle;
use App\Models\Membership;
use App\Models\MembershipInnovationInitiative;
use App\Models\MembershipOrganization;
use App\Models\MembershipPublication;
use App\Models\MembershipResearchActivity;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\ProductCountryType;

final class CreateNewMembership
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user=Auth::user();
        if(!is_null($user->memberships)){
            $membership = $user->memberships;
        }
        else if($user->expiredMembership){
            $membership=Auth::user()->expiredMembership;
            $membership->end_date=null;
        }
        else{
            $membership = new Membership();
        }
        $membership->user_id = $user->id;
        $membership->tab = $args['tab'];
        $membership->medical_facility = $args['medical_facility'];
        $membership->medical_interests= $args['medical_interests'];
        $membership->created_by = $user->id;

        if($args['product_country_type_id']!=null){
            $product_country_type = ProductCountryType::where('id',$args['product_country_type_id'])->first();
            $membership->membership_type_id = $product_country_type->membership_type_id;
            $membership->product_country_type_id = $args['product_country_type_id'];

        }


        if($args['resume']!=null){

            // $template->image = Storage::putFile('/html_templates/images',$args['image']);
            $membership->resume=Storage::putFile('/membership/resume',$args['resume']);
        }
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
            membershipInnovationInitiative::where('membership_id',$membership->id)->delete();
            for($i=0;$i<count($membershipInnovationInitiative);$i++){
                $mInnovationInitiative=new MembershipInnovationInitiative();
                $mInnovationInitiative->name=$membershipInnovationInitiative[$i]['name'];
                $mInnovationInitiative->membership_id=$membership->id;
                $mInnovationInitiative->status=1;
                $mInnovationInitiative->created_by=$user->id;
                $mInnovationInitiative->save();
            }
        }
        if($membership->membership_type_id==2){

            $memberOrganization=new MembershipOrganization();
            MembershipOrganization::updateOrCreate(['membership_id'=>$membership->id],
                            ['user_id' => $user->id,
                                'membership_id' => $membership->id,
                                'name' => $args['organization_name'],
                                'brief_overview' => $args['organization_brief_overview'],
                                'headquarter_address' => $args['organization_headquarter_address'],
                                'headquarter_country_id' => $args['headquarter_country_id'],
                                'headquarter_state_id' => $args['headquarter_state_id'],
                                'headquarter_city_id' => $args['headquarter_city_id'],
                                'organization_website' => $args['organization_website'],
                                'branch_address' => $args['branch_address'],
                                'branch_country_id' => $args['branch_country_id']
                            ]);
        }
        $u=User::find($user->id);
        if(isset($args['degree_file'])&&!is_null($args['degree_file'])){
            $u->degree_file_path=Storage::putFile('/user/degrees',$args['degree_file']);
        }
        if(isset($args['degree_type'])&&!is_null($args['degree_type'])){
            $u->degree_type=$args['degree_type'];
        }
        $u->save();
        return $membership;

    }
}
