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
        <ul class="nav nav-tabs bar_tabs" role="tablist">
            @can('invoice_view')

            @endcan
            @can('invoice_add')

            @endcan
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form method="post" id="form_add" action="{{ url('/invoice/store/manual/invoice') }}" enctype="multipart/form-data" name="Form" class="form-horizontal upperform saleAddForm">
                        <div class="col-md-12 col-xs-12 col-sm-12 form-group my-form-group has-feedback">
                            <div class="col-md-2 col-sm-6 col-xs-12  ">
                                <h4><b>{{ trans('app.Invoice Details')}}</b></h4>
                                <hr>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12  ">
                                <select class="form-control  select_customer" name="customerlist" id="customerlist" required>
                                    <option value="" disabled selected>{{ trans('Select customers')}}</option>
                                    @foreach ($customers_list as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} / {{$customer->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12  ">
                                <select class="form-control  select_car" name="carlist" id="carlist" required>
                                    <option value="" disabled selected>{{ trans('Select Car')}}</option>
                                    <!--@foreach ($customers_list as $customer)
											   <option value="{{ $customer->id }}">{{ $customer->name }} / {{$customer->phone }}</option>
											@endforeach-->
                                </select>
                            </div>

                        </div>

                        <div id="form_fields">

                            <?php /* */ ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group" hidden>
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Customer id <br>{{ trans('الرقم التعريفي للعميل')}} <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" name="user_id" id="user_id" class="form-control" value="{{old('customer_id')}}">
                                    </div>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Vat Number: <br> الرقم الضريبى <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="vat_number" name="vat_number" value="{{$auth_branch_vat_number}}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Branch Name <br>{{ trans('اسم الفرع')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="branch_name" class="form-control" value="{{ $auth_branch->branch_name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <?php /* */ ?>

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Invoice Number') }} <br>{{ trans('رقم الفاتورة')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <input type="text" class="form-control" value="{{ '#'.Auth::user()->branch_id }}" readonly>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="Invoice_Number" class="form-control" value="{{ $code }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group{{$errors->has('Customer') ? 'error' : null}}">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Customer Name') }} <br>{{ trans('اسم الزبون')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12 ">
                                            <input type="text" name="Customer" id="name" class="form-control" value="{{old('Customer')}}" readonly>
                                            @if($errors->has('Customer'))
                                            <span class="help-block" style="color:red;">{{$errors->first('Customer')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php /* */ ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group {{$errors->has('customer_address') ? 'error' : null}}">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Customer Address <br>{{ trans('عنوان العميل')}}<label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="address" name="customer_address" class="form-control" value="{{old('customer_address')}}" readonly>
                                            @if($errors->has('customer_address'))
                                            <span class="help-block" style="color:red;">{{$errors->first('customer_address')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('customer_vat') ? 'error' : null}}">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            CUSTOMER VAT <br>{{ trans('رقم العميل الضريبى')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="customer_vat" class="form-control customer_vat" value="{{old('customer_vat')}}">
                                            @if($errors->has('customer_vat'))
                                            <span class="help-block" style="color:red;">{{$errors->first('customer_vat')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php /* */ ?>

                                <?php /* */ ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group {{$errors->has('customer_phone') ? 'error' : null}}">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Customer Phone <br>{{ trans('هاتف العميل')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-2 col-sm-8 col-xs-12">
                                            <input type="text" name="phone_code" class="form-control" value="+966" readonly>
                                        </div>
                                        <div class="col-md-6 col-sm-8 col-xs-12">
                                            <input type="text" id="phone" name="customer_phone" class="form-control" value="{{old('customer_phone')}}" readonly>
                                            @if($errors->has('customer_phone'))
                                            <span class="help-block" style="color:red;">{{$errors->first('customer_phone')}}</span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('customer_po_number') ? 'error' : null}}">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Customer P.O Num <br>{{ trans('رقم أمر الشراء')}} <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="customer_po_number" class="form-control" value="{{old('customer_po_number')}}">
                                            @if($errors->has('customer_po_number'))
                                            <span class="help-block" style="color:red;">{{$errors->first('customer_po_number')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
			                        	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
			                        		CUSTOMER Number <label class="color-danger">*</label></label>			
			                        	<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="customer_number" class="form-control customer_vat">
			                        	</div>
			                      	</div> -->
                                </div>
                                <?php /* */ ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group {{$errors->has('customer_address') ? 'error' : null}}">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group" id="job">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="job_card">{{ trans('app.Jobcard Number') }}<br>{{ trans('رقم امر العمل')}} <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="Job_card" class="form-control" value="{{old('Job_card')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('quotation_number') ? 'error' : null}}" id="job">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="job_card">
                                            Quotation Number <br>{{ trans('رقم العرض')}}
                                            <label class="color-danger">*</label></label>

                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="quotation_number" class="form-control" value="{{old('quotation_number')}}">
                                            @if($errors->has('quotation_number'))
                                            <span class="help-block" style="color:red;">{{$errors->first('quotation_number')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <?php /* */ ?>
                                    <!--	<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
										Customer P.O Num <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="customer_po_number" class="form-control">
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
			                        	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
			                        		Branch Name <label class="color-danger">*</label></label>			
			                        	<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="branch_name" class="form-control customer_vat">
			                        	</div>
			                      	</div> 
                				</div> -->
                                    <?php /* */ ?>

                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('meters_reading') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                KILO METERS: <br>{{ trans('قراءة العداد')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="meters_reading" class="form-control" value="{{old('meters_reading')}}">
                                                @if($errors->has('meters_reading'))
                                                <span class="help-block" style="color:red;">{{$errors->first('meters_reading')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('fleet_number') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Manufacturer : <br>{{ trans('المصنع ')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="fleet_number" id="manufacturing" class="form-control" value="{{old('fleet_number')}}" readonly>
                                                @if($errors->has('fleet_number'))
                                                <span class="help-block" style="color:red;">{{$errors->first('fleet_number')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <?php /* */ ?>

                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                REGISTRATION <br>{{ trans('رقم التسجيل:')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-4 col-sm-8 col-xs-12 {{$errors->has('reg_chars') ? 'error' : null}}">
                                                <input type="text" name="reg_chars" id="reg_chars" class="form-control" placeholder="a b c" value="{{old('reg_chars')}}" readonly>
                                                @if($errors->has('reg_chars'))
                                                <span class="help-block" style="color:red;">{{$errors->first('reg_chars')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 col-sm-8 col-xs-12 {{$errors->has('registeration') ? 'error' : null}}">
                                                <input type="text" name="registeration" id="registration" placeholder="1 2 3" class="form-control" value="{{old('registeration')}}" readonly>
                                                @if($errors->has('registeration'))
                                                <span class="help-block" style="color:red;">{{$errors->first('registeration')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('manufacturer') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Manufacturing Date: <br>{{ trans('تاريخ التصنيع')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="manufacturer" id="manufacturing_date" class="form-control" value="{{old('manufacturer')}}" readonly>
                                                @if($errors->has('manufacturer'))
                                                <span class="help-block" style="color:red;">{{$errors->first('manufacturer')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <?php /* */ ?>

                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('chassis_no') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Chassis No <br>{{ trans('رقم الهيكل')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="chassis_no" id="chassis" class="form-control" value="{{old('chassis_no')}}" readonly>
                                                @if($errors->has('chassis_no'))
                                                <span class="help-block" style="color:red;">{{$errors->first('chassis_no')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('model_name') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Model: <br>{{ trans('الطراز')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" name="model_name" id="model" class="form-control" value="{{old('model_name')}}" readonly>
                                                @if($errors->has('model_name'))
                                                <span class="help-block" style="color:red;">{{$errors->first('model_name')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <?php /* */ ?>

                                    <?php /* */ ?>
                                    <!--		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
										<label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
										Vehicle <label class="color-danger">*</label></label>
										<div class="col-md-8 col-sm-8 col-xs-12">
											<input type="text" name="vehicle" class="form-control">
										</div>
									</div>
                				</div> -->
                                    <?php /* */ ?>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Date">{{ trans('app.Invoice Date')}} <br>{{ trans('تاريخ الفاتورة')}} <label class="color-danger">*</label></label>

                                            <div class="col-md-8 col-sm-8 col-xs-12 input-group date datepicker">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" name="Date" autocomplete="off" id="date_of_birth" class="form-control invoiceDate" placeholder="<?php echo getDatepicker();?>" onkeypress="return false;" required value="{{old('Date')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group {{$errors->has('Discount') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Discount (%)') }} <br>{{ trans('الخصم')}} </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" maxlength="3" name="Discount" class="form-control discount" id="disc" value="{{old('Discount')}}">
                                                @if($errors->has('Discount'))
                                                <span class="help-block" style="color:red;">{{$errors->first('Discount')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <?php /*##################*/ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('Details') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Date">
                                                Job Open Date <br>{{ trans('تاريخ فتح الوظيفة')}} <label class="color-danger">*</label></label>

                                            <div class="col-md-8 col-sm-8 col-xs-12 input-group date datepicker">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" name="job_open_date" autocomplete="off" id="date_of_birth" class="form-control job_open_date" placeholder="<?php echo getDatepicker();?>" onkeypress="return false;" required value="{{old('job_open_date')}}">

                                            </div>
                                            @if($errors->has('job_open_date'))
                                            <span class="help-block" style="color:red;">{{$errors->first('job_open_date')}}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Date">
                                                Delivery Date <br>{{ trans('تاريخ التسليم او الوصول')}} <label class="color-danger">*</label></label>

                                            <div class="col-md-8 col-sm-8 col-xs-12 input-group date datepicker{{$errors->has('Details') ? 'error' : null}}">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" name="delivery_date" autocomplete="off" id="date_of_birth" class="form-control delivery_date" placeholder="<?php echo getDatepicker();?>" onkeypress="return false;" required value="{{old('delivery_date')}}">

                                            </div>
                                            @if($errors->has('delivery_date'))
                                            <span class="help-block" style="color:red;">{{$errors->first('delivery_date')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <?php /*##################*/?>


                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('Details') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                {{ trans('app.Details') }} <br>{{ trans('تفاصيل')}} <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea name="Details" class="form-control"></textarea>
                                                @if($errors->has('Details'))
                                                <span class="help-block" style="color:red;">{{$errors->first('Details')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <?php /* */ ?>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group" hidden>
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Status') }}<br>الحالة<label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <select name="Status" class="form-control paymentStatusSelect" required>
                                                    <option value="full paid" selected="">{{ trans('app.Full Paid') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paymentTypeMainDiv">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">{{ trans('app.Payment Type') }} <br> طريقة الدفع <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <select name="Payment_type" class="form-control paymentType">
                                                    <option value="">{{ trans('app.Select Payment Type') }} &nbsp;&nbsp; {{ 'اختر وسيلة الدفع' }}</option>
                                                    @if(!empty($tbl_payments))
                                                    @foreach($tbl_payments as $tbl_paymentss)
                                                    <option value="{{$tbl_paymentss->id}}">{{ $tbl_paymentss->payment }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group {{$errors->has('service_name.0') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Service Name <br>اسم الخدمة<label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="service_name" name="service_name[]" class="form-control" value="{{old('service_name.0')}}">
                                                @if($errors->has('service_name.0'))
                                                <span class="help-block" style="color:red;">{{$errors->first('service_name.0')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('service_value.0') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Value: <br> قيمة الخدمة<label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="service_value" name="service_value[]" class="form-control" value="{{old('service_value.0')}}">
                                                @if($errors->has('service_value.0'))
                                                <span class="help-block" style="color:red;">{{$errors->first('service_value.0')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <?php /* qty field */ ?>

                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('qty.0') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Qty: <br> الكمية <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="qty" name="qty[]" class="form-control" value="{{old('qty.0')}}">
                                                @if($errors->has('qty.0'))
                                                <span class="help-block" style="color:red;">{{$errors->first('qty.0')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <?php /* qty field */ ?>
                                    </div>
                                    <?php /* */ ?>

                                    <?php /* */ ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Service Name <br>اسم الخدمة<label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="service_name" name="service_name[]" class="form-control" value="{{old('service_name.1')}}">
                                                <?php /*		@if($errors->has('service_name.1'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_name.1')}}</span>
                        @endif */ ?>
                                            </div>
                                        </div>

                                        <?php /*<div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('service_value.1') ? 'error' : null}}"> */ ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Value: <br> قيمة الخدمة<label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="service_value" name="service_value[]" class="form-control" value="{{old('service_value.1')}}">
                                                <?php /*	@if($errors->has('service_value.1'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_value.1')}}</span>
                        @endif */ ?>
                                            </div>
                                        </div>

                                        <?php /* qty field */ ?>

                                        <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('qty.1') ? 'error' : null}}">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                                Qty: <br> الكمية <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="qty" name="qty[]" class="form-control" value="{{old('qty.1')}}">
                                                @if($errors->has('qty.1'))
                                                <span class="help-block" style="color:red;">{{$errors->first('qty.1')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <?php /* qty field */ ?>
                                    </div>

                                </div>
                                <?php /* */ ?>

                                <?php /* */ ?>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Service Name <br>اسم الخدمة<label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="service_name" name="service_name[]" class="form-control" value="{{old('service_name.2')}}">
                                            <?php /*	@if($errors->has('service_name.2'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_name.2')}}</span>
                        @endif */ ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Value: <br> قيمة الخدمة<label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="service_value" name="service_value[]" class="form-control" value="{{old('service_value.2')}}">
                                            <?php /*		@if($errors->has('service_value.2'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_value.2')}}</span>
                        @endif */ ?>
                                        </div>
                                    </div>

                                    <?php /* qty field */ ?>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('qty.2') ? 'error' : null}}">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                            Qty: <br> الكمية <label class="color-danger">*</label></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="qty" name="qty[]" class="form-control" value="{{old('qty.2')}}">
                                            <?php /*				@if($errors->has('qty.2'))
                        <span class="help-block" style="color:red;">{{$errors->first('qty.2')}}</span>
                        @endif */ ?>
                                        </div>
                                    </div>

                                    <?php /* qty field */ ?>
                                </div>
                            </div>
                            <?php /* */ ?>

                            <?php /* */ ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Service Name <br>اسم الخدمة<label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="service_name" name="service_name[]" class="form-control" value="{{old('service_name.3')}}">
                                        <?php /*	@if($errors->has('service_name.3'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_name.3')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Value: <br> قيمة الخدمة<label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="service_value" name="service_value[]" class="form-control" value="{{old('service_value.3')}}">
                                        <?php /*	@if($errors->has('service_value.3'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_value.3')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <?php /* qty field */ ?>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('qty.3') ? 'error' : null}}">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Qty: <br> الكمية <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="qty" name="qty[]" class="form-control" value="{{old('qty.3')}}">
                                        <?php /*				@if($errors->has('qty.3'))
                        <span class="help-block" style="color:red;">{{$errors->first('qty.3')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <?php /* qty field */ ?>
                            </div>

                            <?php /* */ ?>

                            <?php /* */ ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Service Name <br>اسم الخدمة<label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="service_name" name="service_name[]" class="form-control" value="{{old('service_name.4')}}">
                                        <?php /*			@if($errors->has('service_name.4'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_name.4')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Value: <br> قيمة الخدمة<label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="service_value" name="service_value[]" class="form-control" value="{{old('service_value.4')}}">
                                        <?php /*	@if($errors->has('service_value.4'))
                        <span class="help-block" style="color:red;">{{$errors->first('service_value.4')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <?php /* qty field */ ?>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group my-form-group paidAmountMainDiv {{$errors->has('qty.4') ? 'error' : null}}">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cus_name">
                                        Qty:<br> الكمية <label class="color-danger">*</label></label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" id="qty" name="qty[]" class="form-control" value="{{old('qty.4')}}">
                                        <?php /*		@if($errors->has('qty.4'))
                        <span class="help-block" style="color:red;">{{$errors->first('qty.4')}}</span>
                        @endif */ ?>
                                    </div>
                                </div>

                                <?php /* qty field */ ?>
                            </div>

                        </div>
                        <?php /* */ ?>



                </div>
            </div>

            <!-- Start Custom Field, (If register in Custom Field Module)  -->
            @if(!empty($tbl_custom_fields))
            <div class="col-md-12 col-xs-12 col-sm-12 space">
                <h4><b>{{ trans('app.Custom Fields')}}</b></h4>
                <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
            </div>
            <?php
									$subDivCount = 0;
								?>
            @foreach($tbl_custom_fields as $myCounts => $tbl_custom_field)
            <?php 
									if($tbl_custom_field->required == 'yes')
									{
										$required="required";
										$red="*";
									}else{
										$required="";
										$red="";
									}

									$subDivCount++;
								?>
            @if($myCounts%2 == 0)
            <div class="col-md-12 col-sm-6 col-xs-12">
                @endif
                <div class="form-group col-md-6 col-sm-6 col-xs-12 error_customfield_main_div_{{$myCounts}}">

                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account-no">{{$tbl_custom_field->label}} <label class="color-danger">{{$red}}</label></label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        @if($tbl_custom_field->type == 'textarea')
                        <textarea name="custom[{{$tbl_custom_field->id}}]" class="form-control textarea_{{$tbl_custom_field->id}} textarea_simple_class common_simple_class common_value_is_{{$myCounts}}" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" maxlength="100" isRequire="{{$required}}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" {{$required}}></textarea>

                        <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display: none"></span>
                        @elseif($tbl_custom_field->type == 'radio')

                        <?php
													$radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id)
												?>
                        @if(!empty($radioLabelArrayList))
                        <div style="margin-top: 5px;">
                            @foreach($radioLabelArrayList as $k => $val)
                            <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}]" value="{{$k}}" <?php if($k == 0) {echo "checked"; } ?>>{{$val}} &nbsp;
                            @endforeach
                        </div>
                        @endif
                        @elseif($tbl_custom_field->type == 'checkbox')

                        <?php
													$checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id);
													$cnt = 0;
												?>

                        @if(!empty($checkboxLabelArrayList))
                        <div class="required_checkbox_parent_div_{{$tbl_custom_field->id}}" style="margin-top: 5px;">
                            @foreach($checkboxLabelArrayList as $k => $val)
                            <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}][]" value="{{$val}}" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{$tbl_custom_field->id}}" class="checkbox_{{$tbl_custom_field->id}} required_checkbox_{{$tbl_custom_field->id}} checkbox_simple_class common_value_is_{{$myCounts}} common_simple_class" rows_id="{{$myCounts}}"> {{ $val }} &nbsp;
                            <?php $cnt++; ?>
                            @endforeach
                            <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display: none"></span>
                        </div>
                        <input type="hidden" name="checkboxCount" value="{{$cnt}}">
                        @endif
                        @elseif($tbl_custom_field->type == 'textbox')
                        <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}]" class="form-control textDate_{{$tbl_custom_field->id}} textdate_simple_class common_value_is_{{$myCounts}} common_simple_class" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" maxlength="30" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" {{ $required }}>

                        <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display:none"></span>
                        @elseif($tbl_custom_field->type == 'date')
                        <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}]" class="form-control textDate_{{$tbl_custom_field->id}} date_simple_class common_value_is_{{$myCounts}} common_simple_class" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" maxlength="30" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" {{ $required }} onkeydown="return false">

                        <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display:none"></span>

                        @endif

                    </div>
                </div>
                @if($myCounts%2 != 0)
            </div>
            @endif
            @endforeach

            <?php 
									if ($subDivCount%2 != 0) {
										echo "</div>";
									}
								?>
            @endif
            <!-- End Custom Field -->

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                    <button type="submit" class="btn btn-success submit submitButton">{{ trans('app.Submit')}}</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
