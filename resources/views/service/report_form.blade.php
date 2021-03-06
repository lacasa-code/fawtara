@extends('layouts.app')
@section('content')
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <style>
        .jobcardmargintop{margin-top:9px;}
        .table>tbody>tr>td{padding:10px;vertical-align: unset!important;}
        .jobcard_heading{margin-left: 19px;margin-bottom: 15px}
        label{margin-bottom:0px;}
        .checkbox_padding{margin:10px 0px;}
        .first_observation{margin-left:23px;}
        .height{height:28px;}
        .all{width:226px;}
        .step1{color:#5A738E !important;}

        .bootstrap-datetimepicker-widget table td span {
            width: 0px!important;
        }
        .table-condensed>tbody>tr>td {
            padding: 3px;
        }

    </style>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; {{ trans('app.reportcar')}}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @if(session('message'))
            <div class="row massage">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="checkbox checkbox-success checkbox-circle">

                        <label for="checkbox-10 colo_success">  {{session('message')}} </label>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <ul class="nav nav-tabs bar_tabs tabconatent" role="tablist">
                        @can('reportcar_view')
                            <li role="presentation" class="suppo_llng_li floattab"><a href="{!! url('/reportcar/list')!!}"><span class="visible-xs"></span> <i class="fa fa-list fa-lg">&nbsp;</i>{{ trans('app.reportcar_List')}}</span></a></li>
                        @endcan
                        @can('service_add')

                        @endcan
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="well well-sm titleup">{{ trans('app.Step - 2 : Add Report Details...')}}</div><hr>
                            <form id="service2Step" method="post" action="{{ url('/service/add_reportcard') }}" enctype="multipart/form-data"  class="form-horizontal upperform vehicleAddForm">
                                <input type="hidden" class="service_id" name="service_id" value="{{ $service_data->id }}"/>


                                <div class="col-md-12 col-xs-12 col-xs-12">
                                    <div class="col-md-7 col-xs-12 col-sm-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" colspan="2" valign="top">
                                            <h3><?php echo $logo->system_name; ?></h3></td>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12 ">
                                            <div class="col-md-5 col-xs-12 col-sm-12 printimg">
                                                <img src="{{ url('/public/general_setting/'.$logo->logo_image) }}" width="200" height="70px" style="max-height: 80px;">
                                            </div>
                                            <div class="col-md-7 col-sm-12 col-xs-12 garrageadd" valign="top">
                                                <?php
                                                echo $logo->address." ";
                                                echo "<br>".getCityName($logo->city_id);
                                                echo ", ".getStateName($logo->state_id);
                                                echo ", ".getCountryName($logo->country_id);
                                                echo "<br>".$logo->email;
                                                echo "<br>".$logo->phone_number;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-12 col-sm-12">
                                        <div class="col-md-12 col-xs-12 col-sm-12">
                                            <label class="control-label jobcardmargintop col-md-4 col-sm-12 col-xs-12">{{ trans('app.reportcar_No')}} : <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                <input type="text" id="job_no" name="job_no" value="{{ getReportNumber($service_data->job_no) }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-4 col-sm-12 col-xs-12">{{ trans('app.In Date/Time')}} : <label class="color-danger">*</label></label>
                                            <div class="col-md-8 col-sm-12 col-xs-12 input-group date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input  type="text" id="in_date" name="in_date" value="<?php  echo date(getDateFormat().' H:i:s',strtotime($service_data->service_date));?>" class="form-control" placeholder="<?php echo getDateFormat();  echo " hh:mm:ss"?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12 my-form-group" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-4 col-sm-4 col-xs-12">{{ trans('app.Expected Out Date/Time')}} : <label class="color-danger">*</label> </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12 input-group date datepicker">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                                <input type="text" id="date_of_birth" autocomplete="off" name="out_date" class="form-control" placeholder="<?php echo getDatepicker();  echo " hh:mm:ss"?>" onkeypress="return false;" readonly required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 space1">
                                    <p class="col-md-12 col-xs-12 col-sm-12 space1_solid"></p>
                                </div>
                                <div class="col-md-12 col-xs-12 col-xs-12">
                                    <div class="col-md-4 col-xs-12 col-sm-12">
                                        <h2 class="text-left jobcard_heading">{{ trans('app.Customer Details')}}</h2>
                                        <p class="col-md-12 col-xs-12 col-sm-12 space1_solid"></p>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-3 col-sm-3 col-xs-12">{{ trans('app.Name')}}:</label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="hidden" name="cust_id" value="{{ $service_data->customer_id }}" >
                                                <input type="text" id="name" name="name" value="{{ getCustomerName($service_data->customer_id) }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-3 col-sm-3 col-xs-12">{{ trans('app.Address')}}: </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="address" value="{{ getCustomerAddress($service_data->customer_id) }}" name="address" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('app.Contact No')}}:</label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="con_no" name="con_no" value="{{ getCustomerMobile($service_data->customer_id) }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-3 col-sm-3 col-xs-12"> {{ trans('app.Email')}}: </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="email" name="email" value="{{ getCustomerEmail($service_data->customer_id) }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:5px;">
                                            <label class="control-label jobcardmargintop col-md-3 col-sm-3 col-xs-12"> {{ trans('app.Repair Category')}}: </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" id="repair_cat" name="erepair_cat" value="{{$service_data->service_category}}" class="form-control" disabled>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="col-md-8 col-sm-12 col-xs-12 vehicle_space">
                                        <h2 class="text-left jobcard_heading">{{ trans('app.Vehicle Details')}}</h2>
                                        <p class="col-md-12 col-xs-12 col-sm-12 space1_solid"></p>
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:5px;">
                                            <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Model Name')}}:</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="hidden" name="vehi_id" value="{{ $vehical->id }}">
                                                <input type="text" id="model" name="model" class="form-control" value="{{ $vehical->modelname }}" disabled>
                                            </div>
                                            <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Details')}}:</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="fuel" name="detail" class="form-control" value="{{$service_data->detail}}" readonly>
                                            </div>
                                            <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Fuel Ratio')}}:</label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="fuel" name="fuel" class="form-control" value="">
                                            </div>

                                            <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.KMS Run')}}:<label class="color-danger">*</label></label>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" id="fuel" name="kms" class="form-control" value="<?php if(!empty($job)){
                                                    echo"$job->kms_run"; } ?>">
                                            </div>
                                            @if(!empty($vehical->chassisno))
                                                <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Chasis No')}}:</label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="text" id="chassis" name="chassis" class="form-control" value="{{ $vehical->chassisno }}" disabled>
                                                </div>
                                            @endif

                                            @if(!empty($vehical->engineno))
                                                <label class="jobcardmargintop control-label col-md-2 col-sm-2 col-xs-12">{{ trans('app.Engine No')}}:</label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="text" id="engine_no" name="engine_no" class="form-control" value="{{ $vehical->engineno }}" disabled/>
                                                </div>
                                            @endif
                                        </div>


                                        <!----------------------------------------------------->
                                        @if(!empty($sale_date))
                                            <div class="col-md-12 col-sm-12 col-xs-12 divId" id="divId" style="margin-top:5px;" >

                                                <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Date Of Sale')}} :</label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="text" id="sales_date" name="sales_date" class="form-control" value="{{ date(getDateFormat(),strtotime($sale_date->date)) }}">
                                                </div>
                                            <!-- <label class="jobcardmargintop col-md-2 col-sm-2 col-xs-12">{{ trans('app.Color')}} :</label>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<input type="text" id="color" name="color" class="form-control" value="{{ $color->color }}" >
											</div> -->
                                            </div>
                                        @endif
                                        @if($washbay_price != null)
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:5px;">
                                                <label class="col-md-2 col-sm-2 col-xs-12">{{ trans('app.Wash Bay Charge')}}<label class="text-danger"></label>:</label>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <input type="text" id="washBay" name="washBayCharge" class="form-control" value="{{ $washbay_price->price }}" readonly>
                                                </div>
                                            </div>
                                        @endif

                                        <label class="jobcardmargintop control-label col-md-2 col-sm-2 col-xs-12">{{ trans('app.Fix Service Charge')}}:</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12 ">
                                            <input type="text" min='0' id="fltp" name=charge" value="{{$service_data->charge}}" maxlength="10" class="form-control kms kmsValid" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 space1">
                                    <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>

                                </div>
                                <!-- -->



                                <!-- -->
                                <!-- Vehical images  -->
                                <div class="col-md-6 col-sm-12 col-xs-12 form-group my-form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h2>{{ trans('app.Vehicle Images')}}</h2>
                                        <span> <h5 style="margin-left: 10px;"> {{ trans('app.Select Multiple Images')}} </h5> </span>
                                    </div>
                                    <div class="form-group col-md-10 col-sm-12 col-xs-12">
                                        <input type="file"  name="image[]"  class="form-control imageclass" id="images" onchange="preview_images();"  data-max-file-size="5M" multiple />

                                    </div>
                                    <div class="row classimage" id="image_preview"></div>

                                </div>

                                <!-- ************* MOT Module Starting ************* -->
                                <!-- ************* MOT Module Starting ************* -->
                                @if($service_data->mot_status == 1 )
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-9 col-sm-8 col-xs-8">
                                            <h3>{{ trans('app.MOT Test') }}</h3>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12 col-sm-12 panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse2" class="observation_Plus2" style="color:#5A738E"><i class=" glyphicon glyphicon-plus"></i> {{ trans('app.MOT Test View') }}</a>
                                                </h4>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">

                                                    <!-- Step:1 Starting -->
                                                    <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroup">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading pHeading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" href="#collapse3" class="observation_Plus3" style="color:#5A738E"><i class="plus-minus glyphicon glyphicon-plus"></i> {{ trans('app.Step 1: Fill MOT Details') }}</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse3" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroupInsideStep1">

                                                                        <div class="row text-center">
                                                                            <div class="col-md-3">
                                                                                <h5 class="boldFont">{{ trans('app.OK = Satisfactory') }}</h5>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <h5 class="boldFont">{{ trans('app.X = Safety Item Defact') }}</h5>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <h5 class="boldFont">{{ trans('app.R = Repair Required') }}</h5>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <h5 class="boldFont">{{ trans('app.NA = Not Applicable') }}</h5>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Inside Cab  Starting -->
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading pHeadingInsideStep1">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" href="#collapse5" class="observation_Plus3" style="color:#5A738E"><i class="plus-minus glyphicon glyphicon-plus"></i> {{ trans('app.Inside Cab') }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapse5" class="panel-collapse collapse">
                                                                                <div class="panel-body">


                                                                                    @php
                                                                                        $a = $b = '';
                                                                                        $count = count($inspection_points_library_data);
                                                                                        $count = $count/2;
                                                                                    @endphp

                                                                                    @foreach($inspection_points_library_data as $key => $inspection_library)

                                                                                        @if($inspection_library->inspection_type == 1)

                                                                                            @if( $key % 2 != 1 )
                                                                                                <?php
                                                                                                $a .= "<tr>
																		<td>$inspection_library->code</td>
																		<td>$inspection_library->point</td>
																		<td>
																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
																    		<option value='ok'>OK</option>
																    		<option value='x'>X</option>
																    		<option value='r'>R</option>
																    		<option value='na'>NA</option>
																  		</select>
																  		</td></tr>";
                                                                                                ?>
                                                                                            @else
                                                                                                <?php
                                                                                                $b .= "<tr>
																		<td>$inspection_library->code</td>
																		<td>$inspection_library->point</td>
																		<td>
																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common' id='$inspection_library->code'>
																    	<option value='ok'>OK</option>
																    	<option value='x'>X</option>
																    	<option value='r'>R</option>
																    	<option value='na'>NA</option>
																  		</select>
																  		</td>
																  		</tr>";
                                                                                                ?>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach

                                                                                    <div class="col-md-6">
                                                                                        <table class="table">
                                                                                            <thead class="thead-dark">
                                                                                            <tr>
                                                                                                <th><b>{{ trans('app.Code') }}</b></th>
                                                                                                <th><b>{{ trans('app.Inspection Details') }}</b></th>
                                                                                                <th><b>{{ trans('app.Answer') }}</b></th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <?php echo $a; ?>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <table class="table">
                                                                                            <thead class="thead-dark smallDisplayTheadHiddenInsideCab">
                                                                                            <tr>
                                                                                                <th><b>{{ trans('app.Code') }}</b></th>
                                                                                                <th><b>{{ trans('app.Inspection Details') }}</b></th>
                                                                                                <th><b>{{ trans('app.Answer') }}</b></th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <?php echo $b; ?>
                                                                                        </table>
                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Inside Cab  Ending -->


                                                                    </div>

                                                                    <!-- Ground Level and Under Vehicle  Starting -->
                                                                    <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroupInsideStep1">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading pHeadingInsideStep1">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" href="#collapse6" class="observation_Plus3" style="color:#5A738E"><i class="plus-minus glyphicon glyphicon-plus"></i> {{ trans('app.Ground Level and Under Vehicle') }}</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapse6" class="panel-collapse collapse">
                                                                                <div class="panel-body">
                                                                                    @php
                                                                                        $a = $b = '';
                                                                                        $count = count($inspection_points_library_data);
                                                                                        $count = $count/2;
                                                                                    @endphp

                                                                                    @foreach($inspection_points_library_data as $key => $inspection_library)

                                                                                        @if($inspection_library->inspection_type == 2)

                                                                                            @if( $key % 2 != 0 )
                                                                                                <?php
                                                                                                $a .= "<tr>
																		<td>$inspection_library->code</td>
																		<td>$inspection_library->point</td>
																		<td>
																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
																    		<option value='ok'>OK</option>
																    		<option value='x'>X</option>
																    		<option value='r'>R</option>
																    		<option value='na'>NA</option>
																  		</select>
																  		</td></tr>";
                                                                                                ?>
                                                                                            @else
                                                                                                <?php
                                                                                                $b .= "<tr>
																		<td>$inspection_library->code</td>
																		<td>$inspection_library->point</td>
																		<td>
																		<select name=inspection[$inspection_library->id] data-id='$inspection_library->id' class='common'  id='$inspection_library->code'>
																    	<option value='ok'>OK</option>
																    	<option value='x'>X</option>
																    	<option value='r'>R</option>
																    	<option value='na'>NA</option>
																  		</select>
																  		</td>
																  		</tr>";
                                                                                                ?>
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach

                                                                                    <div class="col-md-6">
                                                                                        <table class="table">
                                                                                            <thead class="thead-dark">
                                                                                            <tr>
                                                                                                <th><b>{{ trans('app.Code') }}</b></th>
                                                                                                <th><b>{{ trans('app.Inspection Details') }}</b></th>
                                                                                                <th><b>{{ trans('app.Answer') }}</b></th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <?php echo $a; ?>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <table class="table">
                                                                                            <thead class="thead-dark smallDisplayTheadHiddenGroundLevel">
                                                                                            <tr>
                                                                                                <th><b>{{ trans('app.Code') }}</b></th>
                                                                                                <th><b>{{ trans('app.Inspection Details') }}</b></th>
                                                                                                <th><b>{{ trans('app.Answer') }}</b></th>
                                                                                            </tr>
                                                                                            </thead>
                                                                                            <?php echo $b; ?>
                                                                                        </table>
                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Ground Level and Under Vehicle Ending -->

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Step 1: Ending -->

                                                    <!-- Step 2: Show Filled MOT Details Starting -->
                                                    <div class=" col-md-12 col-xs-12 col-sm-12 panel-group pGroup">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading pHeading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" href="#collapse4" class="observation_Plus3" style="color:#5A738E"><i class="plus-minus glyphicon glyphicon-plus"></i> {{ trans('app.Step 2: Show Filled MOT Details') }}</a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse4" class="panel-collapse collapse">
                                                                <div class="panel-body">

                                                                    <table class="table">
                                                                        <thead class="thead-dark">
                                                                        <tr>
                                                                            <th><b>{{ trans('app.Code') }}</b></th>
                                                                            <th><b>{{ trans('app.Inspection Details') }}</b></th>
                                                                            <th><b>{{ trans('app.Answer') }}</b></th>
                                                                        <tr>
                                                                        </thead>

                                                                        @foreach($inspection_points_library_data as $key => $value)
                                                                            <thead>
                                                                            <tr style="display: none;" id="tr_{{$value->id}}">
                                                                                <td id="">
                                                                                    {{ $value->id }}
                                                                                </td>
                                                                                <td id="">
                                                                                    {{ $value->point }}
                                                                                </td>
                                                                                <td id="row_{{$value->id}}" class="text-uppercase">  </td>
                                                                            </tr>
                                                                            </thead>
                                                                        @endforeach
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Step 2: Show Filled MOT Details Ending -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                            <!-- ************* MOT Module Ending ************* -->

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                                        <button type="submit" class="btn btn-success jobcardFormSubmitButton">{{ trans('app.Submit')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- model in observation Point -->
        <div class="col-md-12">
            <div id="responsive-modal-observation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close closeButton" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title">{{ trans('app.Observation Point')}}</h4>
                        </div>
                        <div class="modal-body">
                            @foreach($tbl_checkout_categories as $checkoout)

                                <?php
                                if (getDataFromCheckoutCategorie($checkoout->checkout_point,$checkoout->vehicle_id) != null) {
                                ?>
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse1-{{ $checkoout->id }}" class="ob_plus{{$checkoout->id }}"><i class="glyphicon glyphicon-plus"></i>{{ $checkoout->checkout_point }}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse1-{{ $checkoout->id }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <td><b>#</b></td>
                                                        <td><b>{{ trans('app.Checkpoints')}}</b></td>
                                                        <td><b>{{ trans('app.Choose')}}</b></td>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php

                                                    $i = 1;
                                                    $subcategory =getCheckPointSubCategory($checkoout->checkout_point,$checkoout->vehicle_id);
                                                    if(!empty($subcategory))
                                                    {
                                                    foreach($subcategory as $subcategorys)
                                                    { ?>

                                                    <tr class="id{{ $subcategorys->checkout_point }}">
                                                        <td class="col-md-1"><?php echo $i++; ?></td>

                                                        <td class="row{{ $subcategorys->checkout_point}} col-md-4">

                                                            <?php echo $subcategorys->checkout_point;
                                                            //echo $subcategorys->id;
                                                            ?>
                                                            <?php $data = getCheckedStatus($subcategorys->id,getServiceId($service_data->id))?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php echo $data;?> name="chek_sub_points" name="check_sub_points[]" check_id="{{ $subcategorys->id }}" class="check_pt" url="{!! url('service/select_checkpt')!!}"  s_id = "{{ getServiceId($service_data->id) }}"
                                                            >
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function(){
                                        var i = 0;
                                        $('.ob_plus{{$checkoout->id }}').click(function(){
                                            i = i+1;
                                            if(i%2!=0){
                                                $(this).parent().find(".glyphicon-plus:first").removeClass("glyphicon-plus").addClass("glyphicon-minus");
                                            }else{
                                                $(this).parent().find(".glyphicon-minus:first").removeClass("glyphicon-minus").addClass("glyphicon-plus");
                                            }
                                        });
                                    });
                                </script>

                                <?php } ?>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success col-md-offset-10 check_submit" style="margin-bottom:5px;" disabled="true">{{ trans('app.Submit')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->


    <!-- Scripts starting -->
    <!-- Display observation points in list -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script>
        $(document).ready(function()
        {

            $('.tbl_points, .check_submit').click(function(){

                var url = "<?php echo url('service/get_obs') ?>"
                var service_id = $('.service_id').val();

                $.ajax({
                    type: 'GET',
                    url: url,
                    data : {service_id:service_id},
                    success: function (response)
                    {
                        $('.main_data').html(response.html);
                        $('.modal').modal('hide');
                    },
                    error: function(e)
                    {
                        console.log(e);
                    }
                });
            });


            /*Checkpoints in modal*/
            var msg10 = "{{ trans('app.An error occurred :')}}";

            $('input.check_pt[type="checkbox"]').click(function(){

                if($(this).prop("checked") == true){
                    var value = 1;
                    var url = $(this).attr('url');
                    var id = $(this).attr('check_id');
                    var s_id = $(this).attr('s_id');

                    $('.check_submit').prop("disabled", false);
                    //$('.closeButton').prop("disabled", true);
                    $('.closeButton').attr( "disabled", "true" );
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data : {value:value,id:id,service_id:s_id},
                        success: function (response)
                        {

                        },
                        error: function(e)
                        {
                            alert(msg10 + " " + e.responseText);
                            console.log(e);
                        }
                    });
                }
                else if($(this).prop("checked") == false){

                    var value = 0;
                    var url = $(this).attr('url');
                    var id = $(this).attr('check_id');
                    var s_id = $(this).attr('s_id');

                    $('.check_submit').prop("disabled", false);
                    //$('.closeButton').prop("disabled", true);
                    $('.closeButton').attr( "disabled", "true" );

                    $.ajax({
                        type: 'GET',
                        url: url,
                        data : {value:value,id:id,service_id:s_id},
                        success: function (response)
                        {

                        },
                        error: function(e)
                        {
                            alert(msg10 + " " + e.responseText);
                            console.log(e);
                        }
                    });
                }
            });


            /*delete in script*/
            $('.sa-warning').click(function(){

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

            var i = 0;
            $('.observation_Plus').click(function(){
                i = i+1;
                if(i%2!=0){
                    $(this).parent().find(".glyphicon-minus:first").removeClass("glyphicon-minus").addClass("glyphicon-plus");

                }else{
                    $(this).parent().find(".glyphicon-plus:first").removeClass("glyphicon-plus").addClass("glyphicon-minus");
                }
            });

            var j = 0;
            $('.observation_Plus2').click(function(){
                j = j+1;
                if(j%2!=0){
                    $(this).parent().find(".glyphicon-plus:first").removeClass("glyphicon-plus").addClass("glyphicon-minus");

                }else{
                    $(this).parent().find(".glyphicon-minus:first").removeClass("glyphicon-minus").addClass("glyphicon-plus");
                }
            });


            /*This for Step:1 and Step:1 Accordion of MoT View*/
            $(function() {

                function toggleIcon(e) {
                    $(e.target)
                        .prev('.pHeading')
                        .find(".plus-minus")
                        .toggleClass('glyphicon-plus glyphicon-minus');
                }
                $('.pGroup').on('hidden.bs.collapse', toggleIcon);
                $('.pGroup').on('shown.bs.collapse', toggleIcon);
            });


            /*This for InsideCab and GroundLevelUnderVehicle Accordion*/
            $(function() {

                function toggleIcon(e) {
                    $(e.target)
                        .prev('.pHeadingInsideStep1')
                        .find(".plus-minus")
                        .toggleClass('glyphicon-plus glyphicon-minus');
                }
                $('.pGroupInsideStep1').on('hidden.bs.collapse', toggleIcon);
                $('.pGroupInsideStep1').on('shown.bs.collapse', toggleIcon);
            });


            /*For display data from 'InsideCab  And Ground Level Under Vehicle' accordion to Step:2 Accordion*/
            $('.common').change(function(e) {

                var selectBoxValue = $(this,':selected').val();
                var id = $(this).attr('data-id');

                if (selectBoxValue == "r" || selectBoxValue == "x") {
                    $('#tr_'+id).css("display","");
                    $('#row_'+id).html(selectBoxValue);
                }
                else
                {
                    $('#tr_'+id).css("display","none");
                }
            });


            /*datetime picker*/
            var startDate = $('#in_date').val();
            $('.datepicker').datetimepicker({
                format: "<?php echo getDatetimepicker(); ?>",
                autoclose: 1,
            }).datetimepicker('setStartDate', startDate);


            /*If date field have value then error msg and has error class remove*/
            $('#date_of_birth').on('change',function(){

                var pDateValue = $(this).val();

                if (pDateValue != null) {
                    $('#date_of_birth-error').css({"display":"none"});
                }

                if (pDateValue != null) {
                    $(this).parent().parent().removeClass('has-error');
                }
            });



            $('.clickAddNewButton').on('click',function(){

                $('.check_submit').prop("disabled", true);
                $('.closeButton').prop('disabled', false);
            });
            /*images show in multiple in for loop*/
            $(".imageclass").click(function(){
                $(".classimage").empty();
            });

            function preview_images()
            {
                var total_file=document.getElementById("images").files.length;

                for(var i=0;i<total_file;i++)
                {
                    $('#image_preview').append("<div class='col-md-3 col-sm-3 col-xs-12' style='padding:5px;'><img class='uploadImage' src='"+URL.createObjectURL(event.target.files[i])+"' width='100px' height='60px'> </div>");
                }
            }
            /*new image append*/
            $("#add_new_images").click(function()
            {
                var image_id = $("#tab_images > tbody > tr").length;
                var url = $(this).attr('url');
                var msg43 = "{{ trans('app.An error occurred :')}}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data : {image_id:image_id},
                    success: function (response)
                    {
                        $("#tab_images > tbody").append(response);
                        return false;
                    },
                    error: function(e) {
                        alert(msg43 + " " + e.responseText);
                        console.log(e);
                    }
                });
            });
            $('body').on('keyup', '.kmsValid', function(){

                var kmsVal = $(this).val();
                var rex = /^[0-9]*\d?(\.\d{1,2})?$/;

                if (!kmsVal.replace(/\s/g, '').length) {
                    $(this).val("");
                }
                if (kmsVal == 0) {
                    $(this).val("");
                }
                else if (!rex.test(kmsVal)) {
                    $(this).val("");
                }
            });
        });
    </script>

    <!-- Form field validation -->
    {!! JsValidator::formRequest('App\Http\Requests\StoreServiceSecondStepAddFormRequest', '#service2Step'); !!}
    <script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    <!-- Form submit at a time only one -->
    <script type="text/javascript">
        /*$(document).ready(function () {
            $('.jobcardFormSubmitButton').removeAttr('disabled'); //re-enable on document ready
        });
        $('.addJobcardForm').submit(function () {
            $('.jobcardFormSubmitButton').attr('disabled', 'disabled'); //disable on any form submit
        });

        $('.addJobcardForm').bind('invalid-form.validate', function () {
          $('.jobcardFormSubmitButton').removeAttr('disabled'); //re-enable on form invalidation
        });*/
    </script>

@endsection
