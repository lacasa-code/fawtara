@extends('layouts.app')
@section('content')
<Style>

</style>

<!-- For Dashborad Page all parts to make proper border for this css  -->
<link type="text/css" href="{{ URL::asset('public/css/dashboard_page_all_part_styles.css') }}" rel="stylesheet" >

<!-- CSS For Chart -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/js/49/css/tooltip.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/js/49/css/util.css') }}">

<script src="{{ URL::asset('build/js/jscharts.js') }}" defer="defer"></script>
<!-- <script src="{{ URL::asset('build/js/Chart.min.js') }}" defer="defer"></script> -->
	<div class="right_col" role="main">
	<!--  Free service view -->
		<div id="myModal-open-modal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<a href=""><button type="button" class="close">&times;</button></a>
						<!-- <h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Free Service Details')}}</h4> -->
						<h4 id="myLargeModalLabel" class="modal-title">{{ __('Free Service Details')}}</h4>
					</div>
					<div class="modal-body">

					</div>
				</div>
			</div>
		</div>

	<!--  Paid service view -->
		<div id="myModal-com-service" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<a href=""><button type="button" class="close">&times;</button></a>
						<h4 id="myLargeModalLabel" class="modal-title">{{ trans('app.Paid Service Details')}}</h4>
					</div>
					<div class="modal-body">

					</div>
				</div>
			</div>
		</div>
	<!--  Repeat Job Service view -->
		<div id="myModal-serviceup" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg modal-xs">
		<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<a href=""><button type="button" class="close">&times;</button></a>
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
        <div class="page-title">

			<div class="nav_menu hidden-lg hidden-md" style="background-color: #2a3f54;">
				<nav>
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars" style="color:#fff;"></i></a>
							<span class="titleup"> <a href="{!! url('/')!!}"> <img src="{{ URL::asset('public/general_setting/'.getLogoSystem())}}" width="140px" height="45px" style="background-color: #2a3f54;" ></a>
							<!-- ( {{ trans('app.Dashboard')}} ) -->
							</span>

					</div>

					<ul class="nav navbar-nav navbar-right ulprofile">
						<li class="">
							<a href="javascript:;" class=" dropdown-toggle mobilefocus" data-toggle="dropdown" aria-expanded="false">
							@if(!empty(Auth::user()->id))
								@if(Auth::user()->role=='admin')
									<img src="{{ URL::asset('public/admin/'.Auth::user()->image)}}" alt="admin"  width="40px" height="40px" class="img-circle">
								@endif
								@if(Auth::user()->role=='Customer')
									<img src="{{ URL::asset('public/customer/'.Auth::user()->image)}}" alt="customer" width="40px" height="40px" class="img-circle">
								@endif

								@if(Auth::user()->role=='Supplier')
									<img src="{{ URL::asset('public/supplier/'.Auth::user()->image)}}" alt="supplier" width="40px" height="40px" class="img-circle">
								@endif

								@if(Auth::user()->role=='employee')
									<img src="{{ URL::asset('public/employee/'.Auth::user()->image)}}" alt="employee" width="40px" height="40px" class="img-circle">
								@endif

								@if(Auth::user()->role=='accountant')
									<img src="{{ URL::asset('public/accountant/'.Auth::user()->image)}}" alt="accountant" width="40px" height="40px" class="img-circle">
								@endif

								@if(Auth::user()->role=='supportstaff')
									<img src="{{ URL::asset('public/supportstaff/'.Auth::user()->image)}}" alt="supportstaff" width="40px" height="40px" class="img-circle">
								@endif
                                    @if(Auth::user()->role=='engineer')
                                        <img src="{{ URL::asset('public/engineer/'.Auth::user()->image)}}" alt="engineer" width="40px" height="40px" class="img-circle">
                                    @endif

								@if(Auth::user()->role=='branch_admin')
									<img src="{{ URL::asset('public/branch_admin/'.Auth::user()->image)}}" alt="branch_admin" width="40px" height="40px" class="img-circle">
								@endif

								@if(Auth::user()->role=='')
									<img src="{{ URL::asset('public/customer/'.Auth::user()->image)}}" alt="customer" width="40px" height="40px" class="img-circle">
								@endif
							@endif
							@if(!empty(Auth::user()->id))
								<span style="color:#fff;">{{ Auth::user()->name }}</span>
							@endif
								<span class="fa fa-angle-down" style="color:#fff;"></span>
							</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="{!!url('setting/profile')!!}"> {{ trans('app.Profile')}}</a></li>
									<!-- <?php $userid=Auth::User()->id;?>
										 @if (getAccessStatusUser('Settings',$userid)=='yes')
											@if(getActiveAdmin($userid)=='yes')
												<li> <a href="{!! url('setting/general_setting/list') !!}"><span>{{ trans('app.Settings')}}</span></a></li>
											@else
												<li> <a href="{!! url('setting/timezone/list') !!}"><span>{{ trans('app.Settings')}}</span></a></li>
											@endif
										@endif -->


										
									<li><a href="#" onclick="event.preventDefault();document.getElementById('logout-dash').submit();"><i class="fa fa-sign-out pull-right"></i> {{ trans('app.Log Out')}}</a></li>
									<form id="logout-dash" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
									</form>
								</ul>
						</li>
					</ul>
				</nav>
			</div>
			<div class="nav_menu hidden-xs hidden-sm">
				<nav>
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						<span class="titleup">{{ 'Fawtara' }} </span>

					</div>

					<ul class="nav navbar-nav navbar-right ulprofile">
						<li class="">
							<a href="javascript:;" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							
							@if(!empty(Auth::user()->id))
								{{ Auth::user()->name }}
							@endif
								<span class=" fa fa-angle-down"></span>
							</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="{!!url('setting/profile')!!}"> {{ trans('app.Profile')}}</a></li>
								<!-- <?php $userid=Auth::User()->id;?>
										 @if (getAccessStatusUser('Settings',$userid)=='yes')
											@if(getActiveAdmin($userid)=='yes')
												<li> <a href="{!! url('setting/general_setting/list') !!}"><span>{{ trans('app.Settings')}}</span></a></li>
											@else
												<li> <a href="{!! url('setting/timezone/list') !!}"><span>{{ trans('app.Settings')}}</span></a></li>
											@endif
										@endif -->

										

									<li><a href="#" onclick="event.preventDefault();document.getElementById('logout-dash1').submit();"><i class="fa fa-sign-out pull-right"></i> {{ trans('app.Log Out')}}</a></li>
									<form id="logout-dash1" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
									</form>
								</ul>
						</li>
					</ul>
				</nav>
			</div>
        </div>


    <!-- For Garage wizard steps start -->
        @if(getUsersRole(Auth::user()->role_id) != 'Customer' AND getUsersRole(Auth::user()->role_id) != 'Employee')
        @if($Customer == 0 || $employee == 0 || $have_supportstaff == 0 || $Supplier == 0 || $have_vehicle == 0 || $have_product == 0 || $have_observationCount == 0)
        
        
		
		@endif
		@endif


<!-- Active(login) in show admin , supportstaff,accountant -->
	@if(getUsersRole(Auth::user()->role_id) == 'Super Admin' || getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin'|| getUsersRole(Auth::user()->role_id) == 'Engineer')


		<div class="row calculationBoxes mainBoxClass">
		

			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
				<a href="customer/list" target="blank">
					<div class="panel info-box panel-white">
						<div class="panel-body staff-member">
						<img src="{{ URL::asset('public/img/dashboard/client.png')}}" class="dashboard_background" alt="">
							<div class="info-box-stats">
								<p class="counter">

								<?php 
									$count_p = App\Electronicinvoice::where('branch_id', Auth::user()->branch_id)
									                    ->whereNull('deleted_at')->where('final', 1)->count(); ?>

									    {{ $count_p }} 
														  </p>
									<span class="info-box-title"> Invoices </span>
							</div>


						</div>
					</div>
					</a>
			</div>

			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
				<a href="customer/list" target="blank">
					<div class="panel info-box panel-white">
						<div class="panel-body staff-member">
						<img src="{{ URL::asset('public/img/dashboard/client.png')}}" class="dashboard_background" alt="">
							<div class="info-box-stats">
								<p class="counter">

								<?php 
									$count_p = App\Electronicinvoice::where('branch_id', Auth::user()->branch_id)
									                    ->whereNull('deleted_at')->where('final', '!=', 1)->count(); ?>

									    {{ $count_p }} 
														  </p>
									<span class="info-box-title"> Jobs  </span>
							</div>


						</div>
					</div>
					</a>
			</div>

		</div>
	@endif

<!-- end Active(login) in show admin , supportstaff,accountant -->


<!-- Active(login) in show customer , employee -->
	@if(getUsersRole(Auth::user()->role_id) == 'Customer' || getUsersRole(Auth::user()->role_id) == 'Employee')

	
	@endif
<!-- end Active(login) in show customer , employee -->


<!--- Active(login) in show admin,supportstaff,accountant -->
	@if(getUsersRole(Auth::user()->role_id) == 'Super Admin' || getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin' || getUsersRole(Auth::user()->role_id) == 'Engineer')
		@can('dashboard_view')
		

    <!-- Monthly Service Summary -->
		

	<!-- Free service details -->
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-12">
				
			</div>

		 <!-- paid service -->
			<div class="col-md-4 col-xs-12 col-sm-12">
				
			</div>

		<!-- Repeat job service -->
			<div class="col-md-4 col-xs-12 col-sm-12">
				
			</div>
		</div>
		@endcan
	@endif
<!---end Active(login) in show admin,supportstaff,accountant-->

    </div>
	


 <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
 <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer="defer"></script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->

<!-- All Js file for Charts -->
<script type="text/javascript" src="{{ URL::asset('public/js/loader.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/49/loader.js') }}" defer="defer"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/49/jsapi_compiled_default_module.js') }}" defer="defer"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/49/jsapi_compiled_graphics_module.js') }}" defer="defer"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/49/jsapi_compiled_ui_module.js') }}" defer="defer"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/49/jsapi_compiled_corechart_module.js') }}" defer="defer"></script>

 <!-- service event in calendarevent -->
 <?php
$service_data_array=NULL;

 if(!empty($serviceevent))

	{
		foreach($serviceevent as $serviceevents)
		{
           # dd($serviceevents);
           # exit();

			$i=1;
			$n_start_date=date("Y-m-d", strtotime($serviceevents->service_date));
			$n_end_date=date("Y-m-d", strtotime($serviceevents->service_date));
			$sid=$serviceevents->job_no;
			$userid=Auth::User()->id;
			#dd($userid);
			#exit();
			if(!empty(getActiveCustomer($userid)=='yes' || getActiveEmployee($userid)=='yes'))
			{

				$view_data = getInvoiceStatus($serviceevents->job_no);

				if($view_data == "No")
				{
					$service_data_array[]=array('title'=>$serviceevents->job_no,
					'title1'=>$serviceevents->job_no,
					'dates'=>date(getDateFormat(),strtotime($serviceevents->service_date)),
					'customer'=>getCustomerName($serviceevents->customer_id),
					'vehicle'=>getVehicleName($serviceevents->vehicle_id),
					'plateno'=>getRegistrationNo($serviceevents->vehicle_id),
					'url'=> 'jobcard/list/'.$serviceevents->id,
					'start'=>$n_start_date,
					'end'=>$n_end_date,
					'color'=>'#f0ad4e',
					);
				}
				else
				{
					$service_data_array[]=array('title'=>$serviceevents->job_no,
					'title1'=>$serviceevents->job_no,
					'dates'=>date(getDateFormat(),strtotime($serviceevents->service_date)),
					'customer'=>getCustomerName($serviceevents->customer_id),
					'vehicle'=>getVehicleName($serviceevents->vehicle_id),
					'plateno'=>getRegistrationNo($serviceevents->vehicle_id),
					's_id'=>$serviceevents->id,
					'url1'=> 'dashboard/open-modal',
					'start'=>$n_start_date,
					'end'=>$n_end_date,
					'color'=>'#5FCE9B',
					);
				}

			}
			else
			{
				$view_data = getInvoiceStatus($serviceevents->job_no);
#########
				if($view_data == "No")
				{
					$service_data_array[]=array('title'=>$serviceevents->job_no,
					'title1'=>$serviceevents->job_no,
					'dates'=>date(getDateFormat(),strtotime($serviceevents->service_date)),
					'customer'=>getCustomerName($serviceevents->customer_id),
					'vehicle'=>getVehicleName($serviceevents->vehicle_id),
					'plateno'=>getRegistrationNo($serviceevents->vehicle_id),
					's_id'=>$serviceevents->id,
					'url11'=>'service/list/view',
					'start'=>$n_start_date,

					'end'=>$n_end_date,
					'color'=>'#f0ad4e',
					);
				}
				else
				{
					$service_data_array[]=array('title'=>$serviceevents->job_no,
					'title1'=>$serviceevents->job_no,
					'dates'=>date(getDateFormat(),strtotime($serviceevents->service_date)),
					'customer'=>getCustomerName($serviceevents->customer_id),
					'vehicle'=>getVehicleName($serviceevents->vehicle_id),
					'plateno'=>getRegistrationNo($serviceevents->vehicle_id),
					's_id'=>$serviceevents->id,
					'url1'=> 'dashboard/open-modal',
					'start'=>$n_start_date,
					'end'=>$n_end_date,
					'color'=>'#5FCE9B',
					);
				}
			}

		}

	}

	//Holiday Event
	if(!empty($holiday))
	{
		foreach($holiday as $holidays)
		{
			$i=1;
			$n_start_date=date("Y-m-d", strtotime($holidays->date));
			$n_end_date=date("Y-m-d", strtotime($holidays->date));
			$service_data_array[]=array('title'=>substr($holidays->title,0,10),
			'title1'=>$holidays->title,
			'dates'=>date(getDateFormat(),strtotime($holidays->date)),
			'description'=>$holidays->description,
			'customer'=>'Holiday',
			'vehicle'=>"",
			'plateno'=>"",
			'start'=>$n_start_date,
			'end'=>$n_end_date,
			'color'=>'#3a87ad',
			);
		}
	}
	if(!empty($service_data_array)) {
		$data1 = json_encode($service_data_array);
	}
	else{
		$data1=json_encode('0');
	}
?>


<!-- <script src="{{ URL::asset('public/js/Dashboard/Free_service.js') }}" ></script> -->
<!-- <script src="{{ URL::asset('public/js/Dashboard/Paid_service.js') }}" ></script> -->
<!-- <script src="{{ URL::asset('public/js/Dashboard/Repeat_Job_service.js') }}" ></script> -->
<!-- <script src="{{ URL::asset('public/js/Dashboard/Free_customer_model_service.js') }}" ></script> -->

<!-- Calendar Event in Dashboard-->
<script>
$(document).ready(function()
{

	$('#calendarevent').fullCalendar({
		height: 620,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		defaultDate: new Date(),
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		editable: true,
		toolkip:true,
		events: <?php  if(!empty($data1)){ echo $data1;} ?>,
		eventMouseover: function (data, event, view) {
			tooltip = '<div class="col-md-12 col-sm-12 col-xs-12 tooltiptopicevent" style="width:auto;height:auto;background:black;color:#fff;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;border-radius:5px;  line-height: 200%;">';
			// alert(data.vehicle);
			if(data.title1 != '')
				tooltip = tooltip + data.title1 ;
			if(data.dates != '')
				tooltip = tooltip + ' | ' + data.dates + '</br>' + ' ';
			if(data.customer != '')
				tooltip = tooltip  + data.customer;
			if(data.plateno != '')
				tooltip = tooltip + ' | ' + data.plateno;
			if(data.vehicle != '')
				tooltip = tooltip + ' | ' + data.vehicle;

			tooltip = tooltip + '</div>';

            $("body").append(tooltip);
            $(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltiptopicevent').fadeIn('500');
                $('.tooltiptopicevent').fadeTo('10', 1.9);
            }).mousemove(function (e) {
                $('.tooltiptopicevent').css('top', e.pageY + 10);
                $('.tooltiptopicevent').css('left', e.pageX + 20);
            });
		},
		eventMouseout: function (data, event, view) {
			$(this).css('z-index', 8);
			$('.tooltiptopicevent').remove();
		},
		dayClick: function () {
			tooltip.hide()
		},
		eventResizeStart: function () {
			tooltip.hide()
		},
		eventDragStart: function () {
			tooltip.hide()
		},
		viewDisplay: function () {
			tooltip.hide()
		},
		eventClick: function(event) {
			if (event.url) {
				window.location(event.url);
			}
			if (event.url1)
			{
				$('#myModal-job').modal();
				$('.modal-body').html("");
				var serviceid = (event.s_id);
				var url = (event.url1);

				$.ajax({
				   	type: 'GET',
				   	url: url,
				   	data : {open_id:serviceid},
				   	success: function (data)
					{
						$('.modal-body').html(data.html);
					},
					beforeSend:function(){
						$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
					},
					error: function(e) {
						alert("An error occurred: " + e.responseText);
						console.log(e);
					}
				});
			}
			if (event.url11)
			{
				$('#myModal-customer-modal').modal();
				$('.modal-body').html("");
				var servicesid = (event.s_id);
				var url = (event.url11);

				$.ajax({
				   	type: 'GET',
				   	url: url,
				   	data : {servicesid:servicesid},
				   	success: function (data)
				   	{
						$('.modal-body').html(data.html);
					},
					beforeSend:function(){
						$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
					},
					error: function(e) {
						alert("An error occurred: " + e.responseText);
						console.log(e);
					}
				});
			}
		}
    });


	/*Free service*/
	$(".openmodel").click(function(){

  		$('.modal-body').html("");
    	var open_id= $(this).attr("open_id");

		var url = $(this).attr('url');
   		$.ajax({
	       	type: 'GET',
	       	url: url,
		   	data : {open_id:open_id},
	       	success: function (data)
	       	{
		  		$('.modal-body').html(data.html);
			},

				beforeSend:function(){
				$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
			},

			error: function(e) {
				alert("An error occurred: " + e.responseText);
				console.log(e);
			}
   		});
   	});


	/*Paid service*/
	$(".completedservice").click(function(){

  		$('.modal-body').html("");

   		var c_service = $(this).attr("c_service");

		var url = $(this).attr('url');

   		$.ajax({
   			type: 'GET',
   			url: url,
   			data : {open_id:c_service},

   			success: function (data)
   			{
		  		$('.modal-body').html(data.html);
			},

				beforeSend:function(){
				$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
			},

			error: function(e) {
   				alert("An error occurred: " + e.responseText);
   				console.log(e);
			}
   		});
   	});



   	/*Repeat Job service*/
	$(".service-up").click(function(){

  		$('.modal-body').html("");

   		var u_service = $(this).attr("u_service");

		var url = $(this).attr('url');

   		$.ajax({
   			type: 'GET',
   			url: url,
   			data : {open_id:u_service},

   			success: function (data)
   			{
		  		$('.modal-body').html(data.html);
				},

				beforeSend:function(){
				$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
			},

			error: function(e) {
   				alert("An error occurred: " + e.responseText);
   				console.log(e);
			}
		});
   	});



	/*Free customer model service*/
	$(".customeropenmodel").click(function(){

  		$('.modal-body').html("");

    	var open_customer_id= $(this).attr("open_customer_id");
		var url = $(this).attr('url');

   		$.ajax({
   			type: 'GET',
   			url: url,
   			data : {servicesid:open_customer_id},

   			success: function (data)
   			{
		  		$('.modal-body').html(data.html);
			},

				beforeSend:function(){
				$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
			},

			error: function(e) {
				alert("An error occurred: " + e.responseText);
				console.log(e);
			}
   		});
	});



	/*if check wizard is displaying or hide*/
	var hideVal = $('.mainRowDiv').attr('isHide');

	if (hideVal == 1)
	{
		//Nothing to do
	}
	else
	{
		$('.mainBoxClass').removeClass('calculationBoxes');
	}

});
</script>


<script type="text/javascript">
 	/*Monthly service in barchart*/
 	google.load("visualization", "1", {packages:["corechart"]});
 	google.setOnLoadCallback(drawChart);

 	function drawChart()
 	{
 		var data = google.visualization.arrayToDataTable([
          	['Date', 'Service',{ role: 'style' },{ role: 'annotation' }],

		  	<?php
		     for($i=1;$i<=sizeof($dates);$i++)
			 {
				$count =  getNumberOfService($i);

			 ?>
			 ['<?php echo $i;?>',<?php echo $count;?>,'',''],
			<?php

			 }
		   	?>
 		]);

 		var options = {
			legend:'none',
			heigth:150,
			chartArea:{left:40,'width':'90%',top:20,bottom:50,},
			fontSize :10,
			color:'#73879C',
			hAxis: {
				title: 'Dates',
				titleTextStyle: {fontSize:12,color:'#4E5E6A',fontName: 'Roboto'},
			},
    		vAxis: {
				title: ' Number Of Service',
				titleTextStyle: {fontSize:12,color:'#4E5E6A',fontName: 'Roboto'},
				format:'decimal',
			},
 		};

 		var chart = new google.visualization.ColumnChart(document.getElementById("barchart"));
 		chart.draw(data, options);
 	}
 </script>

<!-- Ontime   donutchart-->
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {

        var data = google.visualization.arrayToDataTable([
          	['Hours', 'No of service'],
          	['24-Hours',<?php if(!empty($one_day)){echo $one_day;}else{echo"0";}?> ],
          	['48-Hours',<?php if(!empty($two_day)){echo $two_day;}else{echo"0";}?> ],
          	['48-Hours After',<?php if(!empty($more)){echo $more;}else{echo"0";}?> ],
        ]);

        var options = {
				fontSize:10,
				fontName:'sans-serif',
				height:150,
		 		chartArea:{left:1,right:2,bottom:30,top:30},
				legend: { position: 'right', maxLines: 5,textStyle: {fontSize: 10,color:'#73879C',bold:true}},
				isStacked: 'relative',
		 		vAxis: { minValue: 0, ticks: [0, .3, .6, .9, 1]}
        	};

        var chart = new google.visualization.PieChart(document.getElementById('donutchartontime'));
        chart.draw(data, options);
    }
</script>

<!-- Vehicle  donutchart-->
<script type="text/javascript">

    google.charts.load("current", {packages:["corechart"]});
   	google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          	['Vehicle', 'Number of service'],
		  	@foreach ($vehical as $vehicals)
			<?php $v_name = getVehicleName($vehicals->vid);?>
          ['<?php echo $v_name;?>',    <?php echo $vehicals->count;?> ],
         	@endforeach
        ]);

        var options = {
			is3D: true,
			fontSize:10,
			fontName:'sans-serif',
			height:150,
			chartArea:{left:3,right:3,bottom:30,top:10},
			legend: { position: 'right', maxLines: 5,textStyle: {fontSize: 10,color:'#73879C',bold:true}},
			isStacked: 'relative',
			vAxis: {
					minValue: 0,
					ticks: [0, .3, .6, .9, 1]
					}
			};

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

<!-- Performance  donutchart-->
<script type="text/javascript">

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable([
          			['Employee', 'No of service'],
           			@foreach ($performance as $performances)
						<?php $assigne=getAssignedName($performances->a_id); ?>
          				['<?php echo $assigne;?>',    <?php echo $performances->count;?> ],
         			@endforeach
        		]);

        var options = {
			is3D: true,
			fontSize:10,
			fontName:'sans-serif',
			height:180,
		 	chartArea:{left:5,right:5,bottom:5,top:15},
			legend: { position: 'right', maxLines: 15,textStyle: {fontSize: 12,padding:'5px',color:'#73879C',bold:true}},
			isStacked: 'relative',
		 	vAxis: {minValue: 0,ticks: [0, .3, .6, .9, 1]}
		};

        var chart = new google.visualization.PieChart(document.getElementById('donutchartperformance'));
        chart.draw(data, options);
    }
</script>

@endsection
