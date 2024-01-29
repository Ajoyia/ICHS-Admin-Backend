<?php

namespace App\Console\Commands;

use App\Models\Membership;
use App\Models\UserPolicy;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:membership';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $msg = '';
        $expire_memberships = Membership::where('end_date','<=',Carbon::now())->get();
        try {
            if ($expire_memberships->count() > 0) {
                foreach($expire_memberships as $membership){
                    if($membership->user != null){
                        $member_policy = UserPolicy::where('user_id', $membership->user->id)
                                            ->where('policy_id',4)->first();
                        if($member_policy != null){
                            UserPolicy::where('id', $member_policy->id)->delete();
                        }   
                    }
                }
            }
            $msg = 'success';
        }catch(\Exception $e){
            $msg = 'error';
        }
        return $msg;
    }   
}