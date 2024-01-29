<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Policy;
use App\Models\PolicyPermission;
use App\Models\User;

class policiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(empty(Policy::where(['slug' => 'super-admin'])->first()))
        {
            $policy=Policy::create([
                'name' => 'super admin',
                'slug' => 'super-admin',
                'is_guest' => 0,
                'status' => 1,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
            ]);
            DB::table('policies_permissions')->insert([
                ['name'=>'access user','slug'=>'access_user','policy_id'=>$policy->id],
                ['name'=>'create user','slug'=>'create_user','policy_id'=>$policy->id],
                ['name'=>'update user','slug'=>'update_user','policy_id'=>$policy->id],
                ['name'=>'delete user','slug'=>'delete_user','policy_id'=>$policy->id],
                ['name'=>'show user','slug'=>'show_user','policy_id'=>$policy->id],
                ['name'=>'access policy','slug'=>'access_policy','policy_id'=>$policy->id],
                ['name'=>'create policy','slug'=>'create_policy','policy_id'=>$policy->id],
                ['name'=>'update policy','slug'=>'update_policy','policy_id'=>$policy->id],
                ['name'=>'delete policy','slug'=>'delete_policy','policy_id'=>$policy->id],
                ['name'=>'show policy','slug'=>'show_policy','policy_id'=>$policy->id],
                ['name'=>'access cms','slug'=>'access_cms','policy_id'=>$policy->id],
                ['name'=>'access dashboard','slug'=>'access_dashboard','policy_id'=>$policy->id],
                ['name'=>'access parameters','slug'=>'access_parameters','policy_id'=>$policy->id],
                ['name'=>'access products','slug'=>'access_products','policy_id'=>$policy->id],
                ['name'=>'access membership','slug'=>'access_membership','policy_id'=>$policy->id],
                ['name'=>'access broadcast','slug'=>'access_broadcast','policy_id'=>$policy->id],
                ['name'=>'access menu-items','slug'=>'access_menu-items','policy_id'=>$policy->id],
                ['name'=>'create menu-items','slug'=>'create_menu-items','policy_id'=>$policy->id],
                ['name'=>'update menu-items','slug'=>'update_menu-items','policy_id'=>$policy->id],
                ['name'=>'delete menu-items','slug'=>'delete_menu-items','policy_id'=>$policy->id],
                ['name'=>'show menu-items','slug'=>'show_menu-items','policy_id'=>$policy->id],
                ['name'=>'access menu-types','slug'=>'access_menu-types','policy_id'=>$policy->id],
                ['name'=>'create menu-types','slug'=>'create_menu-types','policy_id'=>$policy->id],
                ['name'=>'update menu-types','slug'=>'update_menu-types','policy_id'=>$policy->id],
                ['name'=>'delete menu-types','slug'=>'delete_menu-types','policy_id'=>$policy->id],
                ['name'=>'show menu-types','slug'=>'show_menu-types','policy_id'=>$policy->id],
                ['name'=>'access html-templates','slug'=>'access_html-templates','policy_id'=>$policy->id],
                ['name'=>'create html-templates','slug'=>'create_html-templates','policy_id'=>$policy->id],
                ['name'=>'update html-templates','slug'=>'update_html-templates','policy_id'=>$policy->id],
                ['name'=>'delete html-templates','slug'=>'delete_html-templates','policy_id'=>$policy->id],
                ['name'=>'show html-templates','slug'=>'show_html-templates','policy_id'=>$policy->id],
                ['name'=>'access pages','slug'=>'access_pages','policy_id'=>$policy->id],
                ['name'=>'create pages','slug'=>'create_pages','policy_id'=>$policy->id],
                ['name'=>'update pages','slug'=>'update_pages','policy_id'=>$policy->id],
                ['name'=>'delete pages','slug'=>'delete_pages','policy_id'=>$policy->id],
                ['name'=>'show pages','slug'=>'show_pages','policy_id'=>$policy->id],
                ['name'=>'access file-manager','slug'=>'access_file-manager','policy_id'=>$policy->id],
                ['name'=>'create file-manager','slug'=>'create_file-manager','policy_id'=>$policy->id],
                ['name'=>'update file-manager','slug'=>'update_file-manager','policy_id'=>$policy->id],
                ['name'=>'delete file-manager','slug'=>'delete_file-manager','policy_id'=>$policy->id],
                ['name'=>'show file-manager','slug'=>'show_file-manager','policy_id'=>$policy->id],
                ['name'=>'access specialities','slug'=>'access_specialities','policy_id'=>$policy->id],
                ['name'=>'create specialities','slug'=>'create_specialities','policy_id'=>$policy->id],
                ['name'=>'update specialities','slug'=>'update_specialities','policy_id'=>$policy->id],
                ['name'=>'delete specialities','slug'=>'delete_specialities','policy_id'=>$policy->id],
                ['name'=>'show specialities','slug'=>'show_specialities','policy_id'=>$policy->id],
                ['name'=>'access job-titles','slug'=>'access_job-titles','policy_id'=>$policy->id],
                ['name'=>'create job-titles','slug'=>'create_job-titles','policy_id'=>$policy->id],
                ['name'=>'update job-titles','slug'=>'update_job-titles','policy_id'=>$policy->id],
                ['name'=>'delete job-titles','slug'=>'delete_job-titles','policy_id'=>$policy->id],
                ['name'=>'show job-titles','slug'=>'show_job-titles','policy_id'=>$policy->id],
                ['name'=>'access tax-groups','slug'=>'access_tax-groups','policy_id'=>$policy->id],
                ['name'=>'create tax-groups','slug'=>'create_tax-groups','policy_id'=>$policy->id],
                ['name'=>'update tax-groups','slug'=>'update_tax-groups','policy_id'=>$policy->id],
                ['name'=>'delete tax-groups','slug'=>'delete_tax-groups','policy_id'=>$policy->id],
                ['name'=>'show tax-groups','slug'=>'show_tax-groups','policy_id'=>$policy->id],
                ['name'=>'access taxes','slug'=>'access_taxes','policy_id'=>$policy->id],
                ['name'=>'create taxes','slug'=>'create_taxes','policy_id'=>$policy->id],
                ['name'=>'update taxes','slug'=>'update_taxes','policy_id'=>$policy->id],
                ['name'=>'delete taxes','slug'=>'delete_taxes','policy_id'=>$policy->id],
                ['name'=>'show taxes','slug'=>'show_taxes','policy_id'=>$policy->id],
                ['name'=>'access nationalities','slug'=>'access_nationalities','policy_id'=>$policy->id],
                ['name'=>'create nationalities','slug'=>'create_nationalities','policy_id'=>$policy->id],
                ['name'=>'update nationalities','slug'=>'update_nationalities','policy_id'=>$policy->id],
                ['name'=>'delete nationalities','slug'=>'delete_nationalities','policy_id'=>$policy->id],
                ['name'=>'show nationalities','slug'=>'show_nationalities','policy_id'=>$policy->id],
                ['name'=>'access regions','slug'=>'access_regions','policy_id'=>$policy->id],
                ['name'=>'create regions','slug'=>'create_regions','policy_id'=>$policy->id],
                ['name'=>'update regions','slug'=>'update_regions','policy_id'=>$policy->id],
                ['name'=>'delete regions','slug'=>'delete_regions','policy_id'=>$policy->id],
                ['name'=>'show regions','slug'=>'show_regions','policy_id'=>$policy->id],
                ['name'=>'access countries','slug'=>'access_countries','policy_id'=>$policy->id],
                ['name'=>'create countries','slug'=>'create_countries','policy_id'=>$policy->id],
                ['name'=>'update countries','slug'=>'update_countries','policy_id'=>$policy->id],
                ['name'=>'delete countries','slug'=>'delete_countries','policy_id'=>$policy->id],
                ['name'=>'show countries','slug'=>'show_countries','policy_id'=>$policy->id],
                ['name'=>'access country-types','slug'=>'access_country-types','policy_id'=>$policy->id],
                ['name'=>'create country-types','slug'=>'create_country-types','policy_id'=>$policy->id],
                ['name'=>'update country-types','slug'=>'update_country-types','policy_id'=>$policy->id],
                ['name'=>'delete country-types','slug'=>'delete_country-types','policy_id'=>$policy->id],
                ['name'=>'show country-types','slug'=>'show_country-types','policy_id'=>$policy->id],
                ['name'=>'access states','slug'=>'access_states','policy_id'=>$policy->id],
                ['name'=>'create states','slug'=>'create_states','policy_id'=>$policy->id],
                ['name'=>'update states','slug'=>'update_states','policy_id'=>$policy->id],
                ['name'=>'delete states','slug'=>'delete_states','policy_id'=>$policy->id],
                ['name'=>'show states','slug'=>'show_states','policy_id'=>$policy->id],
                ['name'=>'access cities','slug'=>'access_cities','policy_id'=>$policy->id],
                ['name'=>'create cities','slug'=>'create_cities','policy_id'=>$policy->id],
                ['name'=>'update cities','slug'=>'update_cities','policy_id'=>$policy->id],
                ['name'=>'delete cities','slug'=>'delete_cities','policy_id'=>$policy->id],
                ['name'=>'show cities','slug'=>'show_cities','policy_id'=>$policy->id],
                ['name'=>'access role-hours','slug'=>'access_role-hours','policy_id'=>$policy->id],
                ['name'=>'create role-hours','slug'=>'create_role-hours','policy_id'=>$policy->id],
                ['name'=>'update role-hours','slug'=>'update_role-hours','policy_id'=>$policy->id],
                ['name'=>'delete role-hours','slug'=>'delete_role-hours','policy_id'=>$policy->id],
                ['name'=>'show role-hours','slug'=>'show_role-hours','policy_id'=>$policy->id],
                ['name'=>'access products','slug'=>'access_products','policy_id'=>$policy->id],
                ['name'=>'create products','slug'=>'create_products','policy_id'=>$policy->id],
                ['name'=>'update products','slug'=>'update_products','policy_id'=>$policy->id],
                ['name'=>'delete products','slug'=>'delete_products','policy_id'=>$policy->id],
                ['name'=>'show products','slug'=>'show_products','policy_id'=>$policy->id],
                ['name'=>'access product-country-type','slug'=>'access_product-country-type','policy_id'=>$policy->id],
                ['name'=>'create product-country-type','slug'=>'create_product-country-type','policy_id'=>$policy->id],
                ['name'=>'update product-country-type','slug'=>'update_product-country-type','policy_id'=>$policy->id],
                ['name'=>'delete product-country-type','slug'=>'delete_product-country-type','policy_id'=>$policy->id],
                ['name'=>'show product-country-type','slug'=>'show_product-country-type','policy_id'=>$policy->id],
                ['name'=>'access add-members','slug'=>'access_add-members','policy_id'=>$policy->id],
                ['name'=>'create add-members','slug'=>'create_add-members','policy_id'=>$policy->id],
                ['name'=>'update add-members','slug'=>'update_add-members','policy_id'=>$policy->id],
                ['name'=>'delete add-members','slug'=>'delete_add-members','policy_id'=>$policy->id],
                ['name'=>'show add-members','slug'=>'show_add-members','policy_id'=>$policy->id],
                ['name'=>'access membership','slug'=>'access_membership','policy_id'=>$policy->id],
                ['name'=>'create membership','slug'=>'create_membership','policy_id'=>$policy->id],
                ['name'=>'update membership','slug'=>'update_membership','policy_id'=>$policy->id],
                ['name'=>'delete membership','slug'=>'delete_membership','policy_id'=>$policy->id],
                ['name'=>'show membership','slug'=>'show_membership','policy_id'=>$policy->id],
                ['name'=>'access notification-senders','slug'=>'access_notification-senders','policy_id'=>$policy->id],
                ['name'=>'create notification-senders','slug'=>'create_notification-senders','policy_id'=>$policy->id],
                ['name'=>'update notification-senders','slug'=>'update_notification-senders','policy_id'=>$policy->id],
                ['name'=>'delete notification-senders','slug'=>'delete_notification-senders','policy_id'=>$policy->id],
                ['name'=>'show notification-senders','slug'=>'show_notification-senders','policy_id'=>$policy->id],
                ['name'=>'access automated-notification','slug'=>'access_automated-notification','policy_id'=>$policy->id],
                ['name'=>'create automated-notification','slug'=>'create_automated-notification','policy_id'=>$policy->id],
                ['name'=>'update automated-notification','slug'=>'update_automated-notification','policy_id'=>$policy->id],
                ['name'=>'delete automated-notification','slug'=>'delete_automated-notification','policy_id'=>$policy->id],
                ['name'=>'show automated-notification','slug'=>'show_automated-notificatio','policy_id'=>$policy->id],
                ]
            );
            $user=User::first();
            DB::table('user_policies')->insert([['user_id'=>$user->id,'policy_id'=>$policy->id]]);
        }
    }
}
