<?php

namespace App\GraphQL\Queries\PoliciesPermission;

final class GetAllPermissions
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if(isset($args['permission_type'])){
            switch($args['permission_type']){
                case 0:
                    return config('policies.frontend_permissions');
                    break;
                case 1:
                    return config('policies.admin_permissions');
                    break;
            }
        }
        return config('policies');
    }
}
