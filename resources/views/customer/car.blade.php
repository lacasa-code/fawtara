@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- page content -->
<style>
.theTooltip {
	    position: absolute!important;
-webkit-transform-style: preserve-3d; transform-style: preserve-3d; -webkit-transform: translate(15%, -50%); transform: translate(15%, -50%);
}
</style>

    <div class="right_col" role="main" style="background-color: #e6e6e6;">
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
		<div class="x_content">
            <ul class="nav nav-tabs bar_tabs" role="tablist">
            	@can('customer_view')
					<li role="presentation" class=""><a href="{!! url('/customer/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Customer List') }}</a></li>
				@endcan
				@can('customer_add')
					<li role="presentation" class=""><a href="{!! url('/customer/add')!!}"><span class="visible-xs"></span><i class="fa fa-plus-circle fa-lg">&nbsp;</i> <b>{{ trans('app.Add Customer') }}</b></a></li>
				@endcan
				<li role="presentation" class="active"><a href="{!! url('/customer/add/car')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('Add Car') }}</a></li>

            </ul>
		</div>
		<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
						<form id="demo-form2" action="{!! url('/customer/car')!!}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left input_mask customerAddForm">

	
                               <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback ">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="customer_id">{{ trans('Customers')}} <label class="color-danger">*</label></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									  <select class="form-control  select_customer" name="customer_id" required">
										<option value="customer_id">{{ trans('Select Customer ')}}</option>
											@foreach ($customer as $customers)
											<option value="{{ $customers->id }}">{{$customers->name }}</option>
											@endforeach
									  </select>
									  	
									</div>
								</div>
							<div class="col-md-12 col-sm-6 col-xs-12">  
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('manufacturing') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="manufacturing">{{ trans('app.Manufacturing Name') }} <label class="color-danger" >*</label></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text"  name="manufacturing" placeholder="{{ trans('app.Enter Manufacturing Name')}}"  class="form-control" >
										@if ($errors->has('manufacturing'))
											<span class="help-block">
												<strong>{{ $errors->first('manufacturing') }}</strong>
									   		</span>
										@endif
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('manufacturing_date') ? ' has-error' : '' }}" id='datetimepicker'>
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="manufacturing_date">{{ trans('app.Date Of Manufacturing:') }} <label class="color-danger">*</label> </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									
                                    <input type="text"  name="manufacturing_date" placeholder="{{ trans('app.Enter Manufacturing Date')}}"  class="form-control datetimepicker" >
									
                                    @if ($errors->has('manufacturing_date'))
									   <span class="help-block">
										   <strong>{{ $errors->first('manufacturing_date') }}</strong>
									   </span>
									  @endif
                                      
									</div>
								</div>	
							</div>

							<div class="col-md-12 col-sm-6 col-xs-12">  
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('registration') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="registration">{{ trans('app.Registration No.') }} <label class="color-danger" >*</label></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text"  name="registration" placeholder="{{ trans('app.Enter Registration Number')}}"  class="form-control" >
										@if ($errors->has('registration'))
											<span class="help-block">
												<strong>{{ $errors->first('registration') }}</strong>
									   		</span>
										@endif
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('chassis') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="chassis">{{ trans('app.Chassis') }} <label class="color-danger">*</label> </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text"  name="chassis" placeholder="{{ trans('app.Enter Chassis No.')}}"  class="form-control" >
									  @if ($errors->has('chassis'))
									   <span class="help-block">
										   <strong>{{ $errors->first('chassis') }}</strong>
									   </span>
									  @endif
									</div>
								</div>	
							</div>

							<div class="col-md-12 col-sm-6 col-xs-12">  
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('model') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="model">{{ trans('app.Model No') }} <label class="color-danger" >*</label></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text"  name="model" placeholder="{{ trans('app.Enter Model No')}}"  class="form-control">
										@if ($errors->has('model'))
											<span class="help-block">
												<strong>{{ $errors->first('model') }}</strong>
									   		</span>
										@endif
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('kilometers') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="kilometers">{{ trans('app.kilometers:') }} <label class="color-danger">*</label> </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text"  name="kilometers" placeholder="{{ trans('app.Enter kilometers number')}}"  class="form-control" >
									  @if ($errors->has('kilometers'))
									   <span class="help-block">
										   <strong>{{ $errors->first('kilometers') }}</strong>
									   </span>
									  @endif
									</div>
								</div>	
							</div>

							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-12 col-sm-12 col-xs-12 text-center">
									<a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
									<button type="submit" class="btn btn-success customerAddSubmitButton">{{ trans('app.Submit')}}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script>
$(function () {
    $('.datetimepicker').datetimepicker();
});	
</script>
						
 


@endsection