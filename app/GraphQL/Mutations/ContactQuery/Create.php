<?php

namespace App\GraphQL\Mutations\ContactQuery;

use App\Mail\GeneralEmail;
use App\Models\CMESpeaker;
use Illuminate\Support\Str;
use App\Models\ContactQuery;
use Illuminate\Support\Facades\Mail;
use App\Models\AutomatedNotification;
use App\Notifications\DefaultNotification;

final class Create
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $email_sender = env('ICHS_INFO_EMAIL_SENDER', 'info@ichs.uk');

        $email_receiver = env('ICHS_EMAIL_RECEIVED', 'shahbaz.ali@index.ae');

        $contactQuery = new ContactQuery();
        if(isset($args['name']) && !empty($args['name'])){
            $contactQuery->name=$args['name'];
        }

        if(isset($args['email']) && !empty($args['email'])){
            $contactQuery->email=$args['email'];
        }

        if(isset($args['organization']) && !empty($args['organization'])){
            $contactQuery->organization= $args['organization'];
        }

        if(isset($args['subject']) && !empty($args['subject'])){
            $contactQuery->subject= $args['subject'];
        }
        if(isset($args['message']) && !empty($args['message'])){
            $contactQuery->message= $args['message'];
        }

        $contactQuery->save();
        $contactQuery->email = $email_receiver;

        $notification = AutomatedNotification::where('type', "contact_email")->whereNull('deleted_at')->first();

        $sender=$notification->notification_sender->from_email;

        $tempalte = Str::of($notification->message)->replace(
            ['{{name}}', '{{email}}','{{subject}}', '{{organization}}', '{{message}}' ], 
            [$contactQuery->name, $contactQuery->email, $contactQuery->subject, $contactQuery->organization, $contactQuery->message ]
        );
        // Mail::to($email_receiver)
        //             ->cc([])
        //             ->bcc([])
        //             ->send(new GeneralEmail($tempalte,$notification->subject,$contactQuery->email));
                    
        $contactQuery->notify(new DefaultNotification(
            $tempalte,
            $notification->subject,
            $contactQuery->name,
            $email_sender
            
        ));
            
        
        return "Success";
    }
}
