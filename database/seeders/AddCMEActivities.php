<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CMEActivity;

class AddCMEActivities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names =["Live Lecture", "Live Conference", "Live Seminar","Live Workshop","Live Course","Live Series","Others, Describe","In-Person","Virtual","On-Demand"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CMEActivity::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMEActivity::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
