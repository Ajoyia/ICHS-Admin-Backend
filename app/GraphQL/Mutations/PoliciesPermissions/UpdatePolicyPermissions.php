<?php

namespace App\GraphQL\Mutations\PoliciesPermissions;

use App\Models\Policy;
use App\Models\PolicyPermission;
use Illuminate\Support\Facades\Log;

final class UpdatePolicyPermissions
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $p=Policy::find($args['id']);
        // $p = Policy::where('slug', $args['id'])->first();
        if ($args['flag'] == 1){
            $pps=PolicyPermission::where('policy_id',$p->id)->get();
            foreach($pps as $pp){
                $pp->delete();
            }
        }
        Log:info(array_unique($args['permissions']));
        foreach(array_unique($args['permissions']) as $permission){
            $npp=new PolicyPermission();
            $npp->name=$permission;
            $npp->slug=str_replace(" ","_",$permission);
            $npp->policy_id=$p->id;
            $npp->save();
        }

        return $p;
    }
}
