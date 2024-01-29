<?php

namespace App\GraphQL\Mutations\ApplicationSignatures;
use App\Models\ApplicationSignature;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Notifications\DefaultNotification;
use App\classes\sendMailForCME;
use App\Models\AutomatedNotification;
use App\Models\CMEActivityAdministrator;
use App\Models\CMESpeaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final class CreateApplicationSignature
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $pdfLink = 'signatures/cme_cpd/' . time() . '.pdf';

        $now = Carbon::now();
        
        $template = ApplicationSignature::create([
            'model_id' => $args['model_id'],
            'model_type' => $args['model_type'],
            'signature_path' => Storage::put('/signatures/cme_cpd/images',$args['signature']),
            'pdf_path' => $pdfLink,
            'signature_type' => $args['signature_type']
        ]);
        $new_signature = ApplicationSignature::find($template->id);
        $new_signature->signature_unique_id = $args['signature_type']. '-'.$now->year . '-ICHS-' . $template->id;
        $new_signature->save();
       
        if($args['signature_type'] == 'policy' && $args['model_type']== 'App\Models\CMEActivityAdministrator'){
            $cme_activity_administrator = CMEActivityAdministrator::find($args['model_id']);
            $invoiceData = [
                'reference_id' => $args['signature_type'] . '-' . $now->year . '-ICHS-' . $template->id,
                'date' => Carbon::now(),
                'full_name' => $cme_activity_administrator->first_name . ' ' . $cme_activity_administrator->last_name,
                'email' => $cme_activity_administrator->email

            ];
            $pdf = PDF::loadView('frontend.signatures.administrator_policy', ['administrator' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }
        if ($args['signature_type'] == 'policy' && $args['model_type'] == 'App\Models\CMESpeaker') {
            $cme_speaker = CMESpeaker::find($args['model_id']);
            $invoiceData = [
                'reference_id' => $args['signature_type'] . '-' . $now->year . '-ICHS-' . $template->id,
                'date' => Carbon::now(),
                'full_name' => $cme_speaker->first_name . ' ' . $cme_speaker->last_name,
                'email' => $cme_speaker->email

            ];
            $pdf = PDF::loadView('frontend.signatures.speaker_policy', ['speaker' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }

        if ($args['signature_type'] == 'disclosure' && $args['model_type'] == 'App\Models\CMESpeaker') {

            $cme_speaker = CMESpeaker::find($args['model_id']);
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
            $pdf = PDF::loadView('frontend.signatures.speaker_disclosure', ['speaker' => $invoiceData])->setOptions(['defaultFont' => 'sans-serif']);
            Storage::put($pdfLink, $pdf->output());
        }
       
        // $model_name = get_class($template->model);
        if($template->model){
            // $model_name::where('id', $template->model->id)->update([
            //         'application_signed_id' => $template->id,
            //         'is_approved' => 1
            // ]);
            $notification = AutomatedNotification::where('type', "cme_signature_payment")->whereNull('deleted_at')->first();
            // $send = new sendMailForCME();
            $sender=$notification->notification_sender->from_email;

            // Log::info(Storage::url($template->pdf_path));
            $path = $template->pdf_path;
            Log::info($path);
            $templateEmail = Str::of($notification->message)->replace(['{{first_name}}', '{{last_name}}','{{pdf_path}}'], [$template->model->first_name, $template->model->last_name,$path]);
                   

            if ($args['model_type'] == 'App\Models\CMESpeaker') {
                $speaker = CMESpeaker::find($args['model_id']);
                $speaker->notify(new DefaultNotification(
                    $templateEmail,
                    $notification->subject,
                    $sender,
                    $sender
                ));
            }

            if ($args['model_type'] == 'App\Models\CMEActivityAdministrator') {
                $administrator = CMEActivityAdministrator::find($args['model_id']);
                $administrator->notify(new DefaultNotification(
                    $templateEmail,
                    $notification->subject,
                    $sender,
                    $sender
                ));
            }


            // $send->sendMail($template->model->email,$templateEmail,$notification->subject,$sender);
        }

        return $template;
    }
}
