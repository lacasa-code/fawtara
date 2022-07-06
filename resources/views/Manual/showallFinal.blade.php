@extends('layouts.app')
@section('content')

<style>
.table>thead>tr>th {
    padding: 12px 2px 12px 4px;
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
				   				@elseif(session('message')=='Successfully Invoiced')
				   				<label for="checkbox-10 colo_success"> 
				   					{{ 'Successfully Invoiced' }}  
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
						    <div class="row input-daterange">
                                <div class="col-md-4">
                                    <input type="date" name="fromdate" id="fromdate" class="form-control " placeholder="From Date" required />
                                </div>
                
								<div class="col-md-4">
					     			<input type="date" name="todate" id="todate" class="form-control" placeholder="To Date" required />
                                </div>

                
								<div class="col-md-4">
								    <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
								    <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                                </div>
                            </div>      
		

							<table id="datatable" class="table table-striped jambo_table" style="margin-top:20px;">
                      			<thead>
                        			<tr>
										<th>#</th>
										<th>{{ trans('app.Invoice Number')}}</th>
										<th>{{ trans('app.Customer Name')}}</th>
										<th>{{ trans('app.Invoice For')}}</th>
				                        <th>{{ trans('app.Number Plate')}}</th>
				                        <th>{{ trans('app.Status')}}</th>
										<th>{{ trans('app.Chasis No')}}</th>

										<th>{{ trans('app.Total Amount')}} ({{getCurrencySymbols()}})</th>
										<th>{{ trans('app.Paid Amount')}} ({{getCurrencySymbols()}})</th> 
				                        <th>{{ trans('app.Date')}}</th>
				                        <th>{{ trans('app.Action')}}</th>
                        			</tr>
                      			</thead>
                      		 
                    		</table>
                  		</div>
                	</div>
            	</div>
          	</div>
        </div>
<!-- /page content -->
<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

<script>
$(document).ready(function(){

	load_data();

    function load_data(fromdate = '', todate = '')
    {
		$('#datatable').DataTable( {

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
          },'pdf'],
            ajax: {
                    url:'/invoice/final/daterange/',
                    data:{fromdate:fromdate, todate:todate}
                },
    columns: [
   {
	data:'Invoice_Number',
	name:'Invoice_Number'
   },
   {
	data:'Customer',
	name:'Customer'
   },
   {
	data:'Invoice_type',
	name:'Invoice_type'
   },
   {
	data:'registeration',
	name:'registeration'
   },
   {
	data:'Status',
	name:'Status'
   },
   {
	data:'chassis_no',
	name:'chassis_no'
   },
   {
	data:'total_amount',
	name:'total_amount'
   },
   {
	data:'paid_amount',
	name:'paid_amount'
   },
   {
	data:'Date',
	name:'Date'
   },
  ]
 });
}

$('#filter').click(function(){
  var from_date = $('#fromdate').val();
  var to_date = $('#todate').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#datatable').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#fromdate').val('');
  $('#todate').val('');
  $('#datatable').DataTable().destroy();
  load_data();
 });

});
</script>
@endsection 