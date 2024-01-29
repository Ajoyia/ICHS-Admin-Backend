<?php

namespace App\GraphQL\Mutations\AccredationCompletionForm;

use App\Models\CMECompletionForm;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\classes\generateInvoice;
use App\classes\calculateTax;
use App\Models\AccredationProduct;
use App\Imports\AccredationLearnerImport;
use App\Models\AccredationApplication;
use App\Models\AccredationCompletionForm;
use App\Models\AccredationLearner;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;

final class createAccredationCompletionForm
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function __invoke($_, array $args)
    {
            $cmeALF=new AccredationCompletionForm();
            $cmeALF->acc_id=$args['acc_id'];
            $cmeALF->credit_hour=$args['credit_hour'];
            $cmeALF->cme_validation=$args['cme_validation'];
            $cmeALF->commercial_independence=$args['commercial_independence'];
            $cmeALF->evaluation_summary=$args['evaluation_summary'];
            $cmeALF->commercial_support=$args['commercial_support'];
            $cmeALF->created_by=Auth::user()->id;
            $cmeALF->updated_by=Auth::user()->id;
            $cmeALF->save();
            $file_path = Storage::put('/xlsx_files',$args['xls_file']);
            $completion_form_id = $cmeALF->id;
            Excel::import(new AccredationLearnerImport($completion_form_id), $file_path);
            $put_file = AccredationCompletionForm::find($cmeALF->id);
            $put_file->pdf_path = $file_path;
            $put_file->save();
            $model_type = 'App\Models\AccredationCompletionForm';
            $product = Product::where('link_product', 5)->first();

            $cme_application = AccredationApplication::where('id',$args['acc_id'])->first();
            $cme_product = AccredationProduct::where('id',$cme_application->accredation_product_id)->first();


            if($cme_product->per_certificate_price!=0){
                $per_cerfiticate_price = $cme_product->per_certificate_price;
                $cme_learners_count = AccredationLearner::where('completion_form_id',$cmeALF->id)->count();
                
                if($cme_learners_count > 0) {
                    $product_name =  $cme_product->product->name;
                    $net_amount = $per_cerfiticate_price * $cme_learners_count;
                    $tg=$cme_product->tax_group;
                    if($tg!=null){
                        $taxes = $tg->Taxes;
                    }
                    else {
                        $taxes = null;
                    }
                    $tax = new calculateTax();
                    $payload = $tax->calculateTaxAmount($taxes,$net_amount,$product_name,0);
                    $invoice = new generateInvoice();
                    $invoiceGenerated = $invoice->generateInvoice(Auth::user()->id,$model_type,$cmeALF->id,$cme_application->status,$payload);
                    Log::info($invoiceGenerated);
                    $payment = $this->paymentService->getAccessToken(Auth::user()->id,$net_amount, $product->id, $invoiceGenerated->id);
                    $cmeALF->link_to_pay=$payment->_links->payment->href;
                    return $cmeALF;

                }       
            }
            else{

            $completion_form = AccredationCompletionForm::find($completion_form_id);
            $completion_form->is_completed = 1;
            $completion_form->save();

            $cme_application = AccredationApplication::find($completion_form_id);
            $cme_application->status_id = 5;
            $cme_application->save();
                return 'done';
            }
          
        }

}
