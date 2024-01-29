<?php

namespace App\GraphQL\Mutations\CMESpeakers;

use Illuminate\Support\Carbon;
use App\Models\CMESpeaker;

final class updateCMESpeakerSigned
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $administrator = CMESpeaker::find($args['id']); 
        $administrator->is_policy_agreement_signed =$args['is_policy_agreement_signed'];
        $administrator->policy_agreement_email_sent_date = Carbon::now();
        $administrator->save();
        
        return "done";
    }
}
