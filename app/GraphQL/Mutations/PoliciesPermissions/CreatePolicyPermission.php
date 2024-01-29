<?php

namespace App\GraphQL\Mutations\PoliciesPermissions;

use App\Models\Policy;
use Illuminate\Support\Str;
use App\Models\PolicyPermission;
use Illuminate\Support\Facades\Auth;

final class CreatePolicyPermission
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $pp=new PolicyPermission();
        $p=Policy::where('slug',$args['policy_id'])->first();
        $pp->name=$args['name'];
        $pp->policy_id=$p->id;
        $pp->created_by=Auth::id();
        $pp->slug=$p->slug.'-'.Str::slug($args['name']);
        $ppChk=PolicyPermission::where('slug',$pp->slug)->get();
        if(count($ppChk)){
            $pp->slug=$pp->slug.PolicyPermission::max('id')+1;
        }
        $pp->save();
        return $pp;
    }
}
