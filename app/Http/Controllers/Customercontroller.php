<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use Mail;
use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Car;
use App\Customer;
use App\Http\Requests\CustomerAddEditFormRequest;

class Customercontroller extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	//customer addform
	public function customeradd()
	{	
		//$country = DB::table('tbl_countries')->get()->toArray();
		//$onlycustomer = DB::table('users')->where([['role','=','Customer'],['id','=',Auth::User()->id]])->first();

		//$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','customer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

	   return view('customer.add');
	}
	public function store(CustomerAddEditFormRequest $request)
	{
		
		$name = $request->name;
		$address = $request->address;
		$phone = $request->phone;
		$mail = $request->mail;
		$manufacturing = $request->manufacturing;
		$registration = $request->registration;
		$manufacturing_date = $request->manufacturing_date;
		$chassis = $request->chassis;
		$model = $request->model;
		$kilometers = $request->kilometers;



		if(!empty($mail))
		{
			$mail = $mail;
		}else{
			$mail = null;
		}
		
		$customer = new Customer;
		$customer->name = $name;
		$customer->phone = $phone;
		$customer->mail = $mail;
		$customer->address = $address;
        
		$customer->save();

		$car = new Car;
		$car->manufacturing = $manufacturing;
		$car->registration = $registration;
		$car->manufacturing_date = $manufacturing_date;
		$car->chassis = $chassis;
		$car->model = $model;
		$car->kilometers = $kilometers;
		$car->customer_id=$customer->id;
		$car->save();
			
		return redirect('/customer/list')->with('message','Successfully Submitted');
	}

	//customer list
	public function index()
	{    
		if (!isAdmin(Auth::User()->role_id)) {
			
			if (getUsersRole(Auth::user()->role_id) == 'Customer')
			{
				if (Gate::allows('customer_owndata')) 
				{
					$customer = User::where([['role','=','Customer'],['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->get();
				}
				else
				{
					$customer = User::where([['role','=','Customer'],['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->get();
				}
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Employee')
			{
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
				$new_customer=Customer::get();

			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
				$new_customer=Customer::get();

			}
			else
			{
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
				$new_customer=Customer::get();

			}
		}
		else
		{
			$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
			$new_customer=Customer::get();
  
		}

		return view('customer.list',compact('customer','new_customer'));
	}
	
	//customer show
	public function customershow($id)
	{	
		$viewid = $id;
		$userid = Auth::User()->id;

		if (!isAdmin(Auth::User()->role_id))
		{
			if (getUsersRole(Auth::user()->role_id) == 'Customer')
			{
				$customer = User::where('id','=',$id)->first();
				
				//$tbl_custom_fields = CustomField::where([['form_name','=','customer'],['always_visable','=','yes']])->get();				
				
				
				$new_customer = Customer::where('customers.id','=',$id)
				->join('cars','cars.customer_id' ,'customers.id')
				->first();
				/*$freeservice = Service::
			                            where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','free']])
										->where('tbl_services.customer_id','=',$id)
										->orderBy('tbl_services.id','desc')->take(5)
										->select('tbl_services.*')
										->get();

				$paidservice = Service::
			                            where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','paid']])
										->where('tbl_services.customer_id','=',$id)
										->orderBy('tbl_services.id','desc')->take(5)
										->select('tbl_services.*')
										->get();								
			
				$repeatjob = Service::
									where([['tbl_services.done_status','!=',2],['tbl_services.service_category','=','repeat job']])
										->where('tbl_services.customer_id','=',$id)
									   ->orderBy('tbl_services.id','desc')->take(5)
										->select('tbl_services.*')
										->get();*/
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Employee') 
			{			
				$customer = DB::table('users')->where('id','=',$id)->first();
				$new_customer = Customer::where('customers.id','=',$id)
				->join('cars','cars.customer_id' ,'customers.id')
				->first();
		
				//$tbl_custom_fields = CustomField::where([['form_name','=','customer'],['always_visable','=','yes']])->get();
			
				/*$freeservice = Service::
		                            where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','free']])
									->where('tbl_services.assign_to','=',$userid)
									->where('tbl_services.customer_id','=',$id)
									->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();
							
				$paidservice = Service::
		                            where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','paid']])
									->where('tbl_services.assign_to','=',$userid)
									->where('tbl_services.customer_id','=',$id)
									->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();

				$repeatjob = Service::
									where([['tbl_services.done_status','!=',2],['tbl_services.service_category','=','repeat job']])
									->where('tbl_services.assign_to','=',$userid)
									->where('tbl_services.customer_id','=',$id)
								   ->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();*/
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				
				$customer = User::where('id','=',$id)->first();
				$new_customer = Customer::where('customers.id','=',$id)
				->join('cars','cars.customer_id' ,'customers.id')
				->first();
				//$tbl_custom_fields = CustomField::where([['form_name','=','customer'],['always_visable','=','yes']])->get();												

				/*$freeservice = Service::
										where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','free']])
										->where('tbl_services.customer_id','=',$id)
										->orderBy('tbl_services.id','desc')->take(5)
										->select('tbl_services.*')
										->get();

				$paidservice = Service::
									where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','paid']])
									->where('tbl_services.customer_id','=',$id)
									->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();			

				$repeatjob = Service::
									where([['tbl_services.done_status','!=',2],['tbl_services.service_category','=','repeat job']])
									->where('tbl_services.customer_id','=',$id)
								   ->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();*/
			}
		}
		else
		{
			$customer = User::where('id','=',$id)->first();
		
			//$tbl_custom_fields = CustomField::where([['form_name','=','customer'],['always_visable','=','yes']])->get();												
			$new_customer = Customer::where('customers.id','=',$id)
			->join('cars','cars.customer_id' ,'customers.id')
			->first();
			/*$freeservice = Service::
										where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','free']])
										->where('tbl_services.customer_id','=',$id)
										->orderBy('tbl_services.id','desc')->take(5)
										->select('tbl_services.*')
										->get();
			
			$paidservice = Service::
									where([['tbl_services.done_status','!=',2],['tbl_services.service_type','=','paid']])
									->where('tbl_services.customer_id','=',$id)
									->orderBy('tbl_services.id','desc')->take(5)
									->select('tbl_services.*')
									->get();

			$repeatjob = Service::
								where([['tbl_services.done_status','!=',2],['tbl_services.service_category','=','repeat job']])
								->where('tbl_services.customer_id','=',$id)
								->orderBy('tbl_services.id','desc')->take(5)
								->select('tbl_services.*')
								->get();*/
		}
		
		return view('customer.view',compact('customer','new_customer','viewid'));
	}
	
	// free service modal
	public function free_open_model(Request $request)
	{
		//$serviceid = Input::get('f_serviceid');
		$serviceid = $request->f_serviceid;
		
		$tbl_services = DB::table('tbl_services')->where('id','=',$serviceid)->first();
			
		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;
		
		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id','=',$s_id)->first();
		
		$job = DB::table('tbl_jobcard_details')->where('service_id','=',$serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id','=',$v_id)->first();
		
		$vehical = DB::table('tbl_vehicles')->where('id','=',$v_id)->first();
		
		$customer = DB::table('users')->where('id','=',$c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',0)
												  ->get()->toArray();
		
		$service_pro2 = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',1)->get()->toArray();
				
		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id','=',$serviceid)->get()->toArray();
		
		$service_tax = DB::table('tbl_invoices')->where('sales_service_id','=',$serviceid)->first();
		if(!empty($service_tax->tax_name))
		{
			$service_taxes = explode(', ', $service_tax->tax_name);
		}
		else
		{
			$service_taxes = '';
		}
		
		$discounts = 0;
		if (!empty($service_tax->discount))
		{
			$discounts = $service_tax->discount;
		}

		$logo = DB::table('tbl_settings')->first();
		
		$html = view('customer.freeservice')->with(compact('serviceid','tbl_services','sales','logo','job','s_date','vehical','customer','service_pro','service_pro2','tbl_service_observation_points','service_tax','discounts','service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);	
	}
	
	// paid service modal
	public function paid_open_model(Request $request)
	{
		//$serviceid = Input::get('p_serviceid');
		$serviceid = $request->p_serviceid;

		$tbl_services = DB::table('tbl_services')->where('id','=',$serviceid)->first();
		
		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;
		
		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id','=',$s_id)->first();
		
		$job = DB::table('tbl_jobcard_details')->where('service_id','=',$serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id','=',$v_id)->first();
		
		$vehical = DB::table('tbl_vehicles')->where('id','=',$v_id)->first();
		
		$customer = DB::table('users')->where('id','=',$c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',0)
												  ->where('chargeable','=',1)
												  ->get()->toArray();
		
		$service_pro2 = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',1)->get()->toArray();
				
		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id','=',$serviceid)->get()->toArray();
		
		$service_tax = DB::table('tbl_invoices')->where('sales_service_id','=',$serviceid)->first();
		if(!empty($service_tax->tax_name))
		{
			$service_taxes = explode(', ', $service_tax->tax_name);
		}
		else
		{
			$service_taxes = '';
		}
		
		$discount = $service_tax->discount;
		$logo = DB::table('tbl_settings')->first();
		
		$html = view('customer.paidservice')->with(compact('serviceid','tbl_services','sales','logo','job','s_date','vehical','customer','service_pro','service_pro2','tbl_service_observation_points','service_tax','discount','service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);	
	}
   
	// repeat service modal
	public function repeat_job_model(Request $request)
	{
		//$serviceid = Input::get('r_service');
		$serviceid = $request->r_service;

		$tbl_services = DB::table('tbl_services')->where('id','=',$serviceid)->first();
			
		$c_id = $tbl_services->customer_id;
		$v_id = $tbl_services->vehicle_id;
		
		$s_id = $tbl_services->sales_id;
		$sales = DB::table('tbl_sales')->where('id','=',$s_id)->first();
		
		$job = DB::table('tbl_jobcard_details')->where('service_id','=',$serviceid)->first();
		$s_date = DB::table('tbl_sales')->where('vehicle_id','=',$v_id)->first();
		
		$vehical = DB::table('tbl_vehicles')->where('id','=',$v_id)->first();
		
		$customer = DB::table('users')->where('id','=',$c_id)->first();
		$service_pro = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',0)
												  ->get()->toArray();
		
		$service_pro2 = DB::table('tbl_service_pros')->where('service_id','=',$serviceid)
												  ->where('type','=',1)->get()->toArray();
				
		$tbl_service_observation_points = DB::table('tbl_service_observation_points')->where('services_id','=',$serviceid)->get()->toArray();
		
		$service_tax = DB::table('tbl_invoices')->where('sales_service_id','=',$serviceid)->first();
		if(!empty($service_tax->tax_name))
		{
			$service_taxes = explode(', ', $service_tax->tax_name);
		}
		else
		{
			$service_taxes = '';
		}
		
		$discount = $service_tax->discount;
		
		$logo = DB::table('tbl_settings')->first();
		
		$html = view('customer.repeatservice')->with(compact('serviceid','tbl_services','sales','logo','job','s_date','vehical','customer','service_pro','service_pro2','tbl_service_observation_points','service_tax','discount','service_taxes'))->render();
		return response()->json(['success' => true, 'html' => $html]);	
		
	}
	
	// customer delete
    public function destroy($id)
	 {
		  
		//$customer = DB::table('users')->where('id','=',$id)->delete();
	 	//$customer = User::where('id','=',$id)->update(['soft_delete' => 1]);
        $customer = Customer::where('id','=',$id)->firstorfail()->delete();
		/*$tbl_incomes = DB::table('tbl_incomes')->where('customer_id','=',$id)->delete();
		$tbl_invoices = DB::table('tbl_invoices')->where('customer_id','=',$id)->delete();
		$tbl_jobcard_details = DB::table('tbl_jobcard_details')->where('customer_id','=',$id)->delete();
		$tbl_gatepasses = DB::table('tbl_gatepasses')->where('customer_id','=',$id)->delete();
		$tbl_sales = DB::table('tbl_sales')->where('customer_id','=',$id)->delete();
		$tbl_services = DB::table('tbl_services')->where('customer_id','=',$id)->delete();*/
		  
		return redirect('/customer/list')->with('message','Successfully Deleted');
	 }	

	 // customer edit
     public function customeredit($id)
	 {   
	    $editid = $id;
        $customer =Customer::where('id','=',$id)->first();
		$cars =Car::where('customers_id','=',$id)->get();

		return view('customer.update',compact('editid','customer','cars'));
	
	 }	

	// customer update
    public function customerupdate($id, CustomerAddEditFormRequest $request)
	{


		$name = $request->name;
		$address = $request->address;
		$phone = $request->phone;
		$mail = $request->mail;
		$manufacturing = $request->manufacturing;
		$registration = $request->registration;
		$manufacturing_date = $request->manufacturing_date;
		$chassis = $request->chassis;
		$model = $request->model;
		$kilometers = $request->kilometers;

		$user = DB::table('customers')->where('id','=',$id)->first();
		$email = $user->mail;
		if(!empty($email))
		{
			if($email != $mail)
			{
				$this->validate($request, [
					'email' => 'required|email|unique:customers'
				]);
			}
		}
		  
		$customer = Customer::find($id);
		$customer->name = $name;
		$customer->phone = $phone;
		$customer->mail = $mail;
		$customer->address = $address;			
		$customer->save();	
		$car = DB::table('cars')->where('customer_id','=',$id)->get();
        $car->manufacturing = $manufacturing;
		$car->registration = $registration;
		$car->manufacturing_date = $manufacturing_date;
		$car->chassis = $chassis;
		$car->model = $model;
		$car->kilometers = $kilometers;
		$car->save();
		return redirect('/customer/list')->with('message','Successfully Updated');
	}
	

}