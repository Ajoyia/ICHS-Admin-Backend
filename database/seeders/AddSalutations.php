<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salutation;

class AddSalutations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["Mr.", "Ms.","Mrs.", "Prof.", "Dr.", "HE", "HH.", "HRH", "Unknown"];
        
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = Salutation::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                Salutation::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
