<?php

namespace App\GraphQL\Mutations\PromoCode;
use App\Services\PromotionCodeService;

final class GetCode
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $obj= new PromotionCodeService($args);
        return json_encode($obj->retrunMessage());
    }
}
