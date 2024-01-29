<?php

namespace App\GraphQL\Mutations\AccredationApplications;

use App\Models\AccredationApplicationPromotionActivity;
use Illuminate\Support\Facades\Auth;
use App\Models\AccredationApplicationSocialEvent;

final class deleteAccredationApplicationPromotionActivity
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        AccredationApplicationPromotionActivity::where('acc_id',$args['acc_id'])->where('promotion_activity_id',$args['promotion_activity_id'])->delete();
        return 'done';
    }
}
