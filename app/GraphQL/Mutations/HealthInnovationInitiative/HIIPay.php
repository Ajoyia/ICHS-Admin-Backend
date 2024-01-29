<?php

namespace App\GraphQL\Mutations\HealthInnovationInitiative;

use App\Models\User;
use App\Models\Product;
use App\classes\calculateTax;
use App\classes\generateInvoice;
use App\Models\Package;
use App\Services\PaymentService;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\PromotionCodeService;

final class HIIPay
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __construct(PaymentService $paymentService)

    {

        $this->paymentService = $paymentService;

    }
    public function __invoke($_, array $args)
    {
        $model_type = 'App\Models\HealthInnovationInitiative';
        // $product=json_decode($args['product'],true);
        $product=Product::where('link_product',4)->first();
        $productName=$product->name;
        $pct=Package::find($args['package_id']);

        
        $tg=$pct->tax_group;
        if($tg!=null){ 
            $taxes = $tg->Taxes;
        }
        else {
            $taxes = null;
        }
        $prices_with_promo=getPriceWithPromoCode($args['promo_code_id'],$pct->price);
       
        $tax = new calculateTax();
        $payload = $tax->calculateTaxAmount($taxes,$pct->price,$productName,$prices_with_promo['discount']);
    
        $payload['promo_code_id']=$args['promo_code_id'];

        $invoice = new generateInvoice();
        $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$args['hii_id'],$pct->status,$payload);

        $payment = $this->paymentService->getAccessToken(Auth::user()->id,$payload['total_amount'], $product->id, $invoiceGenerated->id);
        $pct->link_to_pay=$payment->_links->payment->href;
        Log::info($pct->link_to_pay);
        return json_encode($pct);

      

    }

   


}
