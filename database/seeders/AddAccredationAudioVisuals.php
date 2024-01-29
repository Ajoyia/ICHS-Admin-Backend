<?php

namespace Database\Seeders;

use App\Models\AccredationLectureAudioVisual;
use Illuminate\Database\Seeder;

class AddAccredationAudioVisuals extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names =["Hand-held Microphone", "Lavalier Microphone", "Additional Microphones","Speakers to play sound","TV/Projector Screens","Laptops/Computers","Lighting","Other"];
        for($i = 0;$i<count($names);$i++)
        {
            $is_exist = AccredationLectureAudioVisual::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                AccredationLectureAudioVisual::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
