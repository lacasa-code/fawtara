
<!DOCTYPE html>
<html dir="" lang="en" >
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
    <!-- Font Awesome -->
    <link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
   <!-- iCheck -->
    <link href="{{ URL::asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <!-- <link href="{{ URL::asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet"> -->
    <!-- Select2 -->
    <link href="{{ URL::asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">


  <!-- FullCalendar -->
    <link href="{{ URL::asset('vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">
  <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }} " rel="stylesheet">
    <link href="{{ URL::asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
  <!-- dropify CSS -->
  <link rel="stylesheet" href="{{ URL::asset('vendors/dropify/dist/css/dropify.min.css') }}">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('build/css/custom.min.css') }} " rel="stylesheet">

   <!-- Own Theme Style -->
    <link href="{{ URL::asset('build/css/own.css') }} " rel="stylesheet">


  <!-- Our Custom stylesheet -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/responsive_styles.css') }}">

  <!-- MoT Custom stylesheet -->
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('public/css/custom_mot_styles.css') }} ">
   <!-- Datatables -->

    <link href="{{ URL::asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ URL::asset('build/css/dataTables.responsive.css') }} " rel="stylesheet">
   <link href="{{ URL::asset('build/css/dataTables.tableTools.css') }} " rel="stylesheet">
    <!-- <link href="{{ URL::asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet"> -->

    <link href="{{ URL::asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

   <!-- AutoComplete CSS -->
  <link href="{{ URL::asset('build/css/themessmoothness.css') }}" rel="stylesheet">
   <!-- Multiselect CSS -->
  <link href="{{ URL::asset('build/css/multiselect.css') }}" rel="stylesheet">
   <!-- Slider Style -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/google_api_font.css') }}">
  
  <!-- sweetalert -->
  <link href="{{ URL::asset('vendors/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">

  <!-- <link href="{!! URL::asset('build/dist/css/select2.min.css'); !!}" rel='stylesheet' type='text/css'> -->
  <style>
    @media print
      {
        .noprint{ display:none }
      }
  </style>
</head>

<body id="app-layout" class="nav-md">
      <div class="container body">
      <div class="main_container">
                 
            </div>

<!-- page content -->
        <div class="right_col" role="main">
                  <!--invoice modal-->
                 
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
                        
                  </div>
                                          <div class="row" >
                              <div class="col-md-12 col-sm-12 col-xs-12" >
                              <div class="x_content">
                                          
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
                              <td style="text-align: center;">  
                                                      <img style="height: 70px; width: 200px;" src="{{ URL::asset('public/img/branch/'.$branch->branch_image) }}" class="cimg"> &nbsp; &nbsp; &nbsp; 
                              </td>
                                          </tr>    
                                    </tbody>
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
                                                <td style="text-align: center;">{{$invoice->Invoice_Number}}</td> 
                                                <td style="text-align: center;">رقم الفاتوره  </td>
                                          </tr>

                                          <tr>
                                                <td style="text-align: center; border-right: none;">Date  </td>
                                                <td style="text-align: center;">{{ $invoice->Date}} 
                                                  {{ $invoice->created_at->format('H:i:s A') }} </td>
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

      </div>
    </body>



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
            </div>
        </footer>
      </div>
</div>


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
