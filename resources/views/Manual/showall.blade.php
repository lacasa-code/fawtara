@extends('layouts.app')
@section('content')
<style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
}


</style>
	<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" rel="stylesheet">



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   

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
				   				@elseif(session('message')=='Successfully Invoiced')
				   				<label for="checkbox-10 colo_success"> 
				   					{{ 'Successfully Invoiced' }}  
				   				</label>
				   				@elseif(session('message') == 'restricted')
                                                <label for="checkbox-10" style="background: red;"> 
                                                      {{ 'can not access page' }}
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
							 
							</ul>
						</div>
			 			<div class="x_panel setMarginForXpanelDivOnSmallDevice">
						 <table border="0" cellspacing="5" cellpadding="5">
        						<tbody>
							 	<tr>
									<td>Minimum date:</td>
									<td><input type="text" id="min" name="min"></td>
								</tr>
								<tr>
									<td>Maximum date:</td>
									<td><input type="text" id="max" name="max"></td>
								</tr>
							</tbody>
							</table>

							 <label>Start date:</label>
    <input id="startdate" class="datepicker"></input>
    <label>End date:</label>
    <input id="enddate" class="datepicker"></input>
    <table id="staff"></table>


                  			<table id="datatable" class="table table-striped jambo_table" style="margin-top:20px;">
                      			<thead>
                        			<tr>
										<th>#</th>
										<th>{{ trans('app.Invoice Number')}}</th>
										<th>{{ trans('app.Customer Name')}}</th>
										<th> Invoice Status</th>
				                        <th>{{ trans('app.Number Plate')}}</th>
				                        <th>{{ trans('app.Status')}}</th>
										<th>{{ trans('app.Chasis No')}}</th>
										<th>{{ trans('app.Total Amount')}} ({{getCurrencySymbols()}})</th>
										<th>{{ trans('app.Paid Amount')}} ({{getCurrencySymbols()}})</th> 
				                        <th>{{ trans('app.Date')}}</th>
				                        <th>{{ trans('app.Action')}}</th>
                        			</tr>
                      			</thead>
                      			<tbody>
								<?php $i = 1; ?>   
					  			@foreach($invoice as $invoices)
								<tr class="texr-left">
									<td>{{ $i }}</td>
									<td>{{ '#'.Auth::user()->branch_id.'-'.$invoices->Invoice_Number }}</td>
									<td>{{ $invoices->Customer }}</td>
									<td>
									@if($invoices->final == 0)
									{{ 'Job' }}
									@else
									{{ 'Invoice' }}
								    @endif</td>
								    <?php $format = trim( chunk_split($invoices->reg_chars, 1, ' ') ); ?> 
									<td>{{ $invoices->registeration }} {{ ucwords($format) }}  </td>
									<td>{{ $invoices->Status }} </td>
									<td>{{ $invoices->chassis_no }} </td>
									<td>{{ number_format($invoices->total_amount, 2) }}</td>
									<td>{{ number_format($invoices->paid_amount, 2) }}</td>
									<td>{{ date(getDateFormat(),strtotime($invoices->Date)) }}</td>
									<td>
									@if(getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
										@if($invoices->type != 2)
											

											<a href="{{ route('showInvoiceManual', ['id' => $invoices->id]) }}" type="button" class="btn btn-info btn-round"> Show </a>	

											<a href="{{ route('ManualEdit', ['id' => $invoices->id]) }}" type="button" class="btn btn-primary btn-round"> Edit </a>	

											<a href="{{ route('ManualInvoiced', ['id' => $invoices->id]) }}" type="button" class="btn btn-success btn-round"> Invoiced </a>	

	
											
										@endif
									@endif

									</td>	
								</tr>
						 		<?php $i++; ?>   
								@endforeach
                      			</tbody>

                    		</table>

                    <?php //	{!! $invoice->links() !!} ?>
                  		</div>
                	</div>
            	</div>
          	</div>
        </div>
<!-- /page content -->




	 

    <!--<script src="https://code.jquery.com/jquery-1.12.3.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>



	 <script type="application/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="application/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>






<script type="text/javascript">

		var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 	$.fn.dataTable.ext.search.push(
		function( settings, data, dataIndex ) {
			var min = minDate.val();
			var max = maxDate.val();
			var date = new Date(data[9]);

			if (
				( min === null && max === null ) ||
				( min === null && date <= max ) ||
				( min <= date   && max === null ) ||
				( min <= date   && date <= max )
			) {
				return true;
			}
			return false;
		}
 	);

	$(document).ready(function() {
		minDate = new DateTime($('#min'), {
			format: 'DD-MM-YYYY'
    	});
			maxDate = new DateTime($('#max'), {
			format: 'DD-MM-YYYY'
			});
		// DataTables initialisation
	    var table = $('#datatable').DataTable({
            responsive: true,
            dom: 'Bfrtip',

            buttons: [{
               extend: 'excelHtml5',
                title: 'Excel Export',
                extension: '.xlsx',
                text: 'Export to Excel',
         exportOptions: {
        format: {
                        body: function ( data, column, row ) {                             
                            //if it is html, return the text of the html instead of html
                            if (/<\/?[^>]*>/.test(data)) {                                   
                                return $(data).text();
                            } else {
                                return data;
                            }                                                               
                        }
                    }
        },
        customize: function(xlsx) {
            var sheet = xlsx.xl.worksheets['Sheet1.xml'];
             $('row c[r*="3"]', sheet).attr( 's', '20' );
            $('row c[r*="2"]', sheet).attr( 's', '25' );
           }
          },'pdf']
        });

		
    });

	$('#min, #max').on('change', function () {
        table.draw();
    });







//Global variable for future use
var datepickers = [{
    id: 'startdate',
    coid: 'enddate',
    value: null,
    limiter: 'minDate'
  }, {
    id: 'enddate',
    coid: 'startdate',
    value: null,
    limiter: 'maxDate'
  }
];
//Translate 'yy/mm/dd' string to UTC date
const yymmddUTC = str => new Date(...str.split('/').map((value,index) => index == 1 ? value-- : value));
//DataTables object definition
var myDataTable = $('#datatable').DataTable({
    sDom: 't',
    data: myTableData,
    
  });
//Limit datepicker options to those valid for current dataset
var dates = myDataTable.column(9).data().unique().sort();
var minDate = dates[0];
var maxDate = dates[dates.length-1];
//datepicker objects definition
$('.datepicker').datepicker({
  dateFormat: 'DD-MM-YYYY',
  changeMonth: true,
  defaultDate: minDate,
  changeYear: true,
  yearRange: minDate.substr(0,4)+':'+maxDate.substr(0,4),
  onSelect: function (selectedDate) {
    let datepicker = datepickers.find(entry => entry.id == $(this).attr('id'));
    $(`#${datepicker.coid}`).datepicker('option', datepicker.limiter, selectedDate);
    datepicker.value = yymmddUTC(selectedDate);
    myDataTable.draw();
  }
}).on('change', function(){
  datepickers[datepickers.findIndex(item => item.id == $(this).attr('id'))].value = yymmddUTC($(this).val());
  myDataTable.draw();
});
//External search function
$.fn.DataTable.ext.search.push((settings, row) => {
  let rowDate = yymmddUTC(row[9]);
  return (rowDate >= datepickers[0].value || datepickers[0].value == null) && (rowDate <= datepickers[1].value || datepickers[1].value == null);
});



	</script>
@endsection
