<?php

namespace App\GraphQL\Mutations\Chapters;

use App\Mail\GeneralEmail;
use App\Models\AutomatedNotification;
use App\Models\Chapter;
use App\Notifications\DefaultNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PDO;

final class sendChapterMail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $chapter = Chapter::find($args['chapter_id']);
        
        if($chapter->is_approved_by_admin == 1)
            $notification = AutomatedNotification::where('type', 'send_approve_mail_chapter')->first();
        else
            $notification = AutomatedNotification::where('type', 'send_reject_mail_chapter')->first();

        if (!empty($notification) && !empty($notification->message)) {
            $sender = $notification->notification_sender->from_email;
            $tempalte = Str::of($notification->message)->replace('{{first_name}}', $chapter->user->first_name);
            $tempalte = Str::of($tempalte)->replace('{{last_name}}', $chapter->user->last_name);
            $tempalte = Str::of($tempalte)->replace('{{chapter_name}}', $chapter->name);
            $tempalte = Str::of($tempalte)->replace('{{created_at}}', $chapter->created_at->format('M d Y'));
            $tempalte = Str::of($tempalte)->replace('{{country}}', $chapter->country->name);
            $tempalte = Str::of($tempalte)->replace('{{city}}', $chapter->city->name);


            $chapter->user->notify(new DefaultNotification(
                    $tempalte,
                    $notification->subject,
                    $sender,
                    $sender
                ));
            // Mail::to($chapter->user->email)
            //     ->cc([])
            //     ->bcc([])
            //     ->send(new GeneralEmail($tempalte, $notification->subject, $sender));
        }
        return "done";
    }
}
