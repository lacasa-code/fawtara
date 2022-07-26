@extends('layouts.app')
@section('content')

        <div class="right_col" role="main">
            <div class="">  
                  <div class="row" >
                              <div class="col-md-12 col-sm-12 col-xs-12" >
                              
                              <div class="x_panel setMarginForXpanelDivOnSmallDevice" style="margin-top: 1px;">

<div id="printMe">

      <style>
.table>thead>tr>th {
    padding: 12px 5px 12px 5px;
}

.table>tbody>tr>td {
    padding: 8px 4px 8px 4px;
}

#shoInvoice>tbody>.bayan>td {
    padding: 5px 2px 5px 2px;
}


#shoInvoice2>tbody>.sep>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice2 {
    padding-bottom: : -50px;
}

<?php // style here ?>

</style>
                  
      <table id="shoInvoice" class="table" style="border: none;">
                                    <thead>
                                    </thead>
                                    <tbody>
                                          <tr>
                              <td style="text-align: right;">  
                                                      <img style="height: 70px; width: 200px;" src="{{ URL::asset('public/img/branch/'.$branch->branch_image) }}" class="cimg"> &nbsp; &nbsp; &nbsp; 
                              </td>
                              <td style="text-align: right;">  
                                                      <img style="height: 70px; width: 200px;" src="{{ URL::asset('public/img/branch/marcedess-logo.svg') }}" class="cimg"> &nbsp; &nbsp; &nbsp; 
                              </td>
                                          </tr>    
                                    </tbody>
</table>

      <table id="shoInvoice" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
                                    <thead>
                                    </thead>
                                          <tbody>

                                          <tr>
                                                <td style="text-align: center;"> {{ 'Branch Name' }}  </td>
                                                <td colspan="8" style="text-align: center;"> 
                                                      {{ $branch->name_en }}  &nbsp; {{ $branch->branch_name }}  
                                                </td>
                                                <td style="text-align: center;"> {{ 'إسم الفرع ' }} </td>
                                          </tr>

                                          <tr>
                                            <td style="text-align: center;"> {{ 'Branch Address' }}  </td>
                                                <td colspan="8" style="text-align: center;"> 
                                                      ( {{ $branch->branch_address }} )
                                                </td>
                                                <td style="text-align: center;"> {{ 'عنوان الفرع ' }}  </td>
                                          </tr> 

                                          <tr> 
                                          <td style="text-align: center;"> {{ 'Branch Contact' }}  </td>
                                          <td colspan="8" style="text-align: center;"> {{ $branch->contact_number }} </td>
                                          <td style="text-align: center;"> {{ 'رقم التواصل ' }}  </td>
                                    </tr> 

                                    </tbody>
</table>

<table id="shoInvoiceno2" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
                                    <thead>
                                    </thead>
                                          <tbody>

                                          <tr>
                                                <td style="text-align: center;"> VAT NO.: </td>
                                                <td style="text-align: center;"> {{ $invoice->branch->vat_number }}  </td>
                                                <td style="text-align: center;"> الرقم الضريبى: </td>
                                          </tr>  

                                          <tr>
                                                <td style="text-align: center;">INVOICE NO: </td> 
                                                <td style="text-align: center;">{{'#'.Auth::user()->branch_id.'-'.$invoice->Invoice_Number}}</td> 
                                                <td style="text-align: center;">رقم الفاتوره  </td>
                                          </tr>

                                          <tr>
                                                <td style="text-align: center; border-right: none;">Date  </td>
                                                <td style="text-align: center;">{{ $invoice->Date}} {{ $invoice->created_at->format('H:i:s A') }} </td>
                                                <td style="text-align: center;">التاريخ   </td>
                                          </tr>

                                    </tbody> 
                              </table>

<table id="shoInvoiceno2" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
      <thead></thead>
      <tbody>
                  <tr>
                      <td style="text-align: center;"> Total <br>  المجموع  </td>  
                      <td style="text-align: center;"> Qty <br> الكمية </td> 
                      <td style="text-align: center;"> Unit Price <br> سعر الوحدة  </td>
                      <td style="text-align: center;"> Item Description <br>  وصف الصنف </td> 
                  </tr>

                  @foreach($services as $service) 
                  <tr> <!-- #9 -->
                        <td style="text-align: center;"> 
                              {{ $service->sub_total == null ? $service->service_value : $service->sub_total }}   ريال</td>
                        <td style="text-align: center;"> 
                              {{ $service->qty == null ? 1 : $service->qty }}  </td>
                        <td style="text-align: center;"> 
                              {{ $service->service_value }}    ريال </td>
                        <td style="text-align: center;"> 
                              {{ $service->service_name }}     </td>
                  </tr>  
                  @endforeach

      </tbody>
</table>


<table id="shoInvoiceno2" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
      <thead></thead>
      <tbody>
                  <tr>
                      <td style="text-align: center;"> Sub Total </td> 
                      <td style="text-align: center;"> مجموع  تكلفة الخدمات  </td> 
                      <td style="text-align: center;">  
                      
                        <?php $summation = 0; ?>
                        @foreach($services as $invoice_service)
                        @if($invoice_service->sub_total == null)
                        <?php $summation += $invoice_service->service_value; ?>
                        @else
                        <?php $summation += $invoice_service->sub_total; ?>
                        @endif
                        @endforeach
                        <!-- {{ $invoice->services->sum('sub_total') }} --> 

                        {{ $summation }}  ريال   
                  </td> 
                  </tr>

                  <tr>
                      <td style="text-align: center;"> Discount </td> 
                      <td style="text-align: center;">  نسبة الخصم   </td> 
                      <td style="text-align: center;">
                       @if($invoice->Discount > 0)
                       {{ $invoice->Discount }}  % 
                       @else
                       {{ '_______' }}
                       @endif
                        </td> 
                  </tr>

                  <tr>
                      <td style="text-align: center;"> Total Taxable Amount </td> 
                      <td style="text-align: center;">  الإجمالي الخاضع للضريبة </td> 
                      <td style="text-align: center;"> {{ $invoice->total_amount }}  ريال </td> 
                  </tr>

                  <tr>
                      <td style="text-align: center;"> Total Vat </td> 
                      <td style="text-align: center;">  مجموع القيمة المضافة   </td> 
                      <td style="text-align: center;"> {{ $tax_percent = ($invoice->total_amount * 15) / 100 }}  ريال  </td> 
                  </tr>

                  <tr>
                      <td style="text-align: center;"> Total Amount Due </td> 
                      <td style="text-align: center;"> إجمالي المبلغ المستحق   </td> 
                      <td style="text-align: center;"> ريال   {{ $invoice->paid_amount }}   </td> 
                  </tr>

      </tbody>
</table>

<div style="text-align: center;">
                  <span style="text-align: center;"> السعريشمل 15 %  ضريبة القيمة المضافة   </span> <br>
<?php 
                                    $path_one = strstr(URL::current(), 'invoice',true); 
                                    $path_two = $path_one.'invoice/scan/'; 
                                    $path_three = $path_one.'invoice/scan/'.$invoice->id; 
                                    $path_four = $path_one.'invoice/scan/pdf/'.$invoice->id;  
?> 

<?php 
              $inv_number   = $invoice->Invoice_Number;
              $invoice_datetimez     = $invoice->Date .' '.$invoice->created_at->format('H:i:s');
              $seller_name   = $invoice->branch_name;
              $vat_registration_number    = $invoice->branch->vat_number;
              $invoice_amount    = $invoice->paid_amount;
              $invoice_tax_amount = ( $invoice->total_amount * 15 ) / 100;

              $result = chr(1) . chr( strlen($seller_name) ) . $seller_name;
              $result.= chr(2) . chr( strlen($vat_registration_number) ) . $vat_registration_number;
              $result.= chr(3) . chr( strlen($invoice_datetimez) ) . $invoice_datetimez;
              $result.= chr(4) . chr( strlen($invoice_amount) ) . $invoice_amount;
              $result.= chr(5) . chr( strlen($invoice_tax_amount) ) . $invoice_tax_amount;
              $ahmed = base64_encode($result); 

?>

                {!! QrCode::size(200)->generate($ahmed); !!} 
               
</div>

       </div>
                  </div>
                  </div>
                  </div>
            </div>
             <button  class="btn bt-secondary button1" onclick="printDiv('printMe')">Print Now</button>
        </div>



<!-- /page content -->

<script>
            function printDiv(divName){
                  var printContents = document.getElementById(divName).innerHTML;
                  var originalContents = document.body.innerHTML;

                  document.body.innerHTML = printContents;

                  window.print();

                  document.body.innerHTML = originalContents;

            }
      </script>

@endsection