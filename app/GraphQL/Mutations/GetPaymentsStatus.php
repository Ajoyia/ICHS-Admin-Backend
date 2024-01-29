<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\PaymentController;
use App\Models\Membership;
use App\Models\ProductCountryType;
use Carbon\Carbon;
final class GetPaymentsStatus
{
    public function __construct(PaymentController $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function __invoke($_, array $args)
    {
        $request=new \Illuminate\Http\Request();
        $request->ref=$args['ref'];
        return $this->paymentService->getPayStatus($request);
    }
}
