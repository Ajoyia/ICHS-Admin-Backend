<?php

namespace App\GraphQL\Queries\AccredationSignature;

use App\Models\AccredationSignature;

final class GetAccredationSignature
{
    public function __invoke($_, array $args)
    {
        $application = AccredationSignature::where('signature_type', $args['type'])->where('model_id', $args['model_id'])->first();
        return $application;
    }
}
