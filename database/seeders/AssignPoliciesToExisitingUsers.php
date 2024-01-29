<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserPolicy;
use Illuminate\Support\Facades\DB;

class AssignPoliciesToExisitingUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_policies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $frontend_users = User::where('email','!=','admin@ichs.uk')->get();

        if($frontend_users->count() > 0){
            foreach($frontend_users as $frontend_user){
                UserPolicy::create([
                        'user_id' => $frontend_user->id,
                        'policy_id' => 2,
                        'created_by' => 1
                    ]);
            
                if($frontend_user->email_verified_at != null){
                    UserPolicy::create([
                        'user_id' => $frontend_user->id,
                        'policy_id' => 3,
                        'created_by' => 1
                    ]);
                }
                if($frontend_user->memberships != null){
                    UserPolicy::create([
                        'user_id' => $frontend_user->id,
                        'policy_id' => 4,
                        'created_by' => 1
                    ]);
                }
            }
        }
        $admin_user = User::where('email','admin@ichs.uk')->first();
        if ($frontend_users->count() > 0) {

            UserPolicy::create([
                'user_id' => $admin_user->id,
                'policy_id' => 1,
                'created_by' => 1
            ]);
        }

    }
}
