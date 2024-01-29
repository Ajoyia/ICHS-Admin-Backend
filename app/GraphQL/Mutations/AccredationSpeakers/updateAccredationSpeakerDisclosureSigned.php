<?php

namespace App\GraphQL\Mutations\AccredationSpeakers;

use Illuminate\Support\Carbon;
use App\Models\AccredationSpeaker;

final class updateAccredationSpeakerDisclosureSigned
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $administrator = AccredationSpeaker::find($args['id']); 
        $administrator->degree =$args['degree'];
        $administrator->phone_no = $args['phone_no'];
        $administrator->activity_planned = $args['activity_planned'];
        $administrator->is_disclosure_signed = $args['is_disclosure_signed'];
        $administrator->is_financial_relation_with_content = $args['is_financial_relation_with_content'];
        $administrator->is_financial_relation_with_entity = $args['is_financial_relation_with_entity'];
        
        if($args['company_name'])
            $administrator->company_name = $args['company_name'];
        if ($args['content_area'])
            $administrator->content_area = $args['content_area'];
        if ($args['relation_type'])
            $administrator->relation_type = $args['relation_type'];

        $administrator->disclosure_signed_date = Carbon::now();
        $administrator->save();
        
        return "done";
    }
}
