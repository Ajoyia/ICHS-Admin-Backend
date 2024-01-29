<?php

namespace App\GraphQL\Mutations\CMEApplications;

use App\Models\Country;
use App\Models\Product;
use App\Mail\GeneralEmail;
use Illuminate\Support\Str;
use App\classes\calculateTax;
use App\Models\CMEApplication;
use App\classes\generateInvoice;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Models\AutomatedNotification;
use App\Models\CMEProduct;
use Illuminate\Support\Facades\Crypt;
use function GuzzleHttp\Promise\queue;
use Illuminate\Support\Facades\Storage;
use App\Notifications\DefaultNotification;

final class updateCMEApplication
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
        $file=null;
        if(isset($args['sessions_upload']))
            $file=$args['sessions_upload'];
        if(isset($args['id'])){
            $id = $args['id'];
            $cmeApp=CMEApplication::find($id);
        }
        if(isset($args['salutation_id']))
            $cmeApp->salutation_id=$args['salutation_id'];
        if(isset($args['activity_evaluation_method']))
            $cmeApp->activity_evaluation_method=$args['activity_evaluation_method'];

        if(isset($args['activity_evaluation_method_other']))
            $cmeApp->activity_evaluation_method_other=$args['activity_evaluation_method_other'];

        if(isset($args['first_name']))
            $cmeApp->first_name=$args['first_name'];
        if(isset($args['last_name']))
            $cmeApp->last_name=$args['last_name'];
        if(isset($args['congress_commissioner_id']))
            $cmeApp->congress_commissioner_id=$args['congress_commissioner_id'];
        if(isset($args['is_approved_by_congress_commissioner']))
            $cmeApp->is_approved_by_congress_commissioner=$args['is_approved_by_congress_commissioner'];
        if(isset($args['statuses_id']))
            $cmeApp->statuses_id=$args['statuses_id'];
        if(isset($args['credit_hours']))
            $cmeApp->credit_hours=$args['credit_hours'];
        if(isset($args['draft_stage']))
            $cmeApp->draft_stage=$args['draft_stage'];
        if(isset($args['is_approved_by_london_office']))
            $cmeApp->is_approved_by_london_office=$args['is_approved_by_london_office'];
        if(isset($args['london_office_id']))
            $cmeApp->london_office_id =$args['london_office_id'];

        if(isset($args['email']))
            $cmeApp->email=$args['email'];
        if(isset($args['organization']))
            $cmeApp->organization=$args['organization'];
        if(isset($args['mobile_no']))
            $cmeApp->mobile_no=$args['mobile_no'];
        if(isset($args['address']))
            $cmeApp->address=$args['address'];
        if(isset($args['pin_code']))
            $cmeApp->pin_code=$args['pin_code'];
        if(isset($args['city_id']))
            $cmeApp->city_id=$args['city_id'];
        if(isset($args['state_id']))
            $cmeApp->state_id=$args['state_id'];
        if(isset($args['country_id']))
            $cmeApp->country_id=$args['country_id'];
        if(isset($args['cme_activity']))
            $cmeApp->cme_activity=$args['cme_activity'];
        if(isset($args['title_event']))
            $cmeApp->title_event=$args['title_event'];
        if(isset($args['frequency']))
            $cmeApp->frequency=$args['frequency'];
        if(isset($args['activity_type_others']))
            $cmeApp->activity_type_others=$args['activity_type_others'];
        if(isset($args['learning_format_others']))
            $cmeApp->learning_format_others=$args['learning_format_others'];
        if(isset($args['social_event_others']))
            $cmeApp->social_event_others=$args['social_event_others'];
        // if(isset($args['event_date']))
        //     $cmeApp->event_date=$args['event_date'];
        if(isset($args['educational_health_professionals']))
            $cmeApp->educational_health_professionals=$args['educational_health_professionals'];
        if(isset($args['evidence_based']))
            $cmeApp->evidence_based=$args['evidence_based'];
        if(isset($args['sales_biases']))
            $cmeApp->sales_biases=$args['sales_biases'];
        if(isset($args['initials_activity_director']))
            $cmeApp->initials_activity_director=$args['initials_activity_director'];
        if(isset($args['initials_activity_coordinatorvar']))
            $cmeApp->initials_activity_coordinatorvar=$args['initials_activity_coordinatorvar'];
        if(isset($args['activity_overview']))
            $cmeApp->activity_overview=$args['activity_overview'];
        if(isset($args['cme_cpd_provide']))
            $cmeApp->cme_cpd_provide=$args['cme_cpd_provide'];
        if(isset($args['cme_cpd_participants']))
            $cmeApp->cme_cpd_participants=$args['cme_cpd_participants'];
        if($file!=null){
            $cmeApp->sessions_upload = Storage::putFile('/cme_applications/session_files',$args['sessions_upload']);
        }

        if(isset($args['activity_evolution']))
            $cmeApp->activity_evolution=$args['activity_evolution'];
        if(isset($args['activity_evolution_other']))
            $cmeApp->activity_evolution_other=$args['activity_evolution_other'];
        if(isset($args['status']))
            $cmeApp->status=$args['status'];
        $cmeApp->save();
        if(isset($args['finish']) && $args['finish']==1){
            $model_type = 'App\Models\CMEApplication';
            $product=Product::where('link_product',2)->get();
            $product=$product[0];
            $cmePro=CMEProduct::find($cmeApp->cme_product_id);

           // $pct=$product->productCountryTypes[0];
            $product_name=$product->name;
            $tg=$cmePro->tax_group;
            if($tg!=null){
                $taxes = $tg->Taxes;
            }
            else {
                $taxes = null;
            }
            $net_amount = $cmePro->price;

            $tax = new calculateTax();
            $payload = $tax->calculateTaxAmount($taxes,$net_amount,$product_name,0);

            $invoice = new generateInvoice();
            $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$cmeApp->id,$cmeApp->status,$payload);

            $payment = $this->paymentService->getAccessToken(Auth::user()->id,$net_amount, $product->id, $invoiceGenerated->id);
            $encAmount = encrypt($invoiceGenerated->total_amount);

            $encLink=Crypt::encryptString($payment->_links->payment->href);
            $link=env('APP_FRONT_END').'/paymentPage?amount='.$encAmount.'&link='.$encLink;

            $notification=AutomatedNotification::where('type','invoice_generation')->first();
            if (!empty($notification) && !empty($notification->message)) {
                $sender=$notification->notification_sender->from_email;

                $tempalte = Str::of($notification->message)->replace('{{first_name}}', $cmeApp->first_name);
                $tempalte = Str::of($tempalte)->replace('{{last_name}}',$cmeApp->last_name);
                $tempalte = Str::of($tempalte)->replace('{{email}}',$cmeApp->email);
                $tempalte = Str::of($tempalte)->replace('{{mobile_no}}',$cmeApp->mobile_no);
                $tempalte = Str::of($tempalte)->replace('{{address}}',$cmeApp->address);
                $tempalte = Str::of($tempalte)->replace('{{data}}',$invoiceGenerated->data);
                $tempalte = Str::of($tempalte)->replace('{{link}}',Storage::path($invoiceGenerated->link));
                $tempalte = Str::of($tempalte)->replace('{{total_amount}}',$invoiceGenerated->total_amount);
                $tempalte = Str::of($tempalte)->replace('{{net_amount}}',$invoiceGenerated->net_amount);
                $tempalte = Str::of($tempalte)->replace('{{vat}}',$invoiceGenerated->vat);
                $tempalte = Str::of($tempalte)->replace('{{currency}}',$invoiceGenerated->currency);
                $tempalte = Str::of($tempalte)->replace('{{link_to_Pay}}',$link);

                //  Auth::user()->notify(new DefaultNotification($tempalte, $notification->subject, Auth::user()->first_name, 'itadmin@index.ae',Storage::path($invoiceGenerated->link).''));

                Mail::to($cmeApp->email)
                    ->cc([])
                    ->bcc([])
                    ->send(new GeneralEmail($tempalte,$notification->subject,$sender));
            }
        }
        if(isset($args['finish'])&&$args['finish']==2){
            $model_type = 'App\Models\CMEApplication';
            $product=Product::where('link_product',2)->get();
            $product=$product[0];
        //    $ct=Country::find($cmeApp->country_id)->country_types[0];
        //    $pct=$product->ProductCountryType($ct->id);
            $cmePro=CMEProduct::find($cmeApp->cme_product_id);
            $product_name=$product->name;
            $tg=$cmePro->tax_group;
            if($tg!=null){
                $taxes = $tg->Taxes;
            }
            else {
                $taxes = null;
            }
            // $cmePro?$net_amount = $cmePro->price+$cmePro->price:$net_amount = $cmePro->price;
            // $net_amount = $cmePro->price;
            // $tax = new calculateTax();

            // $payload = $tax->calculateTaxAmount($taxes,$net_amount,$product_name);
            $prices_with_promo= getPriceWithPromoCode($args['promo_code_id'],$cmePro->price);

            $tax = new calculateTax();
            $payload = $tax->calculateTaxAmount($taxes,$prices_with_promo['discounted_price'],$product_name, $prices_with_promo['discount']);

            $payload['promo_code_id']=$args['promo_code_id'];

            $invoice = new generateInvoice();
            $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$cmeApp->id,$cmePro->status,$payload);

            $payment = $this->paymentService->getAccessToken(Auth::user()->id,$payload['total_amount'], $product->id, $invoiceGenerated->id);

            // $invoice = new generateInvoice();
            // $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$cmeApp->id,$cmeApp->status,$payload);

            // $payment = $this->paymentService->getAccessToken(Auth::user()->id,$prices_with_promo['discounted_price'], $product->id, $invoiceGenerated->id);
            $cmeApp->link_to_pay=$payment->_links->payment->href;
        }
        return $cmeApp;
    }
}



