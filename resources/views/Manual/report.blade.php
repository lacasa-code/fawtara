@extends('layouts.app')
@section('content')
<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
				<a href="customer/list" target="blank">
					<div class="panel info-box panel-white">
						<div class="panel-body staff-member">
						<img src="{{ URL::asset('public/img/dashboard/client.png')}}" class="dashboard_background" alt="">
							<div class="info-box-stats">
								<p class="counter">


									    {{ $report }} 
														  </p>
									<span class="info-box-title"> Invoices </span>
							</div>


						</div>
					</div>
					</a>
			</div>
@endsection