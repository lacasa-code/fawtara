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
						 <div class="form-group row">
                                    <label for='date' class="col-form-label col-sm-2">From</label>
									<div class="col-sm-3">
									    <input type="date" class="form-control input-sm" id="fromdate" name="fromdate" required>
									</div>
								</div>
								<div class="form-group row">
								    <label for='date' class="col-form-label col-sm-2">To</label>
									<div class="col-sm-3">
									    <input type="date" class="form-control input-sm" id="todate" name="todate" required>
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
                      			<tbody>
								<?php $i = 1; ?>   
					  			@foreach($invoice as $invoices)
								<tr class="texr-left">
									<td>{{ $i }}</td>
									<td>{{ '#'.Auth::user()->branch_id.'-'.$invoices->Invoice_Number }}</td>
									<td>{{ $invoices->Customer }}</td>
									<td>{{ $invoices->Invoice_type }}</td>
									<td>
										<?php $format = trim( chunk_split($invoices->reg_chars, 1, ' ') ); ?> 
									{{ $invoices->registeration }} {{ ucwords($format) }}  </td>
									
									<td>{{ $invoices->Status }} </td>
									<td>{{ $invoices->chassis_no }} </td>
									<td>{{ number_format($invoices->total_amount, 2) }}</td>
									<td>{{ number_format($invoices->paid_amount, 2) }}</td>
									<td>{{ date(getDateFormat(),strtotime($invoices->Date)) }}</td>
									<td>
									@if(getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
										@if($invoices->type != 2)
											

											<a href="{{ route('showInvoiceManual', ['id' => $invoices->id]) }}" type="button" class="btn btn-primary btn-round"> Show </a>	

											<a href="{{ route('preview', ['id' => $invoices->id]) }}" type="button" class="btn btn-warning btn-round"> preview </a>	
	
											
										@endif
									@endif

									</td>	
								</tr>
						 		<?php $i++; ?>   
								@endforeach
                      			</tbody>
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
	$(document).ready(function() 
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
          },'pdf']
	    });


  	}); 
</script>
@endsection