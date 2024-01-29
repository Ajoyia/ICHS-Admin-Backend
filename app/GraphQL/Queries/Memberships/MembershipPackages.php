<?php

namespace App\GraphQL\Queries\Memberships;

use Carbon\Carbon;
use App\Models\User;
use App\classes\calculateTax;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

final class MembershipPackages
{
    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        if($user->country_id){
            $product=ProductCountryType::whereHas('product',function($q){
                $q->where('link_product',1);
            })
            ->whereDoesntHave('country_type')
            ->whereHas('membershipTypes',function($q) use($user){
                if(!(isset($user->memberships->status)&&$user->memberships->status==1)||!(new Carbon($user->memberships->start_date)<=Carbon::now()->subYear(1)))
                    $q->where('membership_types.name','<>','Fellowship');
            })
            ->with(['country_type','tax_group.Taxes','membershipTypes'])
            ->has('membershipTypes')->has('tax_group')
            ->where('status',1)
            ->orWhereHas('country_type',function($q) use ($user){
                $q->where('country_type_id',$user->country->country_types[0]->id);
            })
            ->where('status',1)
            ->get();

        }
        return json_encode($product);

    }
}
