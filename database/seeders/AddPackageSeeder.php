<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('packages')->count() > 0) {
            return;
        }
        $data = [
                [
                    'product_id' => 3,
                    'page_from' => 1,
                    'page_to' => 3,
                    'label' => '1-3 Pages',
                    'price' => 25
                ],
                [
                    'product_id' => 3,
                    'page_from' => 4,
                    'page_to' => 6,
                    'label' => '4-6 Pages',
                    'price' => 100
                ],
                [
                    'product_id' => 3,
                    'page_from' => 7,
                    'page_to' => 10,
                    'label' => '7-10 Pages',
                    'price' => 150
                ],
                [
                    'product_id' => 3,
                    'page_from' => 11,
                    'page_to' => 13,
                    'label' => '11-13 Pages',
                    'price' => 200
                ],
                [
                    'product_id' => 3,
                    'page_from' => 14,
                    'page_to' => 50000,
                    'label' => '14+ Pages',
                    'price' => 250
                ],

                [
                    'product_id' => 4,
                    'page_from' => 1,
                    'page_to' => 3,
                    'label' => '1-3 Pages',
                    'price' => 25
                ],
                [
                    'product_id' => 4,
                    'page_from' => 4,
                    'page_to' => 6,
                    'label' => '4-6 Pages',
                    'price' => 100
                ],
                [
                    'product_id' => 4,
                    'page_from' => 7,
                    'page_to' => 10,
                    'label' => '7-10 Pages',
                    'price' => 150
                ],
                [
                    'product_id' => 4,
                    'page_from' => 11,
                    'page_to' => 13,
                    'label' => '11-13 Pages',
                    'price' => 200
                ],
                [
                    'product_id' => 4,
                    'page_from' => 14,
                    'page_to' => 50000,
                    'label' => '14+ Pages',
                    'price' => 250
                ]

            ];
            for ($i = 0; $i < count($data); $i++) {
                
                Package::create([
                    'product_id' => $data[$i]['product_id'],
                    'page_from' => $data[$i]['page_from'],
                    'page_to' => $data[$i]['page_to'],
                    'label' => $data[$i]['label'],
                    'price' => $data[$i]['price']
                ]);
            }
        
    }
}
