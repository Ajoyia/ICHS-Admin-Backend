<?php

namespace App\Http\Controllers;


use DB;
use stdClass;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Donation;
use App\Models\Membership;
use App\Models\UserPolicy;
use Illuminate\Support\Str;
use App\Jobs\CMESuccessMail;
use Illuminate\Http\Request;
use App\Models\CMEApplication;
use App\Models\UserCardDetail;
use App\classes\generateReceipt;
use App\classes\membershipHandler;
use App\Services\PaymentService;
use App\Models\CMECompletionForm;
use App\Models\TransactionDetail;
use App\Models\JournalApplication;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Log;
use App\Jobs\AccredationSuccessMail;
use App\Models\AutomatedNotification;
use App\Models\AccredationApplication;
use Illuminate\Support\Facades\Storage;
use App\Models\AccredationCompletionForm;
use App\Models\HealthInnovationInitiative;


class PaymentController extends Controller {

    private $paymentService;
	public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

	public function payment()
	{
		$payment = $this->paymentService->getAccessToken(1,10, 4, 16);
		return redirect($payment->_links->payment->href);
	}

    public function getPayStatus(Request $request)
	{
        //Log::info('start!!!!!');
		if(empty($transactionData=$this->getTransaction($request->ref))){
            //Log::info('empty($transactionData=$this->getTransaction($request->ref)');
	        $ch = curl_init();
			$access_token = $this->paymentService->getToken();
			curl_setopt($ch, CURLOPT_URL, env('PAYMENT_URL') . "transactions/outlets/" . env('PAYMENT_UTL') . "/orders/".$request->ref );
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: Bearer " . $access_token,
				"Content-Type: application/vnd.ni-payment.v2+json",
				"Accept: application/vnd.ni-payment.v2+json"));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = json_decode(curl_exec($ch), true);

	        //Log::info($output);
	        //Log::info($output['_embedded']['payment'][0]);
			if (isset($output['_embedded']['payment'][0]['3ds']['status']) && $output['merchantOrderReference']) {
                //Log::info('isset($output[_embedded][payment][0][3ds][status]) && $output[merchantOrderReference]');
				$status = $output['_embedded']['payment'][0]['3ds']['status'];
				$status_id = $this->getStatus($status);
                //Log::info($status_id);
				$user_id = $output['merchantOrderReference'];

				$params = explode('S', $user_id);
				$user_id = $params[0];
				$product_id = $params[1];   // product_country_type_id
				$invoice_id = $params[2];

				$inv=Invoice::find($invoice_id);

				if($status_id==3)
				{
		            // dump($inv);
					$invoice = new generateReceipt();
					$receipt = $invoice->generateReceipt($invoice_id);
		            // dd($receipt);
					$cardObject=$output['_embedded']['payment'][0]['savedCard'];

					if($inv->model_type == 'App\Models\CMECompletionForm'){
							$completion_form = CMECompletionForm::find($inv->model_id);
							$completion_form->is_completed = 1;
							$completion_form->save();

							$cme_application = CMEApplication::find($completion_form->cme_application_id);
							$cme_application->statuses_id = 5;
							$cme_application->save();
					}
					if ($inv->model_type == 'App\Models\AccredationCompletionForm') {
						$completion_form = AccredationCompletionForm::find($inv->model_id);
						$completion_form->is_completed = 1;
						$completion_form->save();

						$cme_application = AccredationApplication::find($completion_form->acc_id);
						$cme_application->status_id = 5;
						$cme_application->save();
					}
					if($inv->model_type == 'App\Models\CMEApplication'){
						$completion_form = CMEApplication::find($inv->model_id);
							$completion_form->statuses_id = 1;
							$completion_form->save();
						dispatch(new CMESuccessMail($inv->model_id));
					}

					if ($inv->model_type == 'App\Models\AccredationApplication') {
						$completion_form = AccredationApplication::find($inv->model_id);
						$completion_form->status_id = 1;
						$completion_form->save();
						dispatch(new AccredationSuccessMail($inv->model_id));
					}

					if ($inv->model_type == 'App\Models\JournalApplication') {
						$journal = JournalApplication::find($inv->model_id);
						$journal->status_id = 1;
						$journal->save();
					}

					if ($inv->model_type == 'App\Models\HealthInnovationInitiative') {
						$hii = HealthInnovationInitiative::find($inv->model_id);
						$hii->statuses_id = 1;
						$hii->save();
					}

					if($inv->model_type == 'App\Models\Membership'){

						// $now = Carbon::now();

						// $up = new UserPolicy();
						// $up->policy_id = 4;
						// $up->user_id = $user_id;
						// $up->save();

						// $membership = Membership::find($inv->model_id);

						// $productCountryType=ProductCountryType::where('id',$membership->product_country_type_id)->first();

						// $membership->status = 1;
						// $membership->membership_id = $now->year.'-ICHS-'.$membership->id;

						// $start_date=Carbon::now()->toDateTimeString();
                        // if(!$membership->start_date)
                        //     $membership->start_date=$start_date;
                        // if(($productCountryType->memberhsip_type_id==3&&$inv->total_amount==$productCountryType->price)||$productCountryType->memberhsip_type_id!=3){
                            // if($productCountryType->type=='yearly'){
                            //     if(is_null($membership->end_date)){
                            //         $end_date=Carbon::now()->addYears($membership->product_country_type->validity)->toDateTimeString();
                            //         $membership->end_date=$end_date;
                            //     }
                            //     else{
                            //         $end_date=(new Carbon($membership->end_date))->addYears($membership->product_country_type->validity)->toDateTimeString();
                            //         $membership->end_date=$end_date;
                            //     }
                            // }else if($productCountryType->type=='monthly'){
                            //     if(is_null($membership->end_date)){
                            //         $end_date=Carbon::now()->addMonths($membership->product_country_type->validity)->toDateTimeString();
                            //         $membership->end_date=$end_date;
                            //         $membership->status=1;
                            //     }
                            //     else{
                            //         $end_date=(new Carbon($membership->end_date))->addMonths($membership->product_country_type->validity)->toDateTimeString();
                            //         $membership->end_date=$end_date;
                            //     }
                            // }else if($productCountryType->type=='expired_on'){
                            //     $membership->end_date=$membership->product_country_type->expire_on;
                            //     $membership->status=1;
                            // }
                            // if($membership->membership_type_id==3){
                            //     //Log::info('net='.$inv->total_amount.' p='.($productCountryType->price*($productCountryType->percentage_required/100)));
                            //     if($inv->total_amount>($productCountryType->price*($productCountryType->percentage_required/100))){
                            //         $u=$membership->user;
                            //         $u->require_update=3;
                            //         $u->save();
                            //     }
                            //     else{
                            //         $u=$membership->user;
                            //         $u->require_update=2;
                            //         $u->save();
                            //     }
                            // }
                            // $membership->save();
                        // }
                        $mh=new membershipHandler();
                        $mh->assignMembership($user_id,$inv,null);
					}

                    if ($inv->model_type == 'App\Models\HealthInnovationInitiative') {
						$hii = HealthInnovationInitiative::find($inv->model_id);
						$hii->statuses_id = 1;
						$hii->save();
					}
                    if ($inv->model_type == 'App\Models\Donation') {
						$donation = Donation::find($inv->model_id);
						$donation->status = 1;
						$donation->save();
					}

					$insertData=['user_id' => $user_id,
	    				'model_type' => $inv->model_type,
	    				'model_id' => $inv->model_id,
	    				'method' => 4,
	    				'card_no' =>$cardObject['maskedPan'],
	    				'note' => 'Note about payment',
	    				'payment_status' => $status_id,
	    				'payment_ref' =>$request->ref,
	    				'status' => 1,
	    				'invoice_id' => $invoice_id,
	    				'receipt_id' =>$receipt->id,
	    				'total_amount' => $output['amount']['value'] / 100,
	    				'total_amount_in_usd' =>($output['amount']['value'] / 100)/config('variables.currency_rate'),
	    				'created_at' => Carbon::now(),
	    				'updated_at'=> Carbon::now()
	    			];

					$this->saveTransaction($insertData);
                    // dd('saved');
					UserCardDetail::updateOrCreate([
		                'expiry'=>$cardObject['expiry'],
		                'card_holder_name'=> $cardObject['cardholderName'],
		                'scheme'=> $cardObject['scheme'],
		                'is_active'=> 1,
		                'model_type' => $inv->model_type,
		                'model_id' => $inv->model_id,
		                'masked_pan' => $cardObject['maskedPan'],
		                'card_token'=> $cardObject['cardToken'],
		                'recapture_csc'=> $cardObject['recaptureCsc'],
		                'created_by'=> '1',
		                'updated_by'=> '1',
					]);

		            // $inv=Invoice::find($inv_id);
		            $notification=AutomatedNotification::where('type','receipt_generation')->first();
		            // dd($sender);
		            if (!empty($notification) && !empty($notification->message)) {
		                $sender=$notification->notification_sender->from_email;
		                if($inv->model_type=='App\Models\CMEApplication'){
							$cme_application = CMEApplication::find($inv->model_id)->first();
		                    $output['emailAddress']=$cme_application->email;
							$output['billingAddress']['firstName'] = $cme_application->first_name;
							$output['billingAddress']['lastName'] = $cme_application->last_name;
							$output['billingAddress']['address1'] = $cme_application->address;
		                }

						if ($inv->model_type == 'App\Models\AccredationApplication') {
							$cme_application = AccredationApplication::find($inv->model_id)->first();
							$output['emailAddress'] = $cme_application->email;
							$output['billingAddress']['firstName'] = $cme_application->first_name;
							$output['billingAddress']['lastName'] = $cme_application->last_name;
							$output['billingAddress']['address1'] = $cme_application->address;
						}
		                $tempalte = Str::of($notification->message)->replace('{{first_name}}', $output['billingAddress']['firstName']);
		                $tempalte = Str::of($tempalte)->replace('{{last_name}}',$output['billingAddress']['lastName']);
		                $tempalte = Str::of($tempalte)->replace('{{email}}',$output['emailAddress']);
		                $tempalte = Str::of($tempalte)->replace('{{address}}',$output['billingAddress']['address1']);
		                $tempalte = Str::of($tempalte)->replace('{{total_amount}}',$insertData['total_amount']);
		                $tempalte = Str::of($tempalte)->replace('{{net_amount}}',$inv->net_amount);
		                $tempalte = Str::of($tempalte)->replace('{{vat}}',$inv->vat);
		                $tempalte = Str::of($tempalte)->replace('{{currency}}',$inv->currency);
		                $tempalte = Str::of($tempalte)->replace('{{reciept}}',Storage::path($receipt->link));
		                if($inv->model_type=='App\Models\CMEApplication'){
		                    $output['emailAddress']=CMEApplication::find($inv->model_id)->email;
		                }
						if ($inv->model_type == 'App\Models\AccredationApplication') {
							$output['emailAddress'] = AccredationApplication::find($inv->model_id)->email;
						}
		                else if($inv->model_type=='App\Models\Membership'){
		                    $output['emailAddress']=User::find($inv->user_id)->email;
		                    //$output['emailAddress']=Auth::user()->email;
		                    // $output['emailAddress']='muaazmehmood@gmail.com';
		                }
		                // dd($output['emailAddress']);
		                $tempalte = Str::of($tempalte)->replace('{{reciept}}',Storage::url($receipt->link));
		                // Mail::to($output['emailAddress'])
		                //     ->cc([])
		                //     ->bcc([])
		                //     //->Attachment('')
		                //     ->send(new GeneralEmail($tempalte,$notification->subject,$sender));

		            }
		            return json_encode(['status'=>true,'ref'=>$request->ref,'type'=>1]);

		        }else{
                    //Log::info('in else');
		        	$insertData=['user_id' => $user_id,
	    				'model_type' => $inv->model_type,
	    				'model_id' => $inv->model_id,
	    				'method' => 4,
	    				'card_no' =>null,
	    				'note' => 'Note about payment',
	    				'payment_status' => 1,
	    				'payment_ref' =>$request->ref,
	    				'status' => 1,
	    				'invoice_id' => $invoice_id,
	    				'receipt_id' =>null,
	    				'total_amount' => $output['amount']['value'] / 100,
	    				'total_amount_in_usd' =>($output['amount']['value'] / 100)/config('variables.currency_rate'),
	    				'created_at' => Carbon::now(),
	    				'updated_at'=> Carbon::now()
	    			];

					$statusResult=$this->saveTransaction($insertData);
                    //Log::info($statusResult);
					return json_encode(['status'=>false,'ref'=>$request->ref,'type'=>2]);
		        }
			}
            else if(isset($output['_embedded']['payment'][0]['state'])){
                //Log::info('else if(isset($output[_embedded][payment][0][state]))');
                $user_id = $output['merchantOrderReference'];

				$params = explode('S', $user_id);
				$user_id = $params[0];
				$product_id = $params[1];
				$invoice_id = $params[2];

				$inv=Invoice::find($invoice_id);
                $trans=new TransactionDetail();
                $trans->user_id = $user_id;
                $trans->model_type = $inv->model_type;
                $trans->model_id = $inv->model_id;
                $trans->method = 4;
                $trans->card_no =null;
                $trans->note = 'Note about payment';
                $trans->payment_status = 1;
                $trans->payment_ref =$request->ref;
                $trans->status = 1;
                $trans->invoice_id = $invoice_id;
                $trans->receipt_id =null;
                $trans->total_amount = $output['amount']['value'] / 100;
                $trans->total_amount_in_usd =($output['amount']['value'] / 100)/config('variables.currency_rate');
                $trans->created_at = Carbon::now();
                $trans->updated_at= Carbon::now();
                $trans->save();
            }
			return json_encode(['status'=>false,'ref'=>$request->ref,'type'=>3]);
		}else{
			return json_encode(['status'=>($transactionData->payment_status==3 ? true : false),'ref'=>$request->ref,'type'=>4]);
		}
	}


	public function getStatus($status) {
		$statusId = 1;
		switch ($status) {
		case 'SUCCESS':
			$statusId = 3;
			break;

		default:
			$statusId = 1;
			break;

		}
		return $statusId;
	}

    public function getPaymentFromUser(Request $request){
        // dump($request->user);
        $u=User::where('email',$request->user)->first();
        // dump($u);
        $payment = $this->paymentService->getAccessToken($u->id,$request->amount,1, 1);
        $link=$payment->_links->payment->href;
        $amount=$request->amount;
        return view('pay',compact('link','amount'));
    }


    public function saveTransaction($insertData)
    {
		return TransactionDetail::insertGetId($insertData);
    }


    public function getTransaction($ref)
    {
    	return TransactionDetail::where(['payment_ref' => $ref])->first();
    }
}
