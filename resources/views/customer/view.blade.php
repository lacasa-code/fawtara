@extends('layouts.app')
@section('content')
<style>
.right_side .table_row, .member_right .table_row {
    border-bottom: 1px solid #dedede;
    float: left;
    width: 100%;
	padding: 1px 0px 4px 2px;
}
.table_row .table_td {
  padding: 8px 8px !important;
}
.report_title {
    float: left;
    font-size: 20px;
    width: 100%;
}
fieldset {
border: 1px solid #ddd;
border-radius: 6px;
}
</style>

<!-- page content -->
    <div class="right_col" role="main" >
		<!-- free service  model-->
		<div id="myModal-free-open" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header"> 
						<a href="{!! url('/customer/list/'.$viewid)!!}"><button type="button" class="close">&times;</button></a>
						<h4 id="myLargeModalLabel" class="modal-title"> {{ trans('app.Free Service Details')}}</h4>
					</div>
					<div class="modal-body">
	
					</div>
				</div>
			</div>
		</div>
	<!-- Paid Service view -->
		<div id="myModal-paid-service" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
 
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header"> 
						<a href="{!! url('/customer/list/'.$viewid)!!}"><button type="button" class="close">&times;</button></a>
						<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Paid Service Details')}}</h4>
					</div>
					<div class="modal-body">
	                   
					</div>
				</div>
			</div>
		</div>
	<!--  Repeat job service view -->
		<div id="myModal-repeatjob" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
 
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header"> 
						<a href="{!! url('/customer/list/'.$viewid)!!}"><button type="button" class="close">&times;</button></a>
						<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Repeat Job Service Details')}}</h4>
					</div>
					<div class="modal-body">
	                   
					</div>
				</div>
			</div>
		</div>
		<!--  Free service customer view -->
		<div id="myModal-customer-modal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
				<!-- Modal content-->
				<div class="modal-content">
					
					<div class="modal-body">
					
					</div>
				</div>
			</div>
		</div>
        <div class="">
			<div class="page-title">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp {{ trans('app.Customer')}}</span></a>
						</div>
						@include('dashboard.profile')
					</nav>
				</div>
			</div>
        </div>
		@if(session('message'))
		<div class="row massage">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="checkbox checkbox-success checkbox-circle">
					<input id="checkbox-10" type="checkbox" checked="">
					<label for="checkbox-10 colo_success">  {{session('message')}} </label>
				</div>
			</div>
		</div>
	    @endif
        <div class="row" >
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_content">
					<ul class="nav nav-tabs bar_tabs" role="tablist">
						@can('customer_view')
							<li role="presentation" class=""><a href="{!! url('/customer/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp; </i> {{ trans('app.Customer List') }}</a></li>
						@endcan
						
						@can('customer_view')
							<li role="presentation" class="active"><a href="{!! url('/customer/list/'.$viewid)!!}"><span class="visible-xs"></span><i class="fa fa-user">&nbsp; </i><b>{{ trans('app.View Customer') }}</b></a></li>
						@endcan
					</ul>
				</div>
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12 main_left">
						<div class="x_panel">
							<section class="content invoice">
								  <!-- title row -->
								
								<div>
									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											<i class="fa fa-user"></i> 
											<b>{{ trans('app.Name')}}</b>	
										</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    {{ $new_customer -> name }}
											</span>
										</div>
									</div>
									
									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td"><i class="fa fa-phone"></i> <b>{{ trans('app.Mobile No')}}</b> </div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
												<span class="txt_color">{{ $new_customer -> phone }} </span>
											</span>
										</div>
									</div>
									
									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											<i class="fa fa-map-marker"></i> <b>{{ trans('app.Address')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											<span class="txt_color">{{ $new_customer -> address }}</span>
											</span>
										</div>
									</div>
									@if($new_customer -> mail == null)
									@elseif ($new_customer -> mail != null)
									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											<i class="fa fa-envelope"></i> 
											<b>{{ trans('app.Email')}}</b> 	
										</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">{{ $new_customer -> mail }}</span>
										</div>
									</div>
									@endif
								<br><hr>
								<?php $i=1;?>

								@foreach($car as $cars)
								<br>
								<fieldset>
								<legend>Car {{$i}} info:</legend>

									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											 <b>{{ trans('Manufacturing')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    <span class="txt_color">{{ $cars -> manufacturing }}</span>
											</span>
										</div>
									</div>

									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											 <b>{{ trans('Registration')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    <span class="txt_color">{{ $cars -> reg_chars }}{{ $cars -> registration }}</span>
											</span>
										</div>
									</div>

									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											 <b>{{ trans('Date Of Manufacturing')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    <span class="txt_color">{{ $cars -> manufacturing_date }}</span>
											</span>
										</div>
									</div>

									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											 <b>{{ trans('app.Chassis')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    <span class="txt_color">{{ $cars -> chassis }}</span>
											</span>
										</div>
									</div>

									<div class="table_row">
										<div class="col-md-5 col-sm-12 col-xs-12 table_td">
											 <b>{{ trans('Model No')}}</b>		</div>
										<div class="col-md-7 col-sm-12 col-xs-12 table_td">
											<span class="txt_color">
											    <span class="txt_color">{{ $cars -> model }}</span>
											</span>
										</div>
									</div>

									
								</fieldset>
								<?php $i++; ?>
                                <br>
								@endforeach
								<hr>
								<?php $n=1;?>

							<div class="x_panel bgr">
								<table class="table datatable table-striped jambo_table" style="margin-top:20px; width:100%;">
									<thead>
										<tr>
											<th>#</th>
											<th>Invoice</th>
											<th>Date</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($invoice as $invices)
										<tr>
										<td>
											{{$n}}
										</td>
										<td>
											#{{$auth_branch_id}}-{{ $invices->Invoice_Number }}
										</td>
										<td>
											{{ $invices->Date }}
										</td>
										<td>													
											<a class="txt_color" href="{!! url('/invoice/preview/'.$invices ->id)!!}">Preview</a>
										</td>
											<?php $n++; ?>
										</tr>
										@endforeach
										</tbody>
									</table>
									
								</div>
						</div>
					</div>
			
				</div>
			</div>
		</div>
	</div>
	
	</div>
<!-- Page content end -->



<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

	/****** Free Service only *******/

@endsection