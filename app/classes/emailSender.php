<?php

namespace App\classes;

define('MULTIPART_BOUNDARY', '----'.md5(time()));
define('EOL',"\r\n");

use Exception;
use App\Jobs\InfoBipJob;
use App\Services\ElesticEmail;
use PhpParser\Node\Stmt\Switch_;
use Illuminate\Support\Facades\Log;

class emailSender{
    const INFOBIP=1;
    const ELASTICEMAIL=2;

    private $postData;
    public function __construct($sender){
        Switch($sender){
            case emailSender::INFOBIP:
                $this->sendWithInfobip();
                break;
            case emailSender::ELASTICEMAIL:
                $this->sendWithElasticEmail();
                break;
        }
    }

    private function sendWithInfobip(){
        $postData=[
            'key'=>'27f4a3f8f992a78fcfa60786a0c45d8a-68de123f-1d8c-4040-8cec-9b30394f2b58',
            'from'=>'ichs@index.ae',
            'to'=>'moaz.rana@index.ae',
            'subject'=>'you are fired',
            'ccEmails'=>['muaazmehmood@gmail.com','abdullahjoyia502@gmail.com'],
            'bccEmails'=>['nadeem.mateen@index.ae'],
            'attachment'=>[]
        ];
        dispatch(new InfoBipJob('abc','kithe gae si',$postData));
    }

    private function sendWithElasticEmail(){
        $postData=[
            'key'=>env('ELESTIC_EMAIL_KEY'),
            'from'=>'itadmin@index.ae',
            'to'=>'moaz.rana@index.ae',
            'subject'=>'subject',
            'ccEmails'=>['muaazmehmood@gmail.com'],
            'bccEmails'=>['abdullah.joyia@index.ae'],
            'html'=>'<p>You are fired old</p>',
            'attachment'=>[],
        ];
        $ee=new ElesticEmail('kuch ni','chalo bhago yha se',$postData);
    }
}
