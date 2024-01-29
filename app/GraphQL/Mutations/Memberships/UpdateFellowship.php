<?php

namespace App\GraphQL\Mutations\Memberships;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Mail\GeneralEmail;
use App\Models\Membership;
use Illuminate\Support\Str;
use App\classes\calculateTax;
use App\classes\generateInvoice;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\AutomatedNotification;
use App\Notifications\DefaultNotification;

final class UpdateFellowship
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
        if(isset($args['id'])){
            $m=Membership::find($args['id']);
            if(isset($args['rejectionReason']))
                $m->rejection_reason=$args['rejectionReason'];

            if(isset($args['approve'])){
                if($args['approve']==1){
                    $product=Product::where('link_product',1)->first();
                    $productName=$product->name;
                    $pct=$m->product_country_type;
                    $tax = new calculateTax();
                    $payload = $tax->calculateTaxAmount(null,($pct->price*((100-$pct->percentage_required))/100),$productName,0);
                    $model_type = 'App\Models\Membership';
                    $invoice = new generateInvoice();
                    $invoiceGenerated = $invoice->generateInvoice($m->user->id,$model_type,$m->id,$m->status,$payload);

                    $payment = $this->paymentService->getAccessToken($m->user->id,$payload['total_amount'], $product->id, $invoiceGenerated->id);
                    $u=$m->user;
                    $u->require_update=2;
                    $u->save();

                    $link=$payment->_links->payment->href;

                    $notification = AutomatedNotification::where('type', "fellowship_approve")->whereNull('deleted_at')->first();
                    if (!empty($notification) && !empty($notification->message)) {
                        Log::info($notification->message);
                        $notification->message = Str::of($notification->message)->replace('{{user}}', $m->user->first_name);
                        $notification->message = Str::of($notification->message)->replace('{{link}}', $link);

                        $sender=$notification->notification_sender->from_email;
                        $m->user->notify(new DefaultNotification(
                            $notification->message,
                            $notification->subject,
                            $sender,
                            $sender
                        ));
                        // Mail::to($m->user->email)
                        // ->cc([])
                        // ->bcc([])
                        // ->send(new GeneralEmail($notification->message,$notification->subject,$sender));
                    }
                }
                else{
                    $m->save();
                    $notification = AutomatedNotification::where('type', "fellowship_reject")->whereNull('deleted_at')->first();
                    if (!empty($notification) && !empty($notification->message)) {
                        $notification->message = Str::of($notification->message)->replace('{{first_name}}', $m->user->first_name);
                        $notification->message = Str::of($notification->message)->replace('{{rejection_reason}}', $m->rejection_reason);
                        $sender=$notification->notification_sender->from_email;

                        $m->user->notify(new DefaultNotification(
                            $notification->message,
                            $notification->subject,
                            $sender,
                            $sender
                        ));
                        // Mail::to($m->user->email)
                        // ->cc([])
                        // ->bcc([])
                        // ->send(new GeneralEmail($tempalte,$notification->subject,$sender));

                    }
                    $u=$m->user;
                    $u->require_update=2;
                    $u->save();
                }
            }
        }

    }
}
