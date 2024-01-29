<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('journal_form_types')->upsert([
            ['id' =>'1' , 'name' => 'Review', 'status' => '1' ],
            ['id' =>'2' , 'name' => 'Case Report', 'status' => '1' ],
            ['id' =>'3' , 'name' => 'Original Article/Research', 'status' => '1' ],
            ['id' =>'4' , 'name' => 'Technical Note', 'status' => '1' ],
            ['id' =>'5' , 'name' => 'Commentary', 'status' => '1' ],
            ['id' =>'6' , 'name' => 'Pictorial Essay', 'status' => '1' ],
            ['id' =>'7' , 'name' => 'Editorial', 'status' => '1' ],
            ['id' =>'8' , 'name' => 'Interview', 'status' => '1' ],
            ['id' =>'9' , 'name' => 'Other, specify', 'status' => '1' ],
        ], ['id'], ['name', 'status']);
    }
}
