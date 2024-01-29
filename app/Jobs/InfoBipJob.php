<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Robtimus\Multipart\MultipartFormData;

class InfoBipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const BASE_URI = 'https://api.infobip.com/';

    public $content, $subject, $postData, $bulkRecepients;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content, $subject, $postData)
    {
        $this->queue = 'infobip_email';
        $this->content = $content;
        $this->subject = $subject;
        $this->postData = $postData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // $this->postData['key']=$this->postData['edition']->infobip_key;
        $multipart = new MultipartFormData();

        $multipart->addValue('from', $this->postData['from']);

        $toObject['to']=(is_array($this->postData['to']) ? $this->postData['to'][0] : $this->postData['to']);

        $multipart->addValue('to', json_encode($toObject));

        $multipart->addValue('subject',$this->postData['subject']);

        if(!empty($this->postData['ccEmails'])){
            foreach ($this->postData['ccEmails'] as $key => $ccEmail) {
                    $multipart->addValue('cc', $ccEmail);
            }
        }

        if(!empty($this->postData['bccEmails'])){
            foreach ($this->postData['bccEmails'] as $key => $bccEmail) {
                $multipart->addValue('bcc', $bccEmail);
            }
        }

        if(isset($this->postData['attachment']) && is_array($this->postData['attachment']) && count($this->postData['attachment']) > 0)
        {
            foreach($this->postData['attachment'] as $attachment)
            {
                // dump($attachment);
                $multipart->addFile(basename($attachment), base64_encode(file_get_contents($attachment)), mime_content_type($attachment),-1, 'base64');
                // $multipart->addFile('Reciept', base64_encode(($attachment)), mime_content_type($attachment),-1, 'base64');
            }

        }
        // Log::alert($multipart->getContentType());
        $multipart->addValue('html',  $this->postData['html']);
        $multipart->finish();


        $curl = curl_init();
            curl_setopt_array($curl,[
            CURLOPT_URL => self::BASE_URI.'email/2/send',
            CURLOPT_UPLOAD => true,
            CURLOPT_READFUNCTION => [$multipart, 'curl_read'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
            'Authorization: App ' . $this->postData['key'],
            'Content-Type: ' . $multipart->getContentType(),
            'Content-Length: ' . $multipart->getContentLength()
            ],
        ]);


        $response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        // dump('here____112');
        // dd($curl);

        if($http_status!=200)
        {
            // Log::error(json_encode($response));
            throw new \ErrorException(json_encode($response));
        }


    }
}
