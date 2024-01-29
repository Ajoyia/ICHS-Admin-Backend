<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CMESocialEvent;

class AddCMESocialEvents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Breakfast", "Lunch", "Dinner","Exhibition Hall","Reception","Entertainment","Charity","Fund Raising","Other","None"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = CMESocialEvent::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMESocialEvent::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
