<html>
	<head>
		<meta content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link rel="icon" href="{{ URL::asset('fevicol.png') }}" type="image/gif" sizes="16x16">
    <title>{{ getNameSystem() }}</title>


    <!-- Bootstrap -->
    <link href= "{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   
  <!-- <link href="{!! URL::asset('build/dist/css/select2.min.css'); !!}" rel='stylesheet' type='text/css'> -->
  <style>
    @media print
      {
        .noprint{ display:none }
      }
  </style>
	  <style>
	    * { font-family: DejaVu Sans, sans-serif; }
	  </style>
	</head>
	<style>
      body{
      font-family: 'Helvetica';
      font-style: normal;
      font-weight: normal;
      color:#333;
      }
      .itemtable th, td {
      padding: 0px 14px 6px 14px;
      font-size:12px;
      }
      
      #imggrapish{
      margin-top: -50px;
      margin-left: 25px;
      }
      page[size="A4"] {
      background: white;
      width: 21cm;
      height: 29.7cm;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      }
      @media print {
      body, page[size="A4"] {
      margin: 0;
      box-shadow: 0;
      }
      }	
   </style>

   <style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
}

.table>tbody>tr>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice>tbody>.bayan>td {
    padding: 5px 2px 5px 2px;
}


#shoInvoice2>tbody>.sep>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice2 {
    padding-bottom: : -72px;
}

</style>

	<body id="app-layout" class="nav-md">
                        
<style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
}

.table>tbody>tr>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice>tbody>.bayan>td {
    padding: 5px 2px 5px 2px;
}


#shoInvoice2>tbody>.sep>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice2 {
    padding-bottom: : -72px;
}

</style>

                                 
<div class="container">                  
<div id="printMe">

                  <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                         
                                          <img style="height: 70px;" src="{{ URL::asset('public/img/branch/'.$branch->branch_image) }}" class="cimg"> &nbsp; &nbsp; &nbsp;

                                    </div>

                                  
                                   <div  style="text-align: center;" class="col-md-5 col-sm-3 col-xs-3">
                                                      <span class="text-lead"> <u> <br>
                                                             
                                                          {{ $branch->name_en }}&nbsp; &nbsp; {{ $branch->branch_name }}
                                                          <br>
                                                         {{ $branch->division_en }} &nbsp; &nbsp; {{ $branch->division }}
                                                      </u>
                                                   </span>
                                    </div>

                                    <div class="col-md-3 col-sm-4 col-xs-3">  
		                              <span>  
		                              <?php 
		                                    $path_one = strstr(URL::current(), 'invoice',true); 
		                                    $path_two = $path_one.'invoice/scan/'; 
		                                    $path_three = $path_one.'invoice/scan/'.$invoice->id; 
		                              ?>
		                                     
		                            <a href="{{$path_three}}"> 
		                                 <?php echo QrCode::size(90)->generate(strval($path_two.$invoice->id)); ?> </a> </span>
                                    </div>

                        </div><br>

      <table id="shoInvoice" class="table table-bordered" style="margin-top:5px; font-size: 10px;">
                <thead>
                                    </thead>
                                          <tbody>
                                          <tr>
                                                <td style="text-align: left;">SERVICE/SALES </td>
                                                <td style="text-align: center;">{{ 'تامدخ  ' }} </td>
                                                <td style="text-align: right;"> بيع  /خدمات</td>
                                                <td style="text-align: left;">INVOICE NO: </td> 
                                                <td colspan="2" style="text-align: center;"> {{ $invoice->Invoice_Number }}   </td> 
                                                <td style="text-align: right;">رقم الفاتوره  </td>
                                                <td style="text-align: left; border-right: none;">Date  </td>
                                                <td style="text-align: center;">{{ $invoice->Date}} </td>
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
                                                <td style="text-align: center;"> {{ $invoice->vat_number }}  </td>
                                                <td colspan="2" style="text-align: right;"> الرقم الضريبى: </td>
                                          </tr>  

                                    <tr> <!-- #1 -->
                                          <td colspan="2" style="text-align: left;"> TELEPHONE ND: </td>
                                          <td style="text-align: center;"> {{ $invoice->phone_code }} {{ ' ' }}{{ $invoice->customer_phone }} </td>
                                          <td colspan="2" style="text-align: right;"> رقم الهاتف : </td>
                                          <td colspan="2" style="text-align: left;"> BRANCH NAME: </td>
                                          <td style="text-align: center;"> {{ $invoice->branch_name }}</td>
                                          <td colspan="2" style="text-align: right;"> اسم الفرع: </td>
                                    </tr>  

                                          <tr> <!-- #2 -->
                                          <td colspan="2" style="text-align: left;"> CUSTOMER NO: </td>
                                          <td style="text-align: center;"> {{ $invoice->customer_number }}</td>
                                          <td colspan="2" style="text-align: right;"> رقم العميل: </td>
                                          <td colspan="2" style="text-align: left;"> METERS READING (HAS/KM): </td>
                                          <td style="text-align: center;"> {{ $invoice->meters_reading }}  </td>
                                          <td colspan="2" style="text-align: right;"> قراءة العداد: </td>
                                                
                                          </tr>  

                                          <tr> <!-- #3 -->
                                                <td colspan="2" style="text-align: left;"> MCO/JOB NO: </td>
                                                <td style="text-align: center;"> {{ $invoice->Job_card }} </td>
                                                <td colspan="2" style="text-align: right;"> رقم امر العمل: </td>
                                                <td colspan="2" style="text-align: left;"> MANUFACTURER: </td>
                                          <td style="text-align: center;"> {{ $invoice->fleet_number }} </td>
                                          <td colspan="2" style="text-align: right;"> {{ trans('المصنع ')}} </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #4 -->
                                                <td colspan="2" style="text-align: left;"> QUOTATION NO: </td>
                                          <td style="text-align: center;"> {{ $invoice->quotation_number }} </td>
                                          <td colspan="2" style="text-align: right;"> رقم العرض:  </td>
                                          <td colspan="2" style="text-align: left;"> REGISTRATION: </td>
                                          <?php $format = trim( chunk_split($invoice->reg_chars, 1, ' ') ); ?> 
                        
                                          <td style="text-align: center;">
                                                {{ $invoice->registeration }} {{ ucwords($format) }}  </td>
                                                <td colspan="2" style="text-align: right;"> رقم التسجيل: </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #5 -->
                                          <td colspan="2" style="text-align: left;"> CUSTOMER P.O NO: </td>
                                          <td style="text-align: center;">{{ $invoice->customer_po_number }}</td>
                                          <td colspan="2" style="text-align: right;"> رقم امر الشراء: </td>
                                          <td colspan="2" style="text-align: left;"> MANUFACTURING DATE: </td>
                                          <td style="text-align: center;">{{ $invoice->manufacturer }}</td>
                                          <td colspan="2" style="text-align: right;"> اتاريخ التصنيع   </td>
                                                
                                          </tr>  

                                          <tr>  <!-- #6 -->
                                                <td colspan="2" style="text-align: left;"> CREDIT / CASH: </td>
                                                <td  style="text-align: center;"> {{ $paymentMethod->payment }}  </td>
                                                <td colspan="2" style="text-align: right;"> نقدا/ على الحساب: </td>
                                                <td colspan="2" style="text-align: left;"> CHASSIS NO: </td>
                                                <td  style="text-align: center;">  {{ $invoice->chassis_no }}  </td>
                                                <td colspan="2" style="text-align: right;"> رقم  الهيكل   </td>
                                          </tr>  

                                          <tr>  <!-- #7 --> 
                                                <td colspan="2" style="text-align: left;"> JOPE OPEN DATE: </td>
                                                <td  style="text-align: center;">  {{ $invoice->job_open_date }}  </td>
                                                <td colspan="2" style="text-align: right;"> تاريخ بدء العمل: </td>
                                                <td colspan="2" style="text-align: left;"> MODEL: </td>
                                                <td  style="text-align: center;"> {{ $invoice->model_name }}  </td>
                                                <td colspan="2" style="text-align: right;"> الطراز: </td>
                                          </tr>  

                                          <tr> <!-- #8 -->
                                                <td colspan="2" style="text-align: left;"> DELIVERY DATE: </td>
                                                <td  style="text-align: center;"> {{ $invoice->delivery_date }}  </td>
                                                <td colspan="2" style="text-align: right;"> تاريخ التسليم: </td>
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
                                                      {{ $invoice->services_sum }} </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;"> DISCOUNT </td>
                                                <td colspan="4" style="text-align: center;"> الخصم </td>
                                                <td colspan="2" style="text-align: center;">  {{ $invoice->Discount }} </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;">  TOTAL VALUE </td>
                                                <td colspan="4" style="text-align: center;"> المجموع الكلى  </td>
                                                <td colspan="2" style="text-align: center;">  
                              <?php 
                                    if($invoice->Discount > 0){
                                          $percent = ($invoice->services_sum * $invoice->Discount ) / 100; 
                                          $total_amount = $invoice->services_sum - $percent;
                                    }
                                    else{
                                           $total_amount = $invoice->services_sum;
                                    }
                              ?> 
                                          {{ $total_amount }} 
                                                </td>
                                          </tr>

                                          <tr>
                                                <td colspan="4" style="text-align: center;">  VAT 15% </td>
                                                <td colspan="4" style="text-align: center;">   15%ضريبة القيمة المضافة   </td>
                                                <td colspan="2" style="text-align: center;"> 
                              <?php 
                                    if($invoice->Discount > 0){
                                          $percent = ($invoice->services_sum * $invoice->Discount ) / 100; 
                                          $total_amount = $invoice->services_sum - $percent;
                                    }
                                    else{
                                           $total_amount = $invoice->services_sum;
                                    }
                              ?> 
                                          {{ $tax_percent = ($total_amount * 15) / 100 }}
                                                      
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

<table id="shoInvoice2" class="table" style="margin-top: -8px; border: none; font-size: 12px;">
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
                                          <tr> <!-- #10 -->
                                                <td colspan="2"> INVOICED BY:  </td>
                                                <td colspan="6">  </td>
                                                <td colspan="2">   مصدر الفاتورة  </td>
                                          </tr>                
                                    </tbody>                                
</table>
      </div> </div> 




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


            <footer>
            <div>
                  <span class="footerbottom">All rights reserved by Garage System.</span>
            </div>
        </footer>

      <script type="text/javascript">
            $(document).ready(function(){
                  $('form').bind("keypress", function(e) {
                        if (e.keyCode == 13) {
                              e.preventDefault();
                              return false;
                        }
                  });
            });


          var csrf_token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
          function csrfSafeMethod(method) {
              // these HTTP methods do not require CSRF protection
              return (/^(GET|HEAD|OPTIONS)$/.test(method));
          }
          var o = XMLHttpRequest.prototype.open;
          XMLHttpRequest.prototype.open = function(){
              var res = o.apply(this, arguments);
              var err = new Error();
              if (!csrfSafeMethod(arguments[0])) {
                  this.setRequestHeader('anti-csrf-token', csrf_token);
              }
              return res;
          };
      </script>

</body>
</html>
