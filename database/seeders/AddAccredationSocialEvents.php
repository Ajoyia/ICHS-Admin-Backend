<?php

namespace Database\Seeders;

use App\Models\AccredationSocialEvent;
use Illuminate\Database\Seeder;

class AddAccredationSocialEvents extends Seeder
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
            $is_exist = AccredationSocialEvent::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationSocialEvent::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
