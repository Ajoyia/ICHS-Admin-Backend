<?php

namespace App\GraphQL\Mutations\AccredationActivityAdministrator;

use App\Models\AccredationActivityAdministrator;
use Illuminate\Support\Carbon;

final class updateAccredationActivityAdministratorSigned
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $administrator =  AccredationActivityAdministrator::find($args['id']); 
        $administrator->is_policy_agreement_signed =$args['is_policy_agreement_signed'];
        $administrator->policy_agreement_email_sent_date = Carbon::now();
        $administrator->save();
        
        return "done";
    }
}
