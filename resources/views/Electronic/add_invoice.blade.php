@extends('layouts.app')
@section('content')

<style>
	.select2-container {
		width: 100% !important;
	}
</style>

<!-- Code Start -->	
	<div class="right_col" role="main">
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
        </div>
		<div class="x_content">
		</div>
        <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="x_panel">
               		<div class="x_content">
                		<form method="post" id="form_add" action="{{ url('/invoiceStore') }}" enctype="multipart/form-data"  name="Form" class="form-horizontal upperform saleAddForm" >

                			<input type="hidden" name="paymentno" value="{{ $codepay }}">

							<div class="col-md-12 col-xs-12 col-sm-12">
				  				<h4><b>{{ trans('app.Invoice Details')}}</b></h4><hr>
							</div>

            		<div id="form_fields">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Invoice Number') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="invoice_number" value="{{ $code }}" disabled="disabled">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Customer Name') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="customer_name" value="{{getCustomerName($service->customer_id)}}">
										</div>
									</div>
                		</div>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Jobcard Number') }} <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $service->job_no }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Total Amount') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											Quotation No <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ getQuotationNumber($service->job_no) }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											CUSTOMER P.O NO: <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Invoice Date') }} <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">							
											<input type="date" name="invoice_date" class="form-control">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Discount (%)') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											Jon Open Date <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											DELIVERY DATE: <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input type="date" name="delivery_date" class="form-control">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											Tax <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											METERS READING (HAS/KM): <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											FLEET NUMBER: <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											REGISTRATION: <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											MANUFACTURER: <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											CHASSIS NO: <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">

									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Status') }} <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<select name="payment_status" class="form-control" required>
												<option value="">{{ trans('app.Select Payment Status') }}</option>
												<option value="1">{{ trans('app.Half Paid') }}</option>
												<option value="2">{{ trans('app.Full Paid') }}</option>
												<option value="0">{{ trans('app.Unpaid') }}</option>
											</select>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Payment Type') }} <label class="color-danger">*</label></label>	
					
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<select name="payment_type" class="form-control paymentType">
												<option value="">{{ trans('app.Select Payment Type') }}</option>
											@if(!empty($payments))
												@foreach($payments as $payment)
												<option value="{{$payment->id}}">{{ $payment->payment }}</option>
												@endforeach
											@endif
											</select>
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Paid Amount') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Grand Total') }} <label class="color-danger">*</label></label>						
										<div class="col-md-8 col-sm-8 col-xs-12 ">
											<input class="form-control" type="text" name="ahmed">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Branch') }} <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<select class="form-control  select_branch" name="branch" required="required">
												<option value="">Select Branch</option>
		                                  	@foreach ($branches as $branch)
		                                    	<option value="{{ $branch->id }}">{{$branch->branch_name }}</option>
		                                  	@endforeach
		                                	</select>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											Model <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
							
											<input type="hidden" name="paymentno" value="{{ $codepay }}">
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>

                		<?php  /*#################*/ ?>
                		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
											Details <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<textarea name="Details" class="form-control"></textarea>
										</div>
									</div>
                		</div>
                		<?php  /*#################*/ ?>	

				  			<input type="hidden" name="_token" value="{{csrf_token()}}">
                 
                  			<div class="form-group col-md-12 col-sm-12 col-xs-12">
                    			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                     				<a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                      				<button type="submit" class="btn btn-success submit submitButton" >{{ trans('app.Submit')}}</button>
                    			</div>
                  			</div>
                  		</form>
					</div>
				</div>                
          	</div>	
        </div>
    </div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\InvoiceAddEditFormRequest', '#form_add'); !!}


@endsection