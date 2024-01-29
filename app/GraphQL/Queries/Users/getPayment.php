<?php

namespace App\GraphQL\Queries\Users;

use App\Models\User;
use App\Mail\GeneralEmail;
use Illuminate\Support\Str;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\AutomatedNotification;
use App\Notifications\DefaultNotification;

final class getPayment
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
        Log::info('Resolver chl gia'.$args['amount']);
        $u=User::where('email',$args['email'])->first();
        $payment = $this->paymentService->getAccessToken($u->id,$args['amount'],1, 1);
        $link=$payment->_links->payment->href;
        $link=env('APP_FRONT_END').'/paymentPage?amount='.$args['amount'].'&link='.$payment->_links->payment->href;
        $notification=AutomatedNotification::where('type','pay')->first();
        if (!empty($notification) && !empty($notification->message)) {
            $tempalte = Str::of($notification->message)->replace('{{first_name}}', $u->first_name);
            $tempalte = Str::of($tempalte)->replace('{{last_name}}',$u->last_name);
            $tempalte = Str::of($tempalte)->replace('{{email}}',$u->email);
            $tempalte = Str::of($tempalte)->replace('{{mobile_no}}',$u->mobile_no);
            $tempalte = Str::of($tempalte)->replace('{{address}}',$u->address);
            $tempalte = Str::of($tempalte)->replace('{{link_to_Pay}}',$link);
            $tempalte = Str::of($tempalte)->replace('{{amount}}',$args['amount']);
        }
        $u->notify(new DefaultNotification($tempalte, $notification->subject, Auth::user()->first_name, 'itadmin@index.ae'));

    }
}
