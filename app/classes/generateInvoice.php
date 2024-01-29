<?php

namespace App\classes;

use App\Models\Invoice;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class generateInvoice{

    public function generateInvoice($user_id,$model_type,$model_id,$status,$payload)
    {
        $getConfig =  config('link_products');
        $pdfLink = 'invoices/' . time() . '.pdf';

        $invoiceData = [
            'product_name' => $payload['product_name'],
            'total_amount' => $payload['total_amount'],
            'net_amount' => $payload['net_amount'],
            'vat_rate' =>  $payload['sum_of_taxes'],
            'vat_amount' => $payload['percentage_amount']
        ];

        $pdf = PDF::loadView('frontend.invoices.invoice_pdf', ['invoice' => $invoiceData])->setPaper('a4', 'portrait')->setWarnings(false);
        Storage::put($pdfLink, $pdf->output());
        
        $invoice = Invoice::create([
            'user_id' => $user_id,
            'model_type' => $model_type,
            'model_id' => $model_id,
            'status' => $status,
            'data' => $payload['data'],
            'promo_code_id'=>(isset($payload['promo_code_id']) ? $payload['promo_code_id']:null),
            'link' => $pdfLink,
            'discount'=>(isset($payload['discount']) ? $payload['discount']:0),
            'total_amount' => $payload['total_amount'],
            'net_amount' => $payload['net_amount'],
            'vat' => $payload['sum_of_taxes'],
            'currency' => $getConfig['default_currency'],
            'currency_rate'=> config('variables.currency_rate'),
            'gross' => $payload['gross'],

        ]);

         return $invoice;
    }
}
