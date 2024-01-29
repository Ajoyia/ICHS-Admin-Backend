<?php

namespace Database\Seeders;

use App\Models\AccredationInteractiveTechnology;
use Illuminate\Database\Seeder;

class AddAccredationInteractiveTechnologies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names =["Hand-held “Clicker” with Laser-Pointer ", "Internet Access", "Audience Response System","Other"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationInteractiveTechnology::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationInteractiveTechnology::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
