<?php


namespace App\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ElesticEmail
{
    private $base_url;

    public $content, $subject, $postData,$returnRequest;

    function __construct($content, $subject, $postData)
    {
        $this->content = $content;
        $this->subject = $subject;
        $this->postData = $postData;
        $this->returnRequest=[];
        $this->base_url=env('ELESTIC_URL');
        $this->createRequest();
        $this->sendEmail();

    }
    /* send request */
    private function sendEmail()
    {
        $client = new Client(['base_uri' => $this->base_url]);


        $response = $client->request('POST', $this->campaignUrl(), ['headers'=>[
                'Content-Type'=>'application/json',
                'X-ElasticEmail-ApiKey'=>$this->postData['key'],
                'Accept'=>'application/json',
            ]
            ,'json' => $this->returnRequest]);

        // Log::error(json_encode($this->returnRequest));
        if($response->getStatusCode()!=200)
        {

            throw new \ErrorException(json_encode($response));
        }
        return $response;

    }

    private function createRequest()
    {


        $returnRequest['Content']['EnvelopeFrom']=$this->postData['from'];
        $returnRequest['Content']['ReplyTo']=$this->postData['from'];
        $returnRequest['Content']['From']=$this->postData['from'];
        $returnRequest['Recipients']=['To'=>[$this->postData['to']]];
        $returnRequest['Content']['Subject']=$this->postData['subject'];

        if(!empty($this->postData['ccEmails'])){
            $returnRequest['Recipients']['CC']=$this->postData['ccEmails'];
        }

        if(!empty($this->postData['bccEmails'])){
            $returnRequest['Recipients']['BCC']=$this->postData['bccEmails'];
        }

        $body['Content']=$this->postData['html'];
        $body['ContentType']="HTML";

        $returnRequest['Content']['Body'][]=$body;

        if(isset($this->postData['attachment']) && is_array($this->postData['attachment']) && count($this->postData['attachment']) > 0)
        {
            foreach($this->postData['attachment'] as $attachment)
            {


                $returnRequest['AttachFiles'][]=basename($attachment);
                $returnRequest['Attachments'][]=[
                                                 'Name'=>basename($attachment),
                                                 'BinaryContent'=>$this->data_uri($attachment),
                                                ];
              //  $multipart->addFile(basename($attachment).PHP_EO, file_get_contents($attachment), basename($attachment).PATHINFO_EXTENSION);
            }

        }

        $this->returnRequest=$returnRequest;
    }

    private function campaignUrl()
    {
        if(isset($this->postData['to']) && !empty($this->postData['to']))
        {
            return 'emails/transactional';
        }else{
            return 'emails';
        }
    }


    private function data_uri($file) {

      return base64_encode(file_get_contents($file));

   }

}
