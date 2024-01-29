<?php

namespace App\GraphQL\Mutations\Donations;

use App\Models\Donation;
use App\classes\generateInvoice;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;

final class CreateDonation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    private $paymentService=null;
    public function __construct(PaymentService $paymentService)
    {

        $this->paymentService = $paymentService;

    }
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $model_type = 'App\Models\Donation';
        $donation=new Donation();
        $donation->frquency=$args['frquency'];
        $donation->amount=$args['amount'];
        $donation->user_id=Auth::user()->id;
        $donation->status=0;
        $donation->created_by=Auth::user()->id;
        $donation->save();
        $invoice = new generateInvoice();
        $json_array = array();
        $json_array['product_name'] = 'Donation';
        $payload=[];
        $payload['product_name']='Donation';
        $payload['total_amount']=$donation->amount;
        $payload['net_amount']=$donation->amount;
        $payload['sum_of_taxes']=0;
        $payload['percentage_amount']=0;
        $payload['data']=json_encode($json_array);
        $payload['promo_code_id']=null;
        // $payload['promo_code_id']=0;
        $payload['discount']=0;
        $payload['discount']=0;
        $payload['total_amount']=$args['amount'];
        $payload['net_amount']=$args['amount'];
        $payload['sum_of_taxes']=0;
        $payload['gross']=$args['amount'];
        $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$donation->id,$donation->status,$payload);
        $payment = $this->paymentService->getAccessToken(Auth::user()->id,$args['amount'], $donation->id, $invoiceGenerated->id);
        return $payment->_links->payment->href;
    }
}
