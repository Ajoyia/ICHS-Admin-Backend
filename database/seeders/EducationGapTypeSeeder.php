<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationGapTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('education_gap_types')->count() > 0) {
            return;
        }
           
        \DB::table('education_gap_types')->insert([
            ['name' =>'Knowledge' , 'status' => 1 ],
            ['name' =>'Competencies ' , 'status' => 1 ],
            ['name' =>'Performance' , 'status' => 1 ],
            ['name' =>'Patient Outcomes' , 'status' => 1 ],
        ]);
    }
}
