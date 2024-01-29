<?php

namespace App\GraphQL\Queries\ApplicationSignature;

use App\Models\ApplicationSignature;
use App\Models\CMESpeaker;
use Illuminate\Support\Facades\Log;;

final class GetApplicationSignature
{
    public function __invoke($_, array $args)
    {
        $application = ApplicationSignature::where('signature_type', $args['type'])->where('model_id', $args['model_id'])->first();
        return $application;
    }
}
