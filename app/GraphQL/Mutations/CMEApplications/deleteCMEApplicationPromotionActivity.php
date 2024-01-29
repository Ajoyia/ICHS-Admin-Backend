<?php

namespace App\GraphQL\Mutations\CMEApplications;

use App\Models\CMEApplicationPromotionActivity;
use Illuminate\Support\Facades\Auth;
use App\Models\CMEApplicationSocialEvent;

final class deleteCMEApplicationPromotionActivity
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        CMEApplicationPromotionActivity::where('cme_application_id',$args['cme_id'])->where('cme_promotion_activity_id',$args['promotion_id'])->delete();
        return 'done';
    }
}
