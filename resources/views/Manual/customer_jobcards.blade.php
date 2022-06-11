@extends('layouts.app')
@section('content')

<!-- page content -->
	<div class="right_col" role="main">
		<div id="myModal-job" class="modal fade setTableSizeForSmallDevices" role="dialog">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header"> 
						<a href=""><button type="button" data-dismiss="modal" class="close">&times;</button></a>
							<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.JobCard')}}</h4>
					</div>
					<div class="modal-body">
					</div>
				</div>
			</div>
		</div>
	<!--gate pass-->

		<div id="myModal-gate" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
 
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header"> 
						<a href=""><button type="button" class="close">&times;</button></a>
						<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Gate Pass')}}</h4>
					</div>
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
							<a id="menu_toggle">
								<i class="fa fa-bars"></i><span class="titleup">&nbsp {{ trans('app.JobCard')}}</span>
							</a>
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
								<label for="checkbox-10 colo_success"> {{trans('app.Successfully Submitted')}}  </label>
						   	@elseif(session('message')=='Successfully Updated')
						   		<label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated')}}  </label>
						   	@elseif(session('message')=='Successfully Deleted')
						   		<label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted')}}  </label>
						   	@endif
						</div>
					</div>
				</div>
			@endif
			
			<div class="row" >
				<div class="col-md-12 col-sm-12 col-xs-12" >
					<div class="x_content">
						<ul class="nav nav-tabs bar_tabs tabconatent" role="tablist">
						</ul>
					</div>
					<div class="x_panel table_up_div">
						<table id="datatable" class="table table-striped jambo_table" style="margin-top:20px;">
							<thead>
								<tr>
									<th>{{ trans('app.#')}}</th>
									<th>{{ trans('app.Job Card No')}}</th>
									<th>{{ trans('app.Service Type')}}</th>
									<th>{{ trans('app.Customer Name')}}</th>
									<th>{{ trans('app.Service Date')}}</th>
									<th>{{ trans('app.Status')}}</th>
									<th>{{ trans('app.Action')}}</th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($services))
								   	<?php $i = 1; ?>   
										@foreach ($services as $servicess)	
									
										<tr>
											<td>{{ $i }}</td>
											<td>{{ $servicess->job_no }}</td>
											<td>{{ ucfirst($servicess->service_type) }}</td>
											<td>{{ getCustomerName($servicess->customer_id) }}</td>
											<?php $dateservice = date("Y-m-d", strtotime($servicess->service_date)); ?>
											@if (strpos($available, $dateservice) !== false)
												<td><span class="label  label-danger" style="font-size:13px;">{{ date(getDateFormat(),strtotime($dateservice))}}</span></td>
											@else
												<td>{{ date(getDateFormat(),strtotime($dateservice)) }}</td>
											@endif
											<td><?php if($servicess->done_status == 0)
												 { echo"Open";}
												 else if($servicess->done_status == 1)
												 { echo"Completed";}
												 elseif($servicess->done_status == 2){
													 echo"Progress";
												 } ?>
											</td>

											<td>
	@if(getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
												
		@if(Gate::allows('jobcard_view') && Gate::allows('jobcard_edit') && Gate::allows('jobcard_add'))
													
					@can('jobcard_view')
						<?php $view_data = getInvoiceStatus($servicess->job_no); ?>
												
						@if($view_data == "No")
							@if($servicess->done_status == '1')
									<a href="{{ url('/invoice/electronic/jobcard/add/'.$servicess->id) }}"><button type="button" class="btn btn-round btn-info">{{ trans('app.Create Invoice')}} </button></a>			
														
							@elseif($servicess->done_status != '1'  )
															<a href="{{ url('jobcard/list/add_invoice/'.$servicess->id) }}"><button type="button" class="btn btn-round btn-info" disabled>{{ trans('app.Create Invoice')}} </button></a>	
							@else
														<button type="button" data-toggle="modal" data-target="#myModal-job" serviceid="{{ $servicess->id }}" url="{!! url('/jobcard/modalview') !!}" class="btn btn-round btn-info save">{{ trans('app.View Invoice')}} </button>
							@endif
						@endif
					@endcan
			@endif
		@endif
											</td>
										</tr>
										<?php $i++; ?>
										@endforeach
									
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- /page content -->


@endsection