<?php

namespace App\GraphQL\Mutations\ApplicationSignatures;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\CMEActivityAdministrator;
use App\classes\sendMailForCME;
use App\Notifications\DefaultNotification;
use App\Models\AutomatedNotification;
use App\Models\CMESpeaker;
use Illuminate\Support\Facades\Log;

final class sendSignatureMail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
       
        $administrator_policy_agreement_policy = AutomatedNotification::where('type', "agreement_form_administrator")->whereNull('deleted_at')->first();
        if($args['model']== 'administrator'){
        if (!empty($administrator_policy_agreement_policy) && !empty($administrator_policy_agreement_policy->message)) {

                 $administrator = CMEActivityAdministrator::find($args['id']);
                 $sender = $administrator_policy_agreement_policy->notification_sender->from_email;
                 $encrypted_id = encrypt($administrator->id);
                 $template = Str::of($administrator_policy_agreement_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$administrator->first_name, $administrator->last_name, $administrator->email, env('APP_FRONT_END') . 'applications/administrator-agreement' . '?id=' . $encrypted_id]);
                //  $send = new sendMailForCME();

                $administrator->notify(new DefaultNotification(
                    $template,
                    $administrator_policy_agreement_policy->subject,
                    $sender,
                    $sender
                ));

                $administrator->is_policy_agreement_email_sent = 1;
                $administrator->policy_agreement_email_sent_date = Carbon::now();
                $administrator->save();

                //  $is_mail_sent = $send->sendMail($administrator->email, $template, $administrator_policy_agreement_policy->subject, $sender);
                //  if ($is_mail_sent == "success") {
                //     $administrator->is_policy_agreement_email_sent = 1;
                //      $administrator->policy_agreement_email_sent_date = Carbon::now();
                //      $administrator->save();
                //  }
             }
        }
        $speaker_policy_agreement_policy = AutomatedNotification::where('type', "agreement_form_speaker")->whereNull('deleted_at')->first();
        $speaker_disclosure_policy = AutomatedNotification::where('type', "disclosure_form_speaker")->whereNull('deleted_at')->first();
        if ($args['model'] == 'speaker') {

            $speaker = CMESpeaker::find($args['id']);
               if($args['type'] == 'policy'){

                   if (!empty($speaker_policy_agreement_policy) && !empty($speaker_policy_agreement_policy->message)) {
                       
                        $sender = $speaker_policy_agreement_policy->notification_sender->from_email;
                        $speaker_encrypted_id = encrypt($speaker->id);
                        $template = Str::of($speaker_policy_agreement_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$speaker->first_name, $speaker->last_name, $speaker->email, env('APP_FRONT_END') . 'applications/speaker-agreement' . '?id=' . $speaker_encrypted_id]);
                        // $send = new sendMailForCME();

                        $speaker->notify(new DefaultNotification(
                            $template,
                            $speaker_policy_agreement_policy->subject,
                            $sender,
                            $sender
                        ));
                    $speaker = CMESpeaker::find($speaker->id);
                    $speaker->is_policy_agreement_email_sent = 1;
                    $speaker->policy_agreement_email_sent_date = Carbon::now();
                    $speaker->save();

                    //    $is_mail_sent = $send->sendMail($speaker->email, $template, $speaker_policy_agreement_policy->subject, $sender);
                    //    if ($is_mail_sent == "success") {
                    //        $speaker = CMESpeaker::find($speaker->id);
                    //        $speaker->is_policy_agreement_email_sent = 1;
                    //        $speaker->policy_agreement_email_sent_date = Carbon::now();
                    //        $speaker->save();
                    //    }
                   }
               }
               else{

                   if (!empty($speaker_disclosure_policy) && !empty($speaker_disclosure_policy->message)) {
                       $sender = $speaker_disclosure_policy->notification_sender->from_email;
                       $speaker_disclosure_id = encrypt($speaker->id);
                       $template = Str::of($speaker_disclosure_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$speaker->first_name, $speaker->last_name, $speaker->email, env('APP_FRONT_END') . 'applications/speaker-disclosure' . '?id=' . $speaker_disclosure_id]);
                    //    $send = new sendMailForCME();

                    $speaker->notify(new DefaultNotification(
                        $template,
                        $speaker_disclosure_policy->subject,
                        $sender,
                        $sender
                    ));
                    $speaker = CMESpeaker::find($speaker->id);
                    $speaker->is_disclosure_email_sent = 1;
                    $speaker->disclosure_email_sent_date = Carbon::now();
                    $speaker->save();
                    //    $is_mail_sent = $send->sendMail($speaker->email, $template, $speaker_disclosure_policy->subject, $sender);
                    //    if ($is_mail_sent == "success") {
                    //        $speaker = CMESpeaker::find($speaker->id);
                    //        $speaker->is_disclosure_email_sent = 1;
                    //        $speaker->disclosure_email_sent_date = Carbon::now();
                    //        $speaker->save();
                    //    }
                   }
               }

        }

        return "hello";
    
    }
}
