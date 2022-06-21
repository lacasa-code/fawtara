@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- page content -->
	<div class="right_col" role="main">
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

				@can('customer_edit')
					<li role="presentation" class="active"><a href="{!! url('/customer/list/edit/'.$editid)!!}"><span class="visible-xs"></span><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i> <b>{{ trans('app.Edit Customer')}}</b></a></li>
				@endcan
				
				@if(getUserRoleFromUserTable(Auth::User()->id) == 'Customer')
					@if(!Gate::allows('customer_edit'))
						@can('customer_owndata')
							<li role="presentation" class="active"><a href="{!! url('/customer/list/edit/'.$editid)!!}"><span class="visible-xs"></span><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i> <b>{{ trans('app.Edit Customer')}}</b></a></li>
						@endcan
					@endif	
				@endif
            </ul>
		</div>
        <div class="clearfix"></div>
        @if ($errors->any())
		    @foreach ($errors->all() as $error)
		        <div>{{$error}}</div>
		    @endforeach
		@endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
						<form id="demo-form2" action="update/{{ $customer->id }}" method="post" 
					          enctype="multipart/form-data" class="form-horizontal form-label-left input_mask">
							<div class="col-md-12 col-xs-12 col-sm-12 space">
								<h4><b>{{ trans('app.Personal Information')}}</b></h4>
								<p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
							</div>

							<div class="col-md-12 col-sm-6 col-xs-12">  
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
										<label class="control-label col-md-4 col-sm-4 col-xs-12"  for="name">{{ trans('app.Name:')}} <label class="color-danger">*</label> </label>
										<div class="col-md-8 col-sm-8 col-xs-12">
									  		<input type="text" id="name" name="name" placeholder="{{ trans('app.Enter Customer Name')}}" value="{{$customer->name}}" class="form-control" maxlength="50">

										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('mail') ? ' has-error' : '' }}">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="mail">{{ trans('app.Email')}} <label class="color-danger lastname">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" id="mail"  name="mail" placeholder="{{ trans('app.Enter Email')}}" value="{{$customer->mail}}"class="form-control" maxlength="50">

										</div>
									</div>
							</div>
						



							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-12 col-sm-12 col-xs-12 text-center">
									<a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
									<button type="submit" class="btn btn-success updateCustomerButton">{{ trans('app.Update') }}</button>
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
<!-- Page content end -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- For form validation -->
{!! JsValidator::formRequest('App\Http\Requests\CustomerAddEditFormRequest', '#demo-form2'); !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection