<?php

namespace Database\Seeders;

use App\Models\AccredationTargetAudience;
use Illuminate\Database\Seeder;

class AddAccredationTargetAudience extends Seeder
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
            $is_exist = AccredationTargetAudience::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationTargetAudience::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
