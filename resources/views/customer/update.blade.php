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
											<input type="number" id="mob" class="form-control" class="mob" name="phone" placeholder="{{ trans('app.Enter Mobile No')}}" value="{{$customer->phone}}"class="form-control" maxlength="9" minlength="9">
											@if ($errors->has('phone'))
											<span class="help-block">
												<strong>{{ $errors->first('phone') }}</strong>
									   		</span>
										    @endif
										</div>
									</div>
							</div>
							
							@isset($cars)
							
							@endisset

							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-12 col-sm-12 col-xs-12 text-center">
									<!--<a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>-->
									<button type="submit" class="btn btn-success updateCustomerButton">{{ trans('app.Update') }}</button>
								</div>
							</div>
						</form>
<hr>
						<div class="x_panel bgr">
						<div class="col-md-12 col-xs-12 col-sm-12 space">
								<h4><b>Cars Information</b></h4>
								<p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
							</div>
							<table  class="table datatable table-striped jambo_table" style="margin-top:20px; width:100%;">
								<thead>
									<tr>
										<th> Manufacturing Name </th>
										<th> Date Manufacturing </th>										
										<th> Registration </th>
										<th> Chassis </th>
										<th> Model </th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							@foreach($cars as $cars)
							<form method="get" action="/customer/car/update/{{ $cars->id }}">

								<tr>
								    <td>
									    <div class="{{$errors->has('manufacturing') ? ' has-error' : ''}}">
										<select class="form-control  select_manufacturing" name="manufacturing" id="manufacturing" value="$cars->manufacturing" required >
											<option value="mercedes" selected>mercedes</option>
										</select>
										@if ($errors->has('manufacturing'))
											<span class="help-block">
												<strong>{{ $errors->first('manufacturing') }}</strong>
									   		</span>
										@endif
										</div>
									</td>
									<td>
										<div class="{{$errors->has('manufacturing_date') ? ' has-error' : ''}}">
										<input type="text"   name="manufacturing_date" value="{{$cars->manufacturing_date}}" class="date form-control " onkeypress="return false;" >
										@if ($errors->has('manufacturing_date'))
										<span class="help-block">
											<strong>{{ $errors->first('manufacturing_date') }}</strong>
										</span>
										@endif
									</td>
									</div>
									<td>
										<div class=" {{$errors->has('reg_chars') ? ' has-error' : ''}}">
											<input type="text" name="reg_chars" class="form-control" id="reg_chars" placeholder="a b c" value="{{$cars->reg_chars}}">
											@if($errors->has('reg_chars'))
                                                <span class="help-block">
										               <strong>{{$errors->first('reg_chars')}}</strong>
									            </span>
                                            @endif
										</div>
										<div class="{{$errors->has('registration') ? ' has-error' : ''}}">
										<input type="text"  name="registration"  id="registration" placeholder="1 2 3" value="{{$cars->registration}}" class="form-control" >
										@if ($errors->has('registration'))
											<span class="help-block">
												<strong>{{ $errors->first('registration') }}</strong>
									   		</span>
										@endif
									</div>
									</td>
									<td>
										<div class="{{$errors->has('chassis') ? ' has-error' : ''}}">
										<input type="text"  name="chassis" placeholder="{{ trans('app.Enter Chassis No.')}}" value="{{$cars->chassis}}" class="form-control" >
										@if ($errors->has('chassis'))
										<span class="help-block">
											<strong>{{ $errors->first('chassis') }}</strong>
										</span>
										@endif
										</div>
									</td>
									<td>
										<div class="{{$errors->has('model') ? ' has-error' : ''}}">
										<select class="form-control  select_model" name="model" id="car"  value="{{$cars->model}}" required >
	     									<option value="{{$cars->model}}" >{{$cars->model}} </option>
    
     										<option value="A-Class" >A-Class </option>
											<option value="C-Class">C-Class</option>
											<option value="CLA-Class">CLA-Class</option>
											<option value="CLS-Class">CLS-Class</option>
											<option value="E-Class">E-Class</option>
											<option value="EQE">EQE</option>
											<option value="S-Class">S-Class</option>
											<option value="EQS">EQS</option>
											<option value="GLB-Class">GLB-Class</option>
											<option value="GLC-Class">GLC-Class</option>
											<option value="GLE-Class">GLE-Class</option>
											<option value="GLS-Class">GLS-Class</option>
											<option value="G-Class">G-Class</option>
											<option value="EQA">EQA</option>
											<option value="EQB">EQB</option>
											<option value="EQC">EQC</option>
											<option value="AMG SL">AMG SL</option>
											<option value="AMG GT">AMG GT</option>
											<option value="AMG GT 4-Door Coupé">AMG GT 4-Door Coupé</option>
											<option value="AMG One">AMG One</option>
											<option value="B-Class">B-Class</option>
											<option value="Citan Van">Citan Van</option>
											<option value="Viano">Viano</option>
											<option value="EQV">EQV</option>
											<option value="Vito">Vito</option>
											<option value="Citan">Citan</option>
											<option value="Sprinter">Sprinter</option>
											<option value="Metris">Metris</option>
											<option value="Arocs">Arocs</option>
											<option value="Atego">Atego</option>
											<option value="Actros">Actros</option>
											<option value="Econic">Econic</option>
											<option value="Unimog">Unimog</option>
											<option value="Zetros">Zetros</option>
											<option value="Citaro">Citaro</option>
											<option value="Tourismo">Tourismo</option>

										</select>
										
										@if ($errors->has('model'))
											<span class="help-block">
												<strong>{{ $errors->first('model') }}</strong>
									   		</span>
										@endif
						

									</div>
									</td>
									<td>
									<a  url="{!! url('/customer/car/delete/'.$cars->id)!!}" class="deletecustomers"> <button type="button" class="btn btn-round btn-danger">{{ trans('app.Delete')}}</button></a>
									<button type="submit" class="btn btn-round btn-success">{{ trans('app.Update') }}</button>
									</td>
									
								</tr>	</form>
                            @endforeach
					</div>					

                </div>
            </div>
        </div>
    </div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="css/yearpicker.css" />
<script src="js/yearpicker.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

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
format: "yyyy", viewMode: "years",
        minViewMode: "years",
    autoclose:true}); 
$(document).ready(function() {
	$('.select_manufacturing').select2();
		$('.select_model').select2();
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

	$('body').on('click', '.deletecustomers', function() 
		{		  	
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