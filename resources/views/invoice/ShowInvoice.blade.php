@extends('layouts.app')
@section('content')

<style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
}

.table>tbody>tr>td {
    padding: 5px 2px 5px 2px;
}

#shoInvoice>tbody>.bayan>td {
    padding: 20px 2px 20px 2px;
}


#shoInvoice2>tbody>.sep>td {
    padding: 12px 2px 12px 2px;
}

</style>

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
								@can('invoice_view')
									<li role="presentation" class="active"><a href="{!! url('/invoice/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('app.Invoice List')}}</b></a></li>
								@endcan

								@can('invoice_add')
									<li role="presentation" class=""><a href="{!! url('/invoice/add')!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('app.Add Invoice')}}</a></li>
								@endcan
								@can('invoice_add')
									<li role="presentation" class="setMarginForAddSalePartInvoiceOnSmallDevice"><a href="{!! url('/invoice/sale_part')!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('app.Add Sale Part Invoice')}}</a></li>
								@endcan
							</ul>
						</div>
			 			<div class="x_panel setMarginForXpanelDivOnSmallDevice" style="margin-top: 30px;">
			 				<div class="row">
			 					<div class="col-md-4 col-sm-3 col-xs-3">
			 						<img height="60" src="{{ asset('public/admin/image001.jpg') }}" alt="lacasacode"> &nbsp; &nbsp; &nbsp;
 
			 						<?php //<span class="text-lead"> <i><u> Lacasa Code Company </u></i>  </span> ?>
			 					</div>

			 					<div class="col-md-5 col-sm-3 col-xs-3">
			 						<span class="text-lead"> <i><u> 
			 						   قسم المركبات التجارية 
			 							<br> Commercial Vehicles Division 
			 						</u></i> 
			 					   </span>
			 					</div>

			 					<div class="col-md-3 col-sm-4 col-xs-12">  
			 						<?php echo DNS2D::getBarcodeHTML(strval($invoice->id), 'QRCODE', 3,3); ?>
			 						</span>
			 					</div>

			 				</div>
                  			<table id="shoInvoice" class="table" style="margin-top:20px; border: none; font-size: 10px;">
                      			<thead>
                      			</thead>
                      				<tbody>
                        			<tr>
                        				<td>SERVICE SALES</td>
                        				<td>####</td>
                        				<td>INVOICE NO:</td>
                        				<td>1234</td>
                        				<td>1234</td>
                        				<td>رقم الفاتورة</td>
                        				<td>DATE:</td>
                        				<td>87/87/2020</td>
                        				<td>87/87/2020</td>
                        				<td>التاريخ</td>
                        			</tr>

                        			<tr style="padding-top: -10px; padding-bottom: -10px;">
                        <td style="padding-top: -10px; padding-bottom: -10px;">CUSTOMER NAME:</td>
                        <td style="padding-top: -10px; padding-bottom: -10px;" colspan="4">Ahmed Apex</td>
                        <td style="padding-top: -10px; padding-bottom: -10px;" colspan="4">Ahmed Apex</td>
                        <td style="padding-top: -10px; padding-bottom: -10px;">اسم العميل</td>
                        			</tr>

                        			<tr>
                        				<td> Address</td>
                        				<td colspan="4">Adress right here </td>
                        				<td colspan="4">Adress right here </td>
                        				<td>العنوان</td>
                        			</tr> 

                        			<tr>
                        				<td colspan="3"> CUSTOMER VAT NO:</td>
                        				<td colspan="6" style="text-align: center;"> #number </td>
                        				<td> رقم العميل الضريبى </td>
                        			</tr>  

                        			<tr> <!-- #1 -->
                        				<td> TELEPHONE ND: </td>
                        				<td colspan="2"> 01044455566</td>
                        				<td colspan="2"> رقم الهاتف : </td>
                        				<td colspan="2"> VAT NO.: </td>
                        				<td colspan="2"> #@111222333 </td>
                        				<td> الرقم الضريبى: </td>
                        			</tr>  

                        			<tr> <!-- #2 -->
                        				<td> CUSTOMER NO: </td>
                        				<td colspan="2"> 444</td>
                        				<td colspan="2"> رقم العميل: </td>
                        				<td colspan="2"> BRANCH NAME: </td>
                        				<td colspan="2"> Elharam </td>
                        				<td> اسم الفرع: </td>
                        			</tr>  

                        			<tr> <!-- #3 -->
                        				<td> MCO/JOB NO: </td>
                        				<td colspan="2"> #number </td>
                        				<td colspan="2"> رقم امر العمل: </td>
                        				<td colspan="2"> METERS READING (HAS/KM): </td>
                        				<td colspan="2"> #number  </td>
                        				<td> قراءة العداد: </td>
                        			</tr>  

                        			<tr>  <!-- #4 -->
                        				<td> QUOTATION NO: </td>
                        				<td colspan="2"> #number </td>
                        				<td colspan="2"> رقم العرض:  </td>
                        				<td colspan="2"> FLEET NUMBER: </td>
                        				<td colspan="2"> #number </td>
                        				<td> رقم الأسطول : </td>
                        			</tr>  

                        			<tr>  <!-- #5 -->
                        				<td> CUSTOMER P.O NO: </td>
                        				<td colspan="2"> #number </td>
                        				<td colspan="2"> رقم امر الشراء: </td>
                        				<td colspan="2"> REGISTRATION: </td>
                        				<td colspan="2"> #number </td>
                        				<td> رقم التسجيل: </td>
                        			</tr>  

                        			<tr>  <!-- #6 -->
                        				<td> CREDIT / CASH: </td>
                        				<td colspan="2"> #number  </td>
                        				<td colspan="2"> نقدا/ على الحساب: </td>
                        				<td colspan="2"> MANUFACTURER: </td>
                        				<td colspan="2"> #number  </td>
                        				<td> الصانع: </td>
                        			</tr>  

                        			<tr>  <!-- #7 --> 
                        				<td> JOPE OPEN DATE: </td>
                        				<td colspan="2">  #number  </td>
                        				<td colspan="2"> تاريخ بدء العمل: </td>
                        				<td colspan="2"> SERIAL NO: </td>
                        				<td colspan="2">  #number  </td>
                        				<td> رقم التسلسل: </td>
                        			</tr>  

                        			<tr> <!-- #8 -->
                        				<td> DELIVERY DATE: </td>
                        				<td colspan="2"> #number  </td>
                        				<td colspan="2"> تاريخ التسليم: </td>
                        				<td colspan="2"> MODEL: </td>
                        				<td colspan="2"> #number  </td>
                        				<td> الطراز: </td>
                        			</tr>   

                        			 <!-- #9 -->
                        			<tr class="success" style="text-align: center;">
                        				<td colspan="6"> البيـــــــــــان DESCRIPTION	 </td>
                        				<td colspan="2"> AMOUNT </td>
                        				<td colspan="2"> القيمة </td>  
                        			</tr>   

                        		<!-- 	<tr style="text-align: center;">
                        				<td colspan="3">  </td>
                        				<td colspan="3">  </td>
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>  
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3">  </td>
                        				<td colspan="3">  </td>
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>   -->
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3"> VALUE OF SERVICE </td>
                        				<td colspan="3"> قيمة الخدمة </td>
                        				<td colspan="2"> 2185 </td>
                        				<td colspan="2"> 2185 </td>  
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3"> DISCOUNT </td>
                        				<td colspan="3"> الخصم </td>
                        				<td colspan="2">  78 </td>
                        				<td colspan="2">  78 </td>  
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3"> TOTAL VALUE </td>
                        				<td colspan="3"> المجموع الكلى  </td>
                        				<td colspan="2"> 2184 </td>
                        				<td colspan="2">  2184 </td>  
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3"> VAT 15% </td>
                        				<td colspan="3"> 15%ضريبة القيمة المضافة    </td>
                        				<td colspan="2">  327 </td>
                        				<td colspan="2">  327 </td>  
                        			</tr>

                        			<tr style="text-align: center;">
                        				<td colspan="3"> TOTAL WITH VAT </td>
                        				<td colspan="3">  المجموع الكلى مع الضريبة </td>
                        				<td colspan="2">   2511 </td>
                        				<td colspan="2">    2511 </td>  
                        			</tr>

                        			</tbody>
                    		</table>

                    		<table id="shoInvoice2" class="table" style="margin-top: -8px; border: none; font-size: 12px;">
                      			<thead>
                      			</thead>
                      				<tbody>
                        			<tr> <!-- #9 -->
                        				<td colspan="2"> توقيع العميل / الختم	 </td>
                        				<td colspan="2"> اسم ممثل العميل	  </td>
                        				<td colspan="2">  مشرف حسابات الورش  </td>
                        				<td colspan="2"> مدير عمليات الصيانة	 </td>
                        				<td colspan="2"> المدير المالى الاقليمى  </td>
                        			</tr>   

                        			<tr> <!-- #10 -->
                        				<td colspan="2"> CUSTOMER SGNATURE / STAMP	 </td>
                        				<td colspan="2"> CUSTOMER REP.NAME	  </td>
                        				<td colspan="2"> SER. ACC. SUPER </td>
                        				<td colspan="2">  SER. OPR. MANAGER	 </td>
                        				<td colspan="2">   MGR. F&A </td>
                        			</tr>   

                        			<tr class="sep"> <!-- #10 -->
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>
                        				<td colspan="2">  </td>
                        			</tr>   

                        			<tr> <!-- #10 -->
                        				<td colspan="2"> INVOICED BY:	 </td>
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
<!-- /page content -->

@endsection