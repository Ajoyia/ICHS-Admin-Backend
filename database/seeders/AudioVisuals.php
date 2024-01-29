<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CMELectureAudioVisual;

class AudioVisuals extends Seeder
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
            $is_exist = CMELectureAudioVisual::where('name', '=', $names[$i])->first();
            if ($is_exist === null) {
                CMELectureAudioVisual::create([
                    'name' => $names[$i]
                ]);
             }
        }
    }
}
