<?php

namespace App\classes;

use Illuminate\Support\Facades\Mail;
use App\Models\Invoice;
use App\Mail\GeneralEmail;
use App\Models\Membership;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use App\Notifications\DefaultNotification;

class sendMailForCME{

    public function sendMail($email,$template,$subject,$sender)
    {
        $msg='';
        try {
            Mail::to($email)
            ->cc([])
            ->bcc([])
            ->send(new GeneralEmail($template,$subject,$sender));
            $msg = "success";
            
            // 
		} catch (\Exception $e) {
			$msg = "error";
			
		}
        
        return $msg;
    }
}