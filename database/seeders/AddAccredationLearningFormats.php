<?php

namespace Database\Seeders;

use App\Models\AccredationLearningFormat;
use Illuminate\Database\Seeder;

class AddAccredationLearningFormats extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Lectures", "Interactive Sessions", "Case Discussions","Group Collaboration","Workshops","Simulation Skill Based","Hands On Training","Others, describe"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationLearningFormat::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationLearningFormat::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
