<?php

namespace App\GraphQL\Queries;

use App\Mail\mail1;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use stdClass;

use Illuminate\Support\Facades\Mail;

final class Decrypt
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
		$data = new StdClass();
        // Log::info($args['amount']);
        $amount = Crypt::decryptString($args['amount']);
        $url = Crypt::decryptString($args['url']);
        Log::info($amount);
        $data->amount = $amount;
        $data->url = $url;
        // $url = decrypt($args['url']);
        //  Log::info($amount);
        // Log::info($url);

        return $data;
    }
}
