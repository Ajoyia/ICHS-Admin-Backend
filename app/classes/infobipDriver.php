<?php

namespace App\classes;

use App\Jobs\InfoBipJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\MessageConverter;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mailer\Transport\AbstractTransport;

class infobipDriver extends AbstractTransport{
    protected $client;
    private $cc=[];
    private $bcc=[];
    private $attachments=[];
    public function __construct($client)
    {
        parent::__construct();
        $this->client=$client;
    }
    protected function doSend(SentMessage $message): void
    {
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
        collect($email->getAttachments())->map(function ($attachment) {
            dump($attachment->getName());
            array_push($this->attachments,Storage::path('receipts/'.$attachment->getName()));
        })->all();
        // dump(file_get_contents('C:\laragon\www\ichs-be\storage\app\receipts\1666960842.pdf'));
        // dd($email->getAttachments());
        $postData=[
            'key'=>$this->client['key'],
            'from'=>$email->getFrom()[0]->getAddress(),
            'to'=>$to[0],
            'subject'=>$email->getSubject(),
            'ccEmails'=>$this->cc,
            'bccEmails'=>$this->bcc,
            'attachment'=>$this->attachments,
            'html'=>$email->getHtmlBody()
        ];
        dispatch(new InfoBipJob('abc','kithe gae si',$postData));
    }

    public function __toString(): string
    {
        return "infobip";
    }
}
