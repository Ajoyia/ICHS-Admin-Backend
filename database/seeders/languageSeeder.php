<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class languageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('languages')->count() > 0) {
            return;
        }

        \DB::table('languages')->insert([
            ['name' =>'English' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Mandarin Chinese' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Hindi' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Spanish' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'French' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Arabic' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Bengali' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Russian' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Portuguese' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Indonesian' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Urdu' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Japanese' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'German' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Punjabi' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Javanese' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Wu Chinese' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Telugu' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Turkish' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Korean' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' =>'Marathi' , 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
        ]);
    }
}
