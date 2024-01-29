<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Invoice</title>
      <meta name="author" content="harnishdesign.net">
      <!-- Web Fonts
         ======================= -->
      <style type="text/css">
         table {
         border-collapse: collapse;
         }
         .table th, .table td {
         border: 1px solid black;
         text-align: center;
         }
      </style>
   </head>
   <body>
      <!-- Container -->
      <div class="container-fluid invoice-container" style="max-width: none !important;">
         <!-- Header -->
         <header>
            <div class="row align-items-center">
               <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">

               </div>
               <div class="col-sm-5 text-center text-sm-right">
                  <h4 class="text-7 mb-0"></h4>
               </div>
            </div>
            <hr>
         </header>
         <!-- Main Content -->
         <main>
            <div class="row">
               <div class="col-sm-12">
                  <h4>INDEX CONFERENCES & EXHIBITIONS ORGANIZATION EST</h4>
                  <p>Address :INDEX Holding Headquarters, Opposite Nad Al Hamar, Road # D-62, 13636, Dubai, United Arab Emirates</p>
                  <p>Tel.:- <b>97145208888</b> Fax.:- <b>97143384193</b></p>
               </div>
            </div>
            <hr>
            <h3 style="text-align:center">TAX INVOICE</h3>

            <table cellspacing="1" class="table" style="width: 100%;">
               <thead>
                  <tr>
                     <td><strong>#</strong></td>
                     <td><strong>Product</strong></td>
                     <td><strong>Net Amount</strong></td>
                     <td><strong>Vat Rate</strong></td>
                     <td><strong>Vat Amount</strong></td>
                     <td><strong>Total Amount(Inclusive of Vat) USD</strong></td>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>{{($invoice['product_name'] ? $invoice['product_name'] : 'N/A')}}</td>
                     <td>{{($invoice['net_amount'] ? $invoice['net_amount'] : 'N/A')}}</td>
                     <td>{{($invoice['vat_rate'] ? $invoice['vat_rate'] : 'N/A')}}</td>
                     <td>{{($invoice['vat_amount']? $invoice['vat_amount'] : 'N/A')}}</td>
                     <td>{{($invoice['total_amount'] ? $invoice['total_amount'] : 'N/A')}}</td>
                  </tr>

               </tbody>
            </table>


            <table class="bordered" style="width: 100%;">
               <tbody>
                  <tr>
                     <td  width="40%">
                        <p>Kindly to be settled</p>
                     </td>
                     <td  width="20%">100 % Payable Upon Application</td>
                     <td  width="20%">USD</td>
                     <td  width="20%">{{number_format($invoice['net_amount'])}}</td>
                  </tr>
                  <tr>
                     <td  width="40%">
                        <p><strong>TOTAL Amount in USD</strong></p>
                     </td>
                     <td  width="20%">{{number_format($invoice['net_amount'])}}</td>
                     <td  width="20%">0.00</td>
                     <td  width="20%"><strong>{{number_format($invoice['total_amount'])}}</strong></td>
                  </tr>
               </tbody>
            </table>
         </main>
         <!-- Footer -->
         <footer class="text-center mt-4">

            <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
         </footer>
      </div>
   </body>
</html>
