<?php

namespace App\GraphQL\Mutations\Memberships;

use Illuminate\Support\Facades\Storage;
use App\Models\Membership;
final class SaveResumeMembership
{
    public function __invoke($_, array $args)
    {

        $filename = Storage::putFile('/membership/resume',$args['resume']);

        $resume = Membership::where('user_id',$args['user_id'])->first();
        $resume->resume=$filename;
        $resume->save();
        return $resume;

    }
}
