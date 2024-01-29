<?php

namespace Database\Seeders;

use App\Models\AccredationPresentationFormat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CMELecturePresentationFormat;

class AddAccredationPresentationFormats extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names =["Lecture/Didactic", "Case Study/Discussions", "Hands-on Workshop","Panel/Q&A Discussion","Presentation Other"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationPresentationFormat::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationPresentationFormat::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
