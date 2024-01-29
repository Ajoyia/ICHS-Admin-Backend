<?php

namespace Database\Seeders;

use App\Models\AccredationProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AddAccredationProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $CMEProduct = Product::where('link_product',5)->first();
        if($CMEProduct != null){
            $data = [
                [
                    'product_id' => $CMEProduct->id,
                    'country_type_id' => 1,
                    'price' => 5500,
                    'per_certificate_price' => 20,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'product_id' => $CMEProduct->id,
                    'country_type_id' => 2,
                    'price' => 5500,
                    'per_certificate_price' => 20,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'product_id' => $CMEProduct->id,
                    'country_type_id' => 3,
                    'price' => 2200,
                    'per_certificate_price' => 10,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'product_id' => $CMEProduct->id,
                    'country_type_id' => 4,
                    'price' => 2200,
                    'per_certificate_price' => 10,
                    'is_published' => 1,
                    'status' => 1
                ]
               
            ]; 
            
            AccredationProduct::upsert($data, 'price');
        }


        

    }
}
