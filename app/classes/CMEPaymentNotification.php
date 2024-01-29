<?php

namespace App\classes;

use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Mail\GeneralEmail;
use App\Models\Membership;
use Illuminate\Support\Facades\Log;
use App\Models\AutomatedNotification;

class CMEPaymentNotification{

    public function notification()
    {
        $notification = AutomatedNotification::where('type', "cme_successful_payment")->whereNull('deleted_at')->first();
        return $notification;
    }
}