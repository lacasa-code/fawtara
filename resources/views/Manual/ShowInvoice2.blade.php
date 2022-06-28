@extends('layouts.app')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
                  <!--invoice modal-->
                  <div id="myModal-job" class="modal fade setTableSizeForSmallDevices" role="dialog">
                        <div class="modal-dialog modal-lg">
                              <!-- Modal content-->
                              <div class="modal-content">
                                    <div class="modal-header"> 
                                          <a href=""><button type="button" data-dismiss="modal" class="close">&times;</button></a>
                                          <h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Invoice')}}</h4>
                                    </div>
                                    <div class="modal-body">
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!--Payment modal-->
                  <div id="myModal-payment" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                              <!-- Modal content-->
                              <div class="modal-content modal-data">
                                    
                              </div>
                        </div>
                  </div>
            <div class="">
                  <div class="page-title">
                        <div class="nav_menu">
                              <nav>
                                    <div class="nav toggle">
                                    <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; {{ trans('app.Invoice')}}</span></a>
                                    </div>
                                    @include('dashboard.profile')
                              </nav>
                        </div>
                  </div>
                        @if(session('message'))
                        <div class="row massage">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="checkbox checkbox-success checkbox-circle">
                                          @if(session('message') == 'Successfully Submitted')
                                                <label for="checkbox-10 colo_success"> 
                                                      {{trans('app.Successfully Submitted')}}  
                                                </label>
                                          @elseif(session('message')=='Successfully Updated')
                                                <label for="checkbox-10 colo_success"> 
                                                      {{ trans('app.Successfully Updated')}}  
                                                </label>
                                          @elseif(session('message')=='Successfully Deleted')
                                                <label for="checkbox-10 colo_success"> 
                                                      {{ trans('app.Successfully Deleted')}}  
                                                </label>
                                          @elseif(session('message')=='Successfully Sent')
                                          <label for="checkbox-10 colo_success"> 
                                                {{ trans('app.Successfully Sent')}}  
                                          </label>
                                          @elseif(session('message')=='Error! Something went wrong.')
                                                <label for="checkbox-10 colo_success"> 
                                                      {{ trans('app.Error! Something went wrong.')}}  
                                                </label>
                                          @endif
                        </div>
                              </div>
                        </div>
                        @endif
                  <div class="row" >
                              <div class="col-md-12 col-sm-12 col-xs-12" >
                              <div class="x_content">
                                          <ul class="nav nav-tabs bar_tabs" role="tablist">
                                               
                                    </div>
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

</style>
                  
      <table id="shoInvoice" class="table" style="border: none;">
                                    <thead>
                                    </thead>
                                    <tbody>
                                          <tr>
                                                <td style="text-align: left;" width="30%">  
                                                      <img style="height: 70px;" src="{{ URL::asset('public/img/branch/'.$branch->branch_image) }}" class="cimg"> &nbsp; &nbsp; &nbsp; </td>
                                                <td style="text-align: center;" width="50%"> <span class="text-lead"> <u>  <br>
                                                             
                                                         {{ $branch->name_en }}&nbsp; &nbsp; {{ $branch->branch_name }}
                                                          <br>
                                                         {{ $branch->division_en }} &nbsp; &nbsp; {{ $branch->division }}
                                                      </u>
                                                   </span> </td>
                                                <td style="text-align: center;" width="20%"> 
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
             <!--   {!! QrCode::size(200)->generate($ahmed); !!} -->

       </td>
                                          </tr>    
                                    </tbody>
</table>

      <table id="shoInvoice" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
                                    <thead>
                                    </thead>
                                          <tbody>
                                          <tr>
                                                <td style="text-align: left;">SERVICE/SALES </td>
                                                <td style="text-align: center;"> خدمات   </td>
                                                <td style="text-align: right;"> بيع  /خدمات</td>
                                                <td style="text-align: left;">Show price NO: </td> 
                                                <td colspan="2" style="text-align: center;"> {{ '#'.Auth::user()->branch_id.'-'.$invoice->Invoice_Number }}   </td> 
                                                <td style="text-align: right;">رقم عرض السعر  </td>
                                                <td style="text-align: left; border-right: none;">Date  </td>
                                                <td style="text-align: center;">{{ $invoice->Date}} 
                                                      {{ $invoice->created_at->format('H:i:s A') }}</td>
                                                <td style="text-align: right;">التاريخ   </td>
                                          </tr>

                                          <tr>
                                                <td style="text-align: left;">CUSTOMER NAME </td>
                                                <td colspan="8" style="text-align: center;"> 
                                                      {{ $invoice->Customer }}  
                                                </td>
                                                <td style="text-align: right;">  اسم العميل</td>  
                                          </tr>

                                          <tr>
                                                <td style="text-align: left;"> Address</td>
                                                <td colspan="8" style="text-align: center;"> 
                                                      ( {{ $invoice->customer_address }} )
                                                </td>
                                                <td style="text-align: right;">العنوان</td>
                                          </tr> 
                                    </tbody>
</table>

<table id="shoInvoiceno2" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
                                    <thead>
                                    </thead>
                                          <tbody>
                                          <tr>
                                                <td colspan="2" style="text-align: left;"> CUSTOMER VAT NO:</td>
                                                <td style="text-align: center;"> {{ $invoice->customer_vat }} </td>
                                                <td colspan="2" style="text-align: right;"> رقم العميل الضريبى </td>
                                                <td colspan="2" style="text-align: left;"> VAT NO.: </td>
                                                <td style="text-align: center;"> {{ $invoice->branch->vat_number }}  </td>
                                                <td colspan="2" style="text-align: right;"> الرقم الضريبى: </td>
                                          </tr>  

                                    <tr> <!-- #1 -->
                                          <td colspan="2" style="text-align: left;"> TELEPHONE ND: </td>
                                          <td style="text-align: center;"> {{ $invoice->phone_code }} {{ ' ' }}{{ $invoice->customer_phone }} </td>
                                          <td colspan="2" style="text-align: right;"> : رقم الهاتف </td>
                                          <td colspan="2" style="text-align: left;"> BRANCH NAME: </td>
                                          <td style="text-align: center;"> {{ $invoice->branch_name }}</td>
                                          <td colspan="2" style="text-align: right;">: اسم الفرع </td>
                                    </tr>  

                                          <tr> <!-- #2 -->
                                          <td colspan="2" style="text-align: left;"> CUSTOMER NO: </td>
                                          <td style="text-align: center;"> {{ $invoice->customer_number }}</td>
                                          <td colspan="2" style="text-align: right;">: رقم العميل </td>
                                          <td colspan="2" style="text-align: left;"> METERS READING (HAS/KM): </td>
                                          <td style="text-align: center;"> {{ $invoice->meters_reading }}  </td>
                                          <td colspan="2" style="text-align: right;">: قراءة العداد </td>
                                                
                                          </tr>  

                                          <tr> <!-- #3 -->
                                                <td colspan="2" style="text-align: left;"> MCO/JOB NO: </td>
                                                <td style="text-align: center;"> {{ $invoice->Job_card }} </td>
                                                <td colspan="2" style="text-align: right;">: رقم امر العمل </td>
                                                <td colspan="2" style="text-align: left;"> MANUFACTURER: </td>
                                          <td style="text-align: center;"> {{ $invoice->fleet_number }} </td>
                                          <td colspan="2" style="text-align: right;"> {{ trans('المصنع ')}} </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #4 -->
                                                <td colspan="2" style="text-align: left;"> QUOTATION NO: </td>
                                          <td style="text-align: center;"> {{ $invoice->quotation_number }} </td>
                                          <td colspan="2" style="text-align: right;">: رقم العرض  </td>
                                          <td colspan="2" style="text-align: left;"> REGISTRATION: </td>

                                          <?php $format = trim( chunk_split($invoice->reg_chars, 1, ' ') ); ?> 
                        
                                          <td style="text-align: center;">
                                                {{ $invoice->registeration }} {{ ucwords($format) }}  </td>
                                                <td colspan="2" style="text-align: right;">: رقم التسجيل </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #5 -->
                                          <td colspan="2" style="text-align: left;"> CUSTOMER P.O NO: </td>
                                          <td style="text-align: center;">{{ $invoice->customer_po_number }}</td>
                                          <td colspan="2" style="text-align: right;">: رقم امر الشراء </td>
                                          <td colspan="2" style="text-align: left;"> MANUFACTURING DATE: </td>
                                          <td style="text-align: center;">{{ $invoice->manufacturer }}</td>
                                          <td colspan="2" style="text-align: right;"> تاريخ التصنيع   </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #6 -->
                                                <td colspan="2" style="text-align: left;"> CREDIT / CASH: </td>
                                                <td  style="text-align: center;"> {{ $paymentMethod->payment }}  </td>
                                                <td colspan="2" style="text-align: right;">: نقدا/ على الحساب </td>
                                                <td colspan="2" style="text-align: left;"> CHASSIS NO: </td>
                                                <td  style="text-align: center;">  {{ $invoice->chassis_no }}  </td>
                                                <td colspan="2" style="text-align: right;"> رقم  الهيكل   </td>
                                          </tr>  

                                          <tr>  <!-- #7 --> 
                                                <td colspan="2" style="text-align: left;"> JOB OPEN DATE: </td>
                                                <td  style="text-align: center;">  {{ $invoice->job_open_date }}  </td>
                                                <td colspan="2" style="text-align: right;">: تاريخ بدء العمل </td>
                                                <td colspan="2" style="text-align: left;"> MODEL: </td>
                                                <td  style="text-align: center;"> {{ $invoice->model_name }}  </td>
                                                <td colspan="2" style="text-align: right;">: الطراز </td>
                                          </tr>  

                                          <tr> <!-- #8 -->
                                                <td colspan="2" style="text-align: left;"> DELIVERY DATE: </td>
                                                <td  style="text-align: center;"> {{ $invoice->delivery_date }}  </td>
                                                <td colspan="2" style="text-align: right;">: تاريخ التسليم </td>
                                                <td colspan="5" style="text-align: right;"> </td>
                                          </tr>   

                                           <!-- #9 -->
                                          <tr class="success">
                                                <td colspan="8" style="text-align: center;"> البيـــــــــــان   /  DESCRIPTION   </td>
                                                <td colspan="2" style="text-align: center;"> AMOUNT /  القيمة </td>  
                                          </tr>   

                                    @foreach($services as $service) 
                                          <tr> <!-- #9 -->
                                                <td style="text-align: center;" colspan="8"> 
                                                      {{ $service->service_name }}     </td>
                                                <td style="text-align: center;" colspan="2"> 
                                                      {{ $service->service_value }}     </td>
                                          </tr>  
                                    @endforeach

                                          <tr style="border-top: double;">
                                                <td colspan="4" style="text-align: center;"> VALUE OF SERVICE </td>
                                                <td colspan="4" style="text-align: center;"> قيمة الخدمة </td>
                                                <td colspan="2" style="text-align: center;">
                                                 
                                                      <?php $summation = 0; ?>
                        @foreach($services as $invoice_service)
                        @if($invoice_service->sub_total == null)
                        <?php $summation += $invoice_service->service_value; ?>
                        @else
                        <?php $summation += $invoice_service->sub_total; ?>
                        @endif
                        @endforeach
                        <!-- {{ $invoice->services->sum('sub_total') }} --> 

                        ريال  {{ $summation }}     

                                                   </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;"> DISCOUNT </td>
                                                <td colspan="4" style="text-align: center;"> الخصم </td>
                                                <td colspan="2" style="text-align: center;">  
                                                   @if($invoice->Discount > 0)
                       {{ $invoice->Discount }}  % 
                       @else
                       {{ '_______' }}
                       @endif
                    </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;">  TOTAL VALUE </td>
                                                <td colspan="4" style="text-align: center;"> المجموع الكلى  </td>
                                                <td colspan="2" style="text-align: center;">  
                              
                                          {{ $invoice->total_amount }} 
                                                </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;">  VAT 15% </td>
                                                <td colspan="4" style="text-align: center;">   15%ضريبة القيمة المضافة   </td>
                                                <td colspan="2" style="text-align: center;"> 
                             
                                          {{ $tax_percent = ($invoice->total_amount * 15) / 100 }}
                                                      
                                                </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;">  TOTAL WITH VAT </td>
                                                <td colspan="4" style="text-align: center;">  المجموع الكلى مع الضريبة </td>
                                                <td colspan="2" style="text-align: center;"> 
                                          <?php //$tax_percent = ($invoice->total_amount * 15) / 100;
                                                //$paid_amount = $invoice->total_amount + $tax_percent;
                                          ?>
                                          {{ $invoice->paid_amount }} </td>
                                          </tr>

                                          </tbody>
</table>

            <table id="shoInvoice2" class="table" style="margin-top: -3px; border: none; font-size: 12px;">
                                    <thead>
                                    </thead>
                                          <tbody>
                                          <tr> <!-- #9 -->
                                                <td colspan="2"> توقيع العميل / الختم      </td>
                                                <td colspan="2"> اسم ممثل العميل      </td>
                                                <td colspan="2">  مشرف حسابات الورش  </td>
                                                <td colspan="2"> مدير عمليات الصيانة       </td>
                                                <td colspan="2"> المدير المالى الاقليمى  </td>
                                          </tr>   

                                          <tr> <!-- #10 -->
                                                <td colspan="2"> CUSTOMER SGNATURE / STAMP       </td>
                                                <td colspan="2"> CUSTOMER REP.NAME    </td>
                                                <td colspan="2"> SER. ACC. SUPER </td>
                                                <td colspan="2">  SER. OPR. MANAGER  </td>
                                                <td colspan="2">   MGR. F&A </td>
                                          </tr>   

                                          <tr style="height: 60px;"> <!-- #10 -->
                                                <td colspan="2">        </td>
                                                <td colspan="2">     </td>
                                                <td colspan="2">  </td>
                                                <td colspan="2">    </td>
                                                <td colspan="2">   </td>
                                          </tr>   

                                          <tr> <!-- #10 -->
                                                <td colspan="2"> INVOICED BY:  </td>
                                                <td colspan="6">  </td>
                                                <td colspan="2">   مصدر الفاتورة  </td>
                                          </tr>                
                                    </tbody>
</table>
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