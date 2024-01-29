<?php

namespace App\GraphQL\Mutations\AccredationSpeakers;

use Illuminate\Support\Carbon;
use App\Models\AccredationSpeaker;

final class updateAccredationSpeakerSigned
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $administrator = AccredationSpeaker::find($args['id']); 
        $administrator->is_policy_agreement_signed =$args['is_policy_agreement_signed'];
        $administrator->policy_agreement_email_sent_date = Carbon::now();
        $administrator->save();
        
        return "done";
    }
}
