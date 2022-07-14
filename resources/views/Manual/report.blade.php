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
                <div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
				    <a href="customer/list" target="blank">
					    <div class="panel info-box panel-white">
						<div class="panel-body staff-member">
						    <img src="{{ URL::asset('public/img/dashboard/client.png')}}" class="dashboard_background" alt="">
							<div class="info-box-stats">
								<input class="counter" id="final">{{ $report }} </input>
								<span class="info-box-title"> Invoices </span>
							</div>
						</div>
					    </div>
					</a>
			    </div>

                <div class="form-group row">
					<label for='date' class="col-form-label col-sm-2">Filter by date</label>
					<div class="col-sm-3">
							<input type="text" class="form-control input-sm" id="filter" name="filter" required>
					</div>

				</div>

                        </div>
                	</div>
            	</div>
          	</div>
        </div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">
 $(document).ready(function() {



$('#filter').change(function() {
    var date = $(this).val();
    var url = '{{ route("CountFinal", ":date") }}';
    url = url.replace(':date', date);

    $.ajax({
        url: url
        , type: 'get'
        , dataType: 'json'
        , success: function(response) {

            if (response != null) {
                $('#final').text(response);
                console.log(response);
            }
        }
    });
});


});
</script>
@endsection