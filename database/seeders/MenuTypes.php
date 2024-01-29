<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuType;

class MenuTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'=>1,
                'name' => "Header Menu",
                'status' => 1,
                "deleted_at"=> null
            ],
            [
                'id'=>2,
                'name' => "Footer Menu",
                'status' => 1,
                "deleted_at"=> null
            ],
            [
                'id'=>3,
                'name' => "Header Social Links",
                'status' => 1,
                "deleted_at"=> null
            ],
            [
                'id'=>4,
                'name' => "Footer Socail Links",
                'status' => 1,
                "deleted_at"=> null
            ],
            [
                'id'=>5,
                'name' => "Copy Right Links",
                'status' => 1,
                "deleted_at"=> null
            ],
        ];
        MenuType::upsert($data, ['id'], ['name', 'deleted_at']);
    }
}
