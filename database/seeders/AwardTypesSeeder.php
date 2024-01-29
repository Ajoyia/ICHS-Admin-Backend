<?php

namespace Database\Seeders;

use App\Models\AwardType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AwardTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $titles = [
                    "ICHS Honorary Founders Award", 
                    "ICHS Medical Professional Star Award", 
                    "ICHS Health Professional Star Award", 
                    "ICHS Medical and Health Young Professionals Award"
                ];

        for ($i = 0; $i < count($titles); $i++) {
            $is_exist = AwardType::where('title', '=', $titles[$i])->first();
            if ($is_exist === null) {
                AwardType::create([
                    'title' => $titles[$i]
                ]);
            }
        }
    }
}
