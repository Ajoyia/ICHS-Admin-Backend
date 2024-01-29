<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddPoliciesSeeder extends Seeder
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
        DB::table('policies_permissions')->truncate();
        DB::table('policies')->truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
       

        $data = [
                [
                    'name' => 'Super Admin',
                    'slug' => 'super-admin',
                    'description' => 'Super Admin',
                    'created_by' => 1,
                    'is_guest' => 1,
                    'is_deleteable' => 0
                ],
                [
                    'name' => 'On Signup',
                    'slug' => 'on-signup',
                    'description' => 'On User Signup',
                    'created_by' => 1,
                    'is_guest' => 0,
                    'is_deleteable' => 0
                ],
                [
                    'name' => 'Verified User',
                    'slug' => 'verified-user',
                    'description' => 'Verified User',
                    'created_by' => 1,
                    'is_guest' => 0,
                    'is_deleteable' => 0

                ],
                [
                    'name' => 'Member',
                    'slug' => 'member',
                    'description' => 'Member',
                    'is_guest' => 0,
                    'created_by' => 1,
                    'is_deleteable' => 0
                ]

            ];

        Policy::upsert($data, 'slug');

        // $names = ["Super Admin", "On Signup", "Verified User", "Member"];


    //     for ($i = 0; $i < count($names); $i++) {
    //         $is_exist = Policy::where('name', '=', $names[$i])->first();
    //         if ($is_exist === null) {
    //             // Policy::create([
    //             //     'name' => $names[$i],
    //             //     'Slug'=>Str::slug($names[$i]),
    //             //     'created_by' => 1,
    //             //     'is_deleteable' => 0
    //             // ]);
    //         }
    //     }

       }
}
