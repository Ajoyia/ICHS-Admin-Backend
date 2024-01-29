<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CMELectureInteractiveTechnology;

class InteractiveTechnologies extends Seeder
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
            $is_exist = CMELectureInteractiveTechnology::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMELectureInteractiveTechnology::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
