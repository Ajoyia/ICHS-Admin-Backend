<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use App\Notifications\DefaultNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use App\Models\AutomatedNotification;
use App\Models\Url;
use App\Models\AccredationApplication;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;

class AccredationSuccessMail implements ShouldQueue
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
        $this->queue = 'accredation_success_email';
        $this->cme_id = $cme_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$cme_application = AccredationApplication::where('id', $this->cme_id)->with('accredation_activity_administrators','speakers','user')->first();
		
			$administrator_policy_agreement_policy = AutomatedNotification::where('type', "agreement_form_administrator")->whereNull('deleted_at')->first();
			if (!empty($administrator_policy_agreement_policy) && !empty($administrator_policy_agreement_policy->message)) {
				if($cme_application->accredation_activity_administrators->count() > 0) {
					foreach($cme_application->accredation_activity_administrators as $administrator) {
						Url::create([
							'model_id' => $administrator->id,
							'model_type' => 'App\Models\AccredationActivityAdministrator',
							'application_id' => $cme_application->id,
							'application_type' => 'App\Models\AccredationApplication'
						]);
						$sender=$administrator_policy_agreement_policy->notification_sender->from_email;
						$encrypted_id = encrypt($administrator->id);
						$template = Str::of($administrator_policy_agreement_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}','{{link}}'], [$administrator->first_name, $administrator->last_name,$administrator->email,env('APP_FRONT_END').'conferences/administrator-agreement'.'?id='.$encrypted_id]);

								$administrator->notify(new DefaultNotification(
								$template,
								$administrator_policy_agreement_policy->subject,
								$sender,
								$sender
							));

					$administrator->is_policy_agreement_email_sent = 1;
					$administrator->policy_agreement_email_sent_date = Carbon::now();
					$administrator->save();
						
					
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
						'model_type' => 'App\Models\AccredationSpeaker',
						'application_id' => $cme_application->id,
						'application_type' => 'App\Models\AccredationApplication'
					]);
				if (!empty($speaker_policy_agreement_policy) && !empty($speaker_policy_agreement_policy->message)) {
					$sender = $speaker_policy_agreement_policy->notification_sender->from_email;
					$speaker_encrypted_id = encrypt($speaker->id);
					$template = Str::of($speaker_policy_agreement_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$speaker->first_name, $speaker->last_name, $speaker->email, env('APP_FRONT_END') . 'conferences/speaker-agreement' . '?id=' . $speaker_encrypted_id]);
					
					$speaker->notify(new DefaultNotification(
								$template,
							$speaker_policy_agreement_policy->subject,
						$sender,
						$sender
							));

					$speaker->is_policy_agreement_email_sent = 1;
					$speaker->policy_agreement_email_sent_date = Carbon::now();
					$speaker->save();


				}

				if (!empty($speaker_disclosure_policy) && !empty($speaker_disclosure_policy->message)) {
					$sender = $speaker_disclosure_policy->notification_sender->from_email;
					$speaker_disclosure_id = encrypt($speaker->id);
					$template = Str::of($speaker_disclosure_policy->message)->replace(['{{first_name}}', '{{last_name}}', '{{email}}', '{{link}}'], [$speaker->first_name, $speaker->last_name, $speaker->email, env('APP_FRONT_END') . 'conferences/speaker-disclosure' . '?id=' . $speaker_disclosure_id]);
					
					$speaker->notify(new DefaultNotification(
						$template,
						$speaker_disclosure_policy->subject,
						$sender,
						$sender
					));

					$speaker->is_disclosure_email_sent = 1;
					$speaker->disclosure_email_sent_date = Carbon::now();
					$speaker->save();
				
				}

				
				}
			}	
			
               
            
    }
}
