<?php

namespace App\classes;

use App\Models\Invoice;
use App\Models\Membership;
use Illuminate\Support\Facades\Log;

class calculateTax{

    public function calculateTaxAmount($taxes,$gross,$product_name,$discount)
    {
        $sum_of_taxes = 0;
        $percentage_amount = 0;
        $json_array = array();
        $j = array();
        $net_amount = $gross - $discount;
        if(!empty($taxes)){

            foreach($taxes as $tax)
            {
                array_push($j, [
                    'tax_name' => $tax->name,
                    'tax_rate' => $tax->rate,
                ]);
                $sum_of_taxes += $tax->rate;
            }
            $json_array['taxes'] = $j;
            if($sum_of_taxes != 0)
            {
                $percentage_amount = $net_amount * ($sum_of_taxes/100);
            }
        }
        $json_array['product_name'] = $product_name;
        
        $total_amount = $percentage_amount + $net_amount;
        $payload = [
            'total_amount' => $total_amount,
            'data' => json_encode($json_array),
            'net_amount' => $net_amount,
            'product_name' => $product_name,
            'sum_of_taxes' => $sum_of_taxes,
            'percentage_amount' => $percentage_amount,
            'discount' => $discount,
            'gross' => $gross, 
        ];
        return $payload;
    }
}
