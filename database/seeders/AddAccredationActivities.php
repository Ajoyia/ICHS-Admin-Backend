<?php

namespace Database\Seeders;

use App\Models\AccredationActivity;
use Illuminate\Database\Seeder;

class AddAccredationActivities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names =["Live Lectures", "Live Seminars","Live Workshops","Live Courses", "Hands on Training","Others, Describe","In-Person","Virtual"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationActivity::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationActivity::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
