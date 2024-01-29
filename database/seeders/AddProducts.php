<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddProducts extends Seeder
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
                'link_product' => 1,
                'name' => 'Membership',
                'is_published' => 1,
                'status' => 1
            ],
            [
                'id'=>2,
                'link_product' => 2,
                'name' => 'CME/CPD',
                'is_published' => 1,
                'status' => 1
            ],
        ];
        
        Product::upsert($data, 'name');

    }
}
