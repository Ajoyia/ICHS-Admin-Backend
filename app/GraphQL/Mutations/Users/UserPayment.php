<?php

namespace App\GraphQL\Mutations\Users;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Membership;
use App\Models\UserPolicy;
use App\classes\calculateTax;
use App\classes\generateInvoice;
use App\classes\membershipHandler;
use App\Services\PaymentService;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\PromotionCodeService;

final class UserPayment
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    private $paymentService;
    public function __construct(PaymentService $paymentService)
    {

        $this->paymentService = $paymentService;

    }
    public function __invoke($_, array $args)
    {
        $model_type = 'App\Models\Membership';
        // $product=json_decode($args['product'],true);
        $product=Product::where('link_product',1)->first();
        $productName=$product->name;
        $pct=ProductCountryType::find($args['package']);

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

        if($pct->membership_type_id==3){
            $amount=$payload['total_amount'];
            $payload['total_amount']=$amount*($pct->percentage_required/100);
            $payload['net_amount']=$amount*($pct->percentage_required/100);

            $user=User::find(Auth::user()->id);
            $user->require_update=1;
            $user->save();
        }
        if($payload['total_amount']>0){
            Log::info($payload);
            $invoice = new generateInvoice();
            $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$args['membership_id'],$pct->status,$payload);

            $payment = $this->paymentService->getAccessToken(Auth::user()->id,$payload['total_amount'], $product->id, $invoiceGenerated->id);
            $pct->link_to_pay=$payment->_links->payment->href;
            return json_encode($pct);
        }
        else{
            $mh=new membershipHandler();
            $mh->assignMembership(Auth::user()->id,null,$args['membership_id']);
            return 'none';
        }

        // $model_type = 'App\Models\Membership';
        // $taxes = json_decode(json_encode($product["country_types"][0]["tax_group"]["taxes"]),true );
        // $net_amount = $product["country_types"][0]["price"];
        // $product_name=$product['name'];
        // $sum_of_taxes = 0;
        // $percentage_amount = 0;
        // $json_array = array();
        // $j = array();
        // foreach($taxes as $tax)
        // {
        //     array_push($j, [
        //         'tax_name' => $product["country_types"][0]["tax_group"]["taxes"][0]["name"],
        //         'tax_rate' => $product["country_types"][0]["tax_group"]["taxes"][0]["rate"],
        //     ]);
        //     $sum_of_taxes += $product["country_types"][0]["tax_group"]["taxes"][0]["rate"];
        // }
        // $json_array['taxes'] = $j;
        // $json_array['product_name'] = $product_name;
        // if($sum_of_taxes != 0)
        // {
        //     $percentage_amount = $net_amount*($sum_of_taxes/100);
        // }
        // $total_amount = $percentage_amount + $net_amount;
        // $payload = [
        //     'total_amount' => $total_amount,
        //     'data' => json_encode($json_array),
        //     'net_amount' => $net_amount,
        //     'product_name' => $product_name,
        //     'sum_of_taxes' => $sum_of_taxes,
        //     'percentage_amount' => $percentage_amount
        // ];

        // $invoice = new generateInvoice();
        // $invoiceGenerated = $invoice->generateInvoice($args['user_id'],$model_type,$args['membership_unique_id'],'1',$payload);
        // $payment = $this->paymentService->getAccessToken($args['user_id'],$net_amount, $product["id"], $invoiceGenerated->id);
        // return json_encode($payment);
        // return "";

    }

    // public function getPriceWithPromoCode($promo_code_id,$price)
    // {
    //    if($promo_code_id!=null)
    //    {


    //         $obj= new PromotionCodeService('',$price,$promo_code_id);
    //         $response=$obj->retrunMessage();
    //         if($response['status']==true)
    //         {
    //             if($response['discount_type']=='value')
    //             {
    //                 $discount=$price-$response['discount'];
    //                 return ['price'=>$price,'discount'=>$discount,'discounted_price'=>$discount];
    //             }else{
    //                 return ['price'=>$price,'discount'=>$response['discount'],'discounted_price'=>$price-$response['discount']];
    //             }
    //         }
    //     }
    //     return ['price'=>$price,'discount'=>0];
    // }


}
