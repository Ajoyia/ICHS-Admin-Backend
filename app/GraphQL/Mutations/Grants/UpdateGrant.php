<?php

namespace App\GraphQL\Mutations\Grants;

use App\Models\Grant;
use Illuminate\Support\Facades\Storage;

final class UpdateGrant
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if (isset($args['id'])) {
            $grant = Grant::find($args['id']);
        }
        if (isset($args['other_specialty'])) {
            $grant->other_specialty = $args['other_specialty'];
        }
        if (isset($args['executive_director_name'])) {
            $grant->executive_director_name = $args['executive_director_name'];
        }
        if (isset($args['executive_director_phone_no'])) {
            $grant->executive_director_phone_no = $args['executive_director_phone_no'];
        }
        if (isset($args['executive_director_email'])) {
            $grant->executive_director_email = $args['executive_director_email'];
        }
        if (isset($args['program_director_name'])) {
            $grant->program_director_name = $args['program_director_name'];
        }
        if (isset($args['program_director_phone_no'])) {
            $grant->program_director_phone_no = $args['program_director_phone_no'];
        }
        if (isset($args['program_director_email'])) {
            $grant->program_director_email = $args['program_director_email'];
        }
        if (isset($args['organization'])) {
            $grant->organization = $args['organization'];
        }
        if (isset($args['year_founded'])) {
            $grant->year_founded = $args['year_founded'];
        }
        if (isset($args['country_id'])) {
            $grant->country_id = $args['country_id'];
        }
        if (isset($args['state_id'])) {
            $grant->state_id = $args['state_id'];
        }
        if (isset($args['city_id'])) {
            $grant->city_id = $args['city_id'];
        }
        if (isset($args['zip_code'])) {
            $grant->zip_code = $args['zip_code'];
        }
        if (isset($args['organization_vision'])) {
            $grant->organization_vision = $args['organization_vision'];
        }
        if (isset($args['organization_history'])) {
            $grant->organization_history = $args['organization_history'];
        }
        if (isset($args['outline_current_activities'])) {
            $grant->outline_current_activities = $args['outline_current_activities'];
        }
        if (isset($args['accomplishments'])) {
            $grant->accomplishments = $args['accomplishments'];
        }
        if (isset($args['activity'])) {
            $grant->activity = $args['activity'];
        }
        if (isset($args['start_date'])) {
            $grant->start_date = $args['start_date'];
        }
        if (isset($args['end_date'])) {
            $grant->end_date = $args['end_date'];
        }
        if (isset($args['activity_goals'])) {
            $grant->activity_goals = $args['activity_goals'];
        }
        if (isset($args['executive_summary'])) {
            $grant->executive_summary = $args['executive_summary'];
        }
        if (isset($args['chapter_id'])) {
            $grant->chapter_id = $args['chapter_id'];
        }
        if (isset($args['beneficiaries_number'])) {
            $grant->beneficiaries_number = $args['beneficiaries_number'];
        }
        if (isset($args['specialities'])) {
            $grant->specialities = $args['specialities'];
        }
        if (isset($args['benefiting_area'])) {
            $grant->benefiting_area = $args['benefiting_area'];
        }
        if (isset($args['expenses_amount'])) {
            $grant->expenses_amount = $args['expenses_amount'];
        }
        if (isset($args['revenue_amount'])) {
            $grant->revenue_amount = $args['revenue_amount'];
        }
        if (isset($args['requested_amount'])) {
            $grant->requested_amount = $args['requested_amount'];
        }
        if (isset($args['expenses_file_path']) && $args['expenses_file_path'] != null) {
            $grant->expenses_file_path = Storage::putFile('/grants/expenses_files', $args['expenses_file_path']);
        }
        if (isset($args['revenues_file_path']) && $args['revenues_file_path'] != null) {
            $grant->revenues_file_path = Storage::putFile('/grants/revenues_files', $args['revenues_file_path']);
        }
        if (isset($args['grant_expenses_file_path']) && $args['grant_expenses_file_path'] != null) {
            $grant->grant_expenses_file_path = Storage::putFile('/grants/grant_expenses_files', $args['grant_expenses_file_path']);
        }
        if (isset($args['initials_director'])) {
            $grant->initials_director = $args['initials_director'];
        }
        if (isset($args['initials_executive_director'])) {
            $grant->initials_executive_director = $args['initials_executive_director'];
        }
        if (isset($args['agreement_accepted'])) {
            $grant->agreement_accepted = $args['agreement_accepted'];
        }
        if (isset($args['user_id'])) {
            $grant->user_id = $args['user_id'];
        }
        if (isset($args['grantPurpose_id'])) {
            $grant->grant_purpose_id = $args['grantPurpose_id'];
        }
        if (isset($args['approved'])) {
            $grant->approved = $args['approved'];
        }
        if (isset($args['grant_reason'])) {
            $grant->grant_reason = $args['grant_reason'];
        }
        if (isset($args['educational_activity_type_other'])) {
            $grant->educational_activity_type_other = $args['educational_activity_type_other'];
        }
        if (isset($args['specify_type_other'])) {
            $grant->specify_type_other = $args['specify_type_other'];
        }
        if (isset($args['submission_status'])) {
            $grant->submission_status = $args['submission_status'];
        }
        if (isset($args['status'])) {
            $grant->status = $args['status'];
        }
        $grant->save();
        return $grant;
    }
}
