<?php

namespace Database\Seeders;

use App\Models\ProductCountryTypeListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddProductCountryTypeListings extends Seeder
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
                    'country_type_id' => 1,
                    'cme_product_id' => 1
                ],
                [
                    'id'=>2,
                    'country_type_id' => 1,
                    'cme_product_id' => 2
                ],
                [
                    'id'=>3,
                    'country_type_id' => 1,
                    'cme_product_id' => 3
                ],
                [
                    'id'=>4,
                    'country_type_id' => 1,
                    'cme_product_id' => 4
                ],
                [
                    'id'=>5,
                    'country_type_id' => 2,
                    'cme_product_id' => 1
                ],
                [
                    'id'=>6,
                    'country_type_id' => 2,
                    'cme_product_id' => 2
                ],
                [
                    'id'=>7,
                    'country_type_id' => 2,
                    'cme_product_id' => 3
                ],
                [
                    'id'=>8,
                    'country_type_id' => 2,
                    'cme_product_id' => 4
                ],
                [
                    'id'=>9,
                    'country_type_id' => 3,
                    'cme_product_id' => 5
                ],
                [
                    'id'=>10,
                    'country_type_id' => 3,
                    'cme_product_id' => 6
                ],
                [
                    'id'=>11,
                    'country_type_id' => 3,
                    'cme_product_id' => 7
                ],
                [
                    'id'=>12,
                    'country_type_id' => 3,
                    'cme_product_id' => 8
                ],
                [
                    'id'=>13,
                    'country_type_id' => 4,
                    'cme_product_id' => 5
                ],
                [
                    'id'=>14,
                    'country_type_id' => 4,
                    'cme_product_id' => 6
                ],
                [
                    'id'=>15,
                    'country_type_id' => 4,
                    'cme_product_id' => 7
                ],
                [
                    'id'=>16,
                    'country_type_id' => 4,
                    'cme_product_id' => 8
                ],
               
            ]; 
            
            ProductCountryTypeListing::upsert($data, 'country_type_id');
        


    }
}
