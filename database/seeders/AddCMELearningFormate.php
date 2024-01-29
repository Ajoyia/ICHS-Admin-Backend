<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CMELearningFormate;

class AddCMELearningFormate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Lecture", "Interactive", "Case Discussion","Group Collaboration","Workshop","Simulation Skill Based","Hands On Training","On Demand CME/CPD Activity","Others, describe"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CMELearningFormate::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMELearningFormate::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
