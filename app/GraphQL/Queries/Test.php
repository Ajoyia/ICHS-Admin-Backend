<?php

namespace App\GraphQL\Queries;

use App\classes\emailSender;
use App\Mail\mail1;
use Illuminate\Support\Facades\Mail;

final class Test
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $sender=new emailSender(2);
        // Mail::to('moaz.rana@index.ae')
        // ->later(now()->addSeconds(1), );
        // Mail::to('moaz.rana@index.ae')->send(new mail1());
        return 'yupi hoi!!!';
    }
}
