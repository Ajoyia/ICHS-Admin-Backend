<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CMESpeakerRole;

class AddCMESpeakerRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Speaker", "Assistant to speaker", "Chairperson","Moderator","Unknown","Presenter","Author","Co-Presenter","Co-Chairperson","Panelist","Jury Member"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CMESpeakerRole::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMESpeakerRole::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
