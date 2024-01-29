<?php

namespace App\GraphQL\Mutations\AccredationSignatures;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Notifications\DefaultNotification;
use App\Models\AccredationActivityAdministrator;
use App\Models\AccredationSignature;
use App\Models\AccredationSpeaker;
use App\Models\AutomatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class CreateAccredationSignature
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $pdfLink = 'signatures/accredation/' . time() . '.pdf';

        $now = Carbon::now();
        
        $template = AccredationSignature::create([
            'model_id' => $args['model_id'],
            'model_type' => $args['model_type'],
            'signature_path' => Storage::put('/signatures/accredation/images',$args['signature']),
            'pdf_path' => $pdfLink,
            'signature_type' => $args['signature_type']
        ]);
        $new_signature = AccredationSignature::find($template->id);
        $new_signature->signature_unique_id = $args['signature_type']. '-'.$now->year . '-ICHS-' . $template->id;
        $new_signature->save();
       
        if($args['signature_type'] == 'policy' && $args['model_type']== 'App\Models\AccredationActivityAdministrator'){
            $cme_activity_administrator = AccredationActivityAdministrator::find($args['model_id']);
            $invoiceData = [
                'reference_id' => $args['signature_type'] . '-' . $now->year . '-ICHS-' . $template->id,
                'date' => Carbon::now(),
                'full_name' => $cme_activity_administrator->first_name . ' ' . $cme_activity_administrator->last_name,
                'email' => $cme_activity_administrator->email

            ];
            $pdf = PDF::loadView('frontend.conference_signatures.administrator_policy', ['administrator' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }
        if ($args['signature_type'] == 'policy' && $args['model_type'] == 'App\Models\AccredationSpeaker') {
            $cme_speaker = AccredationSpeaker::find($args['model_id']);
            $invoiceData = [
                'reference_id' => $args['signature_type'] . '-' . $now->year . '-ICHS-' . $template->id,
                'date' => Carbon::now(),
                'full_name' => $cme_speaker->first_name . ' ' . $cme_speaker->last_name,
                'email' => $cme_speaker->email

            ];
            $pdf = PDF::loadView('frontend.conference_signatures.speaker_policy', ['speaker' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }

        if ($args['signature_type'] == 'disclosure' && $args['model_type'] == 'App\Models\AccredationSpeaker') {

            $cme_speaker = AccredationSpeaker::find($args['model_id']);
            $invoiceData = [
                'reference_id' => $args['signature_type'] . '-' . $now->year . '-ICHS-' . $template->id,
                'date' => Carbon::now(),
                'full_name' => $cme_speaker->first_name . ' ' . $cme_speaker->last_name,
                'email' => $cme_speaker->email,
                'degree' => $cme_speaker->degree,
                'phone_no' => $cme_speaker->phone_no,
                'is_financial_relation_with_entity' => $cme_speaker->is_financial_relation_with_entity,
                'is_financial_relation_with_content' => $cme_speaker->is_financial_relation_with_content,
                'activity_planned' => $cme_speaker->activity_planned,
                'company_name' => $cme_speaker->company_name,
                'relation_type' => $cme_speaker->relation_type,
                'content_area' => $cme_speaker->content_area

            ];
            $pdf = PDF::loadView('frontend.conference_signatures.speaker_disclosure', ['speaker' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }
       
       if($template->model){
           
            $notification = AutomatedNotification::where('type', "cme_signature_payment")->whereNull('deleted_at')->first();
            $sender=$notification->notification_sender->from_email;

            $path = $template->pdf_path;
            Log::info($path);
            $templateEmail = Str::of($notification->message)->replace(['{{first_name}}', '{{last_name}}','{{pdf_path}}'], [$template->model->first_name, $template->model->last_name,$path]);
                   

            if ($args['model_type'] == 'App\Models\AccredationSpeaker') {
                $speaker = AccredationSpeaker::find($args['model_id']);
                $speaker->notify(new DefaultNotification(
                    $templateEmail,
                    $notification->subject,
                    $sender,
                    $sender
                ));
            }

            if ($args['model_type'] == 'App\Models\AccredationActivityAdministrator') {
                $administrator = AccredationActivityAdministrator::find($args['model_id']);
                $administrator->notify(new DefaultNotification(
                    $templateEmail,
                    $notification->subject,
                    $sender,
                    $sender
                ));
            }


        }

        return $template;
    }
}
