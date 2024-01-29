<?php

namespace App\classes;

use App\Models\Invoice;
use App\Models\Receipt;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class generateReceipt{
    
    public function generateReceipt($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $pdfLinkReceipt = 'receipts/' . time() . '.pdf';   
        $json = json_decode($invoice->data,true);
       
        $vat_amount =  $invoice->total_amount - $invoice->net_amount;

        $invoiceData = [
            'product_name' => $json['product_name'],
            'total_amount' => $invoice->total_amount,
            'net_amount' => $invoice->net_amount,
            'vat_rate' =>  $invoice->vat,
            'vat_amount' => $vat_amount 
        ]; 
        
        $pdf = PDF::loadView('frontend.receipts.receipt_pdf', ['receipt' => $invoiceData])->setPaper('a4', 'portrait')->setWarnings(false);
        Storage::put($pdfLinkReceipt, $pdf->output());
        
        $receipt = Receipt::create([
            'user_id' => $invoice->user_id,
            'model_type' => $invoice->model_type,
            'model_id' => $invoice->model_id,
            'status' => $invoice->status,
            'total_amount' => $invoice->total_amount,
            'data' =>$invoice->data,
            'invoice_id' => $invoice->id,
            'net_amount' => $invoice->net_amount,
            'currency' => $invoice->currency,
            'link' => $pdfLinkReceipt,
            'discount'=>$invoice->discount,
            'promo_code_id'=>$invoice->promo_code_id,
            'gross'=>$invoice->gross,
            'currency_rate'=>$invoice->currency_rate,
        ]);

         return $receipt;
    }
}
