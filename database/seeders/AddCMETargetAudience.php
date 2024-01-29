<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmeTargetAudience;

class AddCMETargetAudience extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Doctors", "Nurses", "Pharmacists","Laboratory","Imaging","Other","Leadership","Others","Not Available"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CmeTargetAudience::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CmeTargetAudience::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
