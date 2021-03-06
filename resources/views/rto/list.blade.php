@extends('layouts.app')
@section('content')

<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; {{ trans('app.Compliance Management')}}</span></a> 
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
							@can('rto_view')
								<li role="presentation" class="active"><a href="{!! url('/rto/list')!!}"><span class="visible-xs"></span> <i class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('app.List Of RTO Taxes')}}</b></span></a></li>
							@endcan
							@can('rto_add')
								<li role="presentation" class="setTabAddRtoTaxOnSmallDevice"><a href="{!! url('/rto/add')!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('app.Add RTO Taxes')}}</span></a></li>
							@endcan
						</ul>
					</div>
					<div class="x_panel table_up_div">
						<table id="datatable" class="table table-striped jambo_table" style="margin-top:20px;">
							<thead>
								<tr>
									<th>{{ trans('app.#')}}</th>
									<th>{{ trans('app.Vehicle Name')}}</th>
									<th>{{ trans('app.RTO / Registration C.R. Temp Tax')}}</th>
									<th>{{ trans('app.Number Plate charge')}}</th>
									<th>{{ trans('app.Municipal Road Tax')}}</th>

								<!-- Custom Field Data Label Name-->
									@if(!empty($tbl_custom_fields))
										@foreach($tbl_custom_fields as $tbl_custom_field)	
											<th>{{$tbl_custom_field->label}}</th>
										@endforeach
									@endif
								<!-- Custom Field Data End -->

									@canany(['rto_edit','rto_delete'])
			                        	<th>{{ trans('app.Action')}}</th>
			                        @endcan
								</tr>
							</thead>
							<tbody>
							<?php $i = 1; ?>   
							@foreach ($rto as $rtos)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ getVehicleName($rtos->vehicle_id) }}</td>
									<td>{{ $rtos->registration_tax }}</td>
									<td>{{ $rtos->number_plate_charge }}</td>
									<td>{{ $rtos->muncipal_road_tax }}</td>

								<!-- Custom Field Data Value-->
									@if(!empty($tbl_custom_fields))
				
										@foreach($tbl_custom_fields as $tbl_custom_field)	
											<?php 
												$tbl_custom = $tbl_custom_field->id;
												$userid = $rtos->id;
																						
												$datavalue = getCustomDataRto($tbl_custom,$userid);
											?>
											
											@if($tbl_custom_field->type == "radio")
												@if($datavalue != "")
													<?php
														$radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
													?>
													<td>{{$radio_selected_value}}</td>
												@else
													<td>{{ trans('app.Data not available') }}</td>
												@endif
											@else
												@if($datavalue != null)
													<td>{{$datavalue}}</td>
												@else
													<td>{{ trans('app.Data not available') }}</td>
												@endif
											@endif
										@endforeach
									@endif
								<!-- Custom Field Data End -->

									@canany(['rto_edit','rto_delete'])
									<td>
										@can('rto_edit')
											<a href="{{ url('rto/list/edit/'.$rtos->id) }}" ><button type="button" class="btn btn-round btn-success">{{ trans('app.Edit')}}</button></a>
										@endcan
										@can('rto_delete')
											<a url="{{ url('rto/list/delete/'.$rtos->id) }}" class="sa-warning"><button type="button" class="btn btn-round btn-danger dgr">{{ trans('app.Delete')}}</button></a>
										@endcan
									</td>
									@endcan
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


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- language change in user selected -->	
<script>
$(document).ready(function() 
{
    $('#datatable').DataTable( {
		responsive: true,
        "language": {
			
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo getLanguageChange(); 
			?>.json"
        }
    });


    /*delete rto*/
 	$('body').on('click', '.sa-warning', function() {
	
	  	var url =$(this).attr('url');
	  	var msg1 = "{{ trans('app.Are You Sure?')}}";
	    var msg2 = "{{ trans('app.You will not be able to recover this data afterwards!')}}";
	    var msg3 = "{{ trans('app.Cancel')}}";
	    var msg4 = "{{ trans('app.Yes, delete!')}}";
	  
        swal({   
            title: msg1,
            text: msg2,   
            type: "warning",   
            showCancelButton: true, 
            cancelButtonText: msg3, 
            cancelButtonColor: "#C1C1C1",
            confirmButtonColor: "#297FCA",   
            confirmButtonText: msg4,   
            closeOnConfirm: false
        }, function(){
			window.location.href = url;
             
        });
    }); 
});
</script>
@endsection