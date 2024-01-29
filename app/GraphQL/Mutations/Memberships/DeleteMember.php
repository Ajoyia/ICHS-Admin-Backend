<?php

namespace App\GraphQL\Mutations\Memberships;
use App\Models\Membership;
use App\Models\User;
use Auth;
use Carbon\Carbon;

final class DeleteMember
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user=User::find($args['id']);
        if(!empty($user))
        {
            if($user->is_accept==true)
            {
                Membership::where(['user_id'=>$args['id'],'status'=>1])->update(['status'=>0]);
                $user->parent_id=null;
                $user->updated_by=Auth::id();
                $user->save();
                return json_encode(['status'=>true,"message"=>"Membership release successfully"]);
            }else{
                $user->parent_id=null;
                $user->deleted_by=Auth::id();
                $user->deleted_at=Carbon::now();
                $user->save();
                return json_encode(['status'=>true,"message"=>"User deleted successfully"]);
            }
        }else{
            return json_encode(['status'=>false, "message"=>"User Not found"]);
        }
        
    }
}
