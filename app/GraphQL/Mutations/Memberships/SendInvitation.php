<?php

namespace App\GraphQL\Mutations\Memberships;
use App\Models\AutomatedNotification;
use App\Notifications\DefaultNotification;
use App\classes\sendMailForCME;
use App\Models\User;
use Carbon\Carbon;
use Auth;

final class SendInvitation
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       
        $user = new User(['email'=>$args['email']]);
        $user->generateInvitationToken();
        $user->parent_id= Auth::id();
        $user->email_verified_at= Carbon::now();
        $user->is_accept= false;
        $user->save();

        $notification = AutomatedNotification::where('type', "for_send_email_organization_member")->first();

        if(!empty($notification))
        {
            // $send = new sendMailForCME();
           
            $templateEmail = \Str::of($notification->message)->replace(['{{email}}', '{{token}}'], [$user->email, $user->link]);
            //$send->sendMail($args['email'],$templateEmail,$notification->subject,$sender);
            
            if($notification->notification_sender->from_email){
                    $email_from = $notification->notification_sender->from_email;
                } else{
                        $email_from = 'itadmin@index.ae';
                }

                $user->notify(new DefaultNotification($templateEmail,
                    $notification->subject,
                    $email_from,
                    $email_from
                ));
        }
        return $user;
    }
}
