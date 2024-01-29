<?php

namespace App\GraphQL\Mutations\CMEActivityAdministrator;

use Illuminate\Support\Carbon;
use App\Models\CMEActivityAdministrator;

final class updateCMEActivityAdministratorSigned
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $administrator =  CMEActivityAdministrator::find($args['id']); 
        $administrator->is_policy_agreement_signed =$args['is_policy_agreement_signed'];
        $administrator->policy_agreement_email_sent_date = Carbon::now();
        $administrator->save();
        
        return "done";
    }
}
