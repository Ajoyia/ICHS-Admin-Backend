<?php

namespace App\Jobs;

use App\classes\CMEPaymentNotification;
use App\classes\sendMailForCME;
use Illuminate\Bus\Queueable;

use App\Notifications\DefaultNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use App\Models\CMESpeaker;
use App\Models\AutomatedNotification;
use App\Models\CMEActivityAdministrator;
use App\Models\Url;
use Illuminate\Support\Facades\Crypt;
use App\Models\CMEApplication;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CMESuccessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $cme_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cme_id)
    {
        $this->queue = 'cme_success_email';
        $this->cme_id = $cme_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails = [];
		$cme_application = CMEApplication::where('id', $this->cme_id)->with('activity_administrators','speakers','user')->first();
		// $cmePaymentotification = new CMEPaymentNotification();
		// $notification = $cmePaymentotification->notification();
		// if (!empty($notification) && !empty($notification->message)) {
			// $sender=$notification->notification_sender->from_email;

				// $user_url=Url::create([
				// 	'model_id' => $cme_application->id,
				// 	'model_type' => 'App\Models\CMEApplication',
				// 	'application_id' => $cme_application->id,
				// 	'application_type' => 'App\Models\CMEApplication'
				// ]);
				// $emails[] = [
				// 	'first_name' => $cme_application->first_name,
				// 	'last_name' => $cme_application->last_name,
				// 	'email' => $cme_application->email,
				// 	'id' => $user_url->id
				// ];
			$administrator_policy_agreement_policy = AutomatedNotification::where('type', "agreement_form_administrator")->whereNull('deleted_at')->first();
			if (!empty($administrator_policy_agreement_policy) && !empty($administrator_policy_agreement_policy->message)) {
				if($cme_application->activity_administrators->count() > 0) {
					foreach($cme_application->activity_administrators as $administrator) {
						Url::create([
							'model_id' => $administrator->id,
							'model_type' => 'App\Models\CMEActivityAdministrator',
							'application_id' => $cme_application->id,
							'application_type' => 'App\Models\CMEApplication'
						]);
						$sender=$administrator_policy_agreement_policy->notification_sender->from_email;
						$encrypted_id = encrypt($administrator->id);
						$template = Str::of($administrator_policy_agreement_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}','{{link}}'], [$administrator->first_name, $administrator->last_name,$administrator->email,env('APP_FRONT_END').'applications/administrator-agreement'.'?id='.$encrypted_id]);
						// $send = new sendMailForCME();

								$administrator->notify(new DefaultNotification(
								$template,
								$administrator_policy_agreement_policy->subject,
								$sender,
								$sender
							));

					$administrator->is_policy_agreement_email_sent = 1;
					$administrator->policy_agreement_email_sent_date = Carbon::now();
					$administrator->save();
						
						// $is_mail_sent = $send->sendMail($administrator->email,$template,$administrator_policy_agreement_policy->subject,$sender);
						// if($is_mail_sent=="success"){
						// 	$administrator = CMEActivityAdministrator::find($administrator->id);
						// 	Log::info($administrator);
						// 	$administrator->is_policy_agreement_email_sent = 1;
						// 	$administrator->policy_agreement_email_sent_date = Carbon::now();
						// 	$administrator->save();
						// }
						// $emails[] = [
						// 	'first_name' => $administrator->first_name,
						// 	'last_name' => $administrator->last_name,
						// 	'email' => $administrator->email,
						// 	'id' => $activity_administrator_url->id
						// ];
					}
				} 
			}
			$speaker_policy_agreement_policy = AutomatedNotification::where('type', "agreement_form_speaker")->whereNull('deleted_at')->first();
			$speaker_disclosure_policy = AutomatedNotification::where('type', "disclosure_form_speaker")->whereNull('deleted_at')->first();
			if($cme_application->speakers->count() > 0){
				foreach($cme_application->speakers as $speaker)
				{
					Url::create([
						'model_id' => $speaker->id,
						'model_type' => 'App\Models\CMESpeaker',
						'application_id' => $cme_application->id,
						'application_type' => 'App\Models\CMEApplication'
					]);
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

					$speaker->is_policy_agreement_email_sent = 1;
					$speaker->policy_agreement_email_sent_date = Carbon::now();
					$speaker->save();

					// $is_mail_sent = $send->sendMail($speaker->email, $template, $speaker_policy_agreement_policy->subject, $sender);
					// if ($is_mail_sent == "success") {
					// 	$speaker = CMESpeaker::find($speaker->id);
					// 	Log::info($speaker);
					// 	$speaker->is_policy_agreement_email_sent = 1;
					// 	$speaker->policy_agreement_email_sent_date = Carbon::now();
					// 	$speaker->save();
					// }

				}

				if (!empty($speaker_disclosure_policy) && !empty($speaker_disclosure_policy->message)) {
					$sender = $speaker_disclosure_policy->notification_sender->from_email;
					$speaker_disclosure_id = encrypt($speaker->id);
					$template = Str::of($speaker_disclosure_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$speaker->first_name, $speaker->last_name, $speaker->email, env('APP_FRONT_END') . 'applications/speaker-disclosure' . '?id=' . $speaker_disclosure_id]);
					// $send = new sendMailForCME();
					$speaker->notify(new DefaultNotification(
						$template,
						$speaker_disclosure_policy->subject,
						$sender,
						$sender
					));

					$speaker->is_disclosure_email_sent = 1;
					$speaker->disclosure_email_sent_date = Carbon::now();
					$speaker->save();
					
						// $is_mail_sent = $send->sendMail($speaker->email, $template, $speaker_disclosure_policy->subject, $sender);
					// if ($is_mail_sent == "success") {
					// 	$speaker = CMESpeaker::find($speaker->id);
					// 	Log::info($speaker);
					// 	$speaker->is_disclosure_email_sent = 1;
					// 	$speaker->disclosure_email_sent_date = Carbon::now();
					// 	$speaker->save();
					// }
				}

					// $emails[] = [
					// 	'first_name' => $speaker->first_name,
					// 	'last_name' => $speaker->last_name,
					// 	'email' => $speaker->email,
					// 	'id' => $speaker_url->id
					// ];
				}
			}	
			
               
            
    }
}
