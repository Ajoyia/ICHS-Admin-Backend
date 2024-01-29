<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use App\Notifications\DefaultNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use App\Models\AutomatedNotification;
use App\Models\Chapter;
use App\Models\ChapterEndorsement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;

class ChapterEnndorsementMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public $user_id,$chapter_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id,$chapter_id)
    {
        $this->queue = 'chapter_endorsement_mail';
        $this->user_id = $user_id;
		$this->chapter_id = $chapter_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$notification = AutomatedNotification::where('type', 'chapter_endorsement')->first();
		if (!empty($notification) && !empty($notification->message)) {
			$chapter = Chapter::findOrFail($this->chapter_id);
			$sender = $notification->notification_sender->from_email;

			foreach ($this->user_id as $user_id) {
				$user = User::findOrFail($user_id);
				$chapter_endorsement=ChapterEndorsement::updateOrCreate(
					['user_id' => $user_id, 'chapter_id' => $this->chapter_id],
					[
						'is_email_sent'  => 1,
						'email_sent_date'   => Carbon::now()
					]
				);
				$user_encrypted_id = encrypt($chapter_endorsement->id);
				$template = Str::of(
					$notification->message
				)->replace(
					['{{first_name}}', '{{last_name}}', '{{chapter_name}}', '{{country}}', '{{city}}', '{{link}}'],
					[$user->first_name, $user->last_name, $chapter->name, $chapter->country->name, $chapter->city->name, env('APP_FRONT_END') . 'applications/endorsement?id=' . $user_encrypted_id]
				);
				
					$user->notify(new DefaultNotification(
						$template,
						$notification->subject,
						$sender,
						$sender
					));
					
				
			}
		}    
            
    }
}
