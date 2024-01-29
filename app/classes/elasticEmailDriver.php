<?php

namespace App\classes;

use App\Jobs\InfoBipJob;
use App\Services\ElesticEmail;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\MessageConverter;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mailer\Transport\AbstractTransport;

class elasticEmailDriver extends AbstractTransport{
    protected $client;
    private $cc=[];
    private $bcc=[];
    public function __construct($client)
    {
        parent::__construct();
        $this->client=$client;

    }
    protected function doSend(SentMessage $message): void
    {
        dump('sending');
        $email = MessageConverter::toEmail($message->getOriginalMessage());
        $to=collect($email->getTo())->map(function ($email) {
                    return [$email->getAddress()];
                })->all();
        collect($email->getCc())->map(function ($email) {
            array_push($this->cc,$email->getAddress());
        })->all();

        collect($email->getBcc())->map(function ($email) {
            array_push($this->bcc,$email->getAddress());
        })->all();

        $postData=[
            'key'=>$this->client['key'],
            'from'=>$email->getFrom()[0]->getAddress(),
            'to'=>$to[0][0],
            'subject'=>$email->getSubject(),
            'ccEmails'=>$this->cc,
            'bccEmails'=>$this->bcc,
            'html'=>$email->getHtmlBody(),
            'attachment'=>[],
        ];
        $ee=new ElesticEmail('kuch ni','chalo bhago yha se',$postData);
    }

    public function __toString(): string
    {
        return "elastic_email";
    }
}
