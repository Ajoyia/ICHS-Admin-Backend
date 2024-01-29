<?php

namespace Database\Seeders;

use App\Models\CMEProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AddCMEProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $CMEProduct = Product::where('link_product',2)->first();
        if($CMEProduct != null){
            $data = [
                [
                    'id'=>1,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 1,
                    'hour_to' => 2,
                    'price' => 0,
                    'per_certificate_price' => 0,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>2,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 3,
                    'hour_to' => 8,
                    'price' => 25,
                    'per_certificate_price' => 1,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>3,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 9,
                    'hour_to' => 12,
                    'price' => 50,
                    'per_certificate_price' => 2,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>4,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 13,
                    'hour_to' => 24,
                    'price' => 100,
                    'per_certificate_price' => 5,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>5,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 1,
                    'hour_to' => 2,
                    'price' => 50,
                    'per_certificate_price' => 5,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>6,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 3,
                    'hour_to' => 8,
                    'price' => 100,
                    'per_certificate_price' => 10,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>7,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 9,
                    'hour_to' => 12,
                    'price' => 200,
                    'per_certificate_price' => 15,
                    'is_published' => 1,
                    'status' => 1
                ],
                [
                    'id'=>8,
                    'product_id' => $CMEProduct->id,
                    'hour_from' => 13,
                    'hour_to' => 24,
                    'price' => 400,
                    'per_certificate_price' => 20,
                    'is_published' => 1,
                    'status' => 1
                ]
               
            ]; 
            
            CMEProduct::upsert($data, 'price');
        }


        

    }
}
