@extends('layouts.app')
@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </head>
<style>
	input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
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
											@if ($errors->has('name'))
									            <span class="help-block">
										            <strong>{{ $errors->first('name') }}</strong>
									            </span>
									        @endif
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('mail') ? ' has-error' : '' }}">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="mail">{{ trans('app.Email')}} <label class="color-danger lastname">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" id="mail"  name="mail" placeholder="{{ trans('app.Enter Email')}}" value="{{$customer->mail}}"class="form-control" maxlength="50">
											@if ($errors->has('mail'))
										        <span class="help-block">
											        <strong>{{ $errors->first('mail') }}</strong>
										        </span>
										@endif
										</div>
									</div>
							</div>
						    
							<div class="col-md-12 col-sm-6 col-xs-12">  
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
										<label class="control-label col-md-4 col-sm-4 col-xs-12"  for="address">{{ trans('app.Address')}} <label class="color-danger">*</label> </label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											  <textarea class="form-control addressTextarea" id="address" name="address" placeholder="{{ trans('Enter Customer Address')}}"  value="{{$customer->address}}">{{$customer->address}}</textarea>

											    @if ($errors->has('address'))
									                <span class="help-block">
										                <strong>{{ $errors->first('address') }}</strong>
									                </span>
									            @endif
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="phone">{{ trans('app.Mobile No')}} <label class="color-danger lastname">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" id="mob" class="mob" name="phone" placeholder="{{ trans('app.Enter Mobile No')}}" value="{{$customer->phone}}"class="form-control" maxlength="9" minlength="9">
											@if ($errors->has('phone'))
											<span class="help-block">
												<strong>{{ $errors->first('phone') }}</strong>
									   		</span>
										    @endif
										</div>
									</div>
							</div>
							
							@isset($cars)
							@foreach($cars as $cars)
							<div class="col-md-12 col-xs-12 col-sm-12 space">
								<h4><b>{{ trans('Car Information')}}</b></h4>
								<p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
							</div>

							<div class="col-md-12 col-sm-6 col-xs-12">  
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('manufacturing') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="manufacturing">{{ trans('app.Manufacturing Name') }} <label class="color-danger" >*</label></label>
									<div class="col-md-8 col-sm-8 col-xs-12">
										<input type="text"  name="manufacturing" placeholder="{{ trans('app.Enter Manufacturing Name')}}" value="{{$cars->manufacturing}}" class="form-control" >
										@if ($errors->has('manufacturing'))
											<span class="help-block">
												<strong>{{ $errors->first('manufacturing') }}</strong>
									   		</span>
										@endif
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group has-feedback {{ $errors->has('manufacturing_date') ? ' has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="manufacturing_date">{{ trans('app.Date Of Manufacturing:') }} <label class="color-danger">*</label> </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
									<input type="text"   name="manufacturing_date" placeholder="{{ trans('app.Enter Manufacturing Date')}}" value="{{$cars->manufacturing_date}}" class="date form-control " onkeypress="return false;" >
									

  
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
									
									<div class="col-md-4 col-sm-4 col-xs-12 {{$errors->has('reg_chars') ? ' has-error' : ''}}">
											<input type="text" name="reg_chars" class="form-control" id="reg_chars" placeholder="a b c" value="{{$cars->reg_chars}}">
											@if($errors->has('reg_chars'))
                                                <span class="help-block">
										               <strong>{{$errors->first('reg_chars')}}</strong>
									            </span>
                                            @endif
									</div>
									
									<div class="col-md-4 col-sm-8 col-xs-12 {{$errors->has('registration') ? ' has-error' : ''}}">
										<input type="text"  name="registration"  id="registration" placeholder="1 2 3" value="{{$cars->registration}}" class="form-control" >
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
									<input type="text"  name="chassis" placeholder="{{ trans('app.Enter Chassis No.')}}" value="{{$cars->chassis}}" class="form-control" >
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
										<input type="text"  name="model" placeholder="{{ trans('app.Enter Model No')}}" value="{{$cars->model}}"  class="form-control">
										@if ($errors->has('model'))
											<span class="help-block">
												<strong>{{ $errors->first('model') }}</strong>
									   		</span>
										@endif
									</div>
								</div>
									
							</div>
							@endforeach

							@endisset

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
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!-- For form validation -->
{!! JsValidator::formRequest('App\Http\Requests\CustomerAddEditFormRequest', '#demo-form2'); !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script>
	
	var max_chars = 9;
$(document).ready(function() {

$('#mob').keydown( function(e){
    if ($(this).val().length >= max_chars) { 
        $(this).val($(this).val().substr(0, max_chars));
    }
});

$('#mob').keyup( function(e){
    if ($(this).val().length >= max_chars) { 
        $(this).val($(this).val().substr(0, max_chars));
    }
});  


});  

$('.date').datepicker({  
	changeMonth: true,
      changeYear: true
     });  
$(document).ready(function() {
    
    $( "#reg_chars" ).keypress(function(e) {
                            var key = e.keyCode;
                            if (key >= 48 && key <= 57) {
                                e.preventDefault();
                            }
                        });

        $( "#manufacturing" ).keypress(function(e) {
                            var key = e.keyCode;
                            if (key >= 48 && key <= 57) {
                                e.preventDefault();
                            }
                        });    

                
});
</script>
@endsection