<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;
use Auth;
use Mail;
use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Role;
use App\Role_user;
use Illuminate\Support\Facades\Input;
use App\JobcardDetail;
use App\Gatepass;
use App\Sale;
use App\CheckoutCategory;
use App\Service;
use App\Vehicle;
use App\Setting;
use App\Product;
use App\Invoice;
use App\Washbay;
use App\Branch;
use App\BranchSetting;
use App\PaymentMethod;

class ElectronicInvoiceController extends Controller
{
	//customer list
	public function viewCustomers(Request $request)
	{
		if (!isAdmin(Auth::User()->role_id)) {
			if (getUsersRole(Auth::user()->role_id) == 'Customer'){
				if (Gate::allows('customer_owndata')) {
					$customer = User::where([['role','=','Customer'],['soft_delete',0],['id','=',Auth::User()->id]])
					                ->orderBy('id','DESC')->get();
				}
				else{
					$customer = User::where([['role','=','Customer'],['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->get();
				}
		    } // end customer
			elseif (getUsersRole(Auth::user()->role_id) == 'Employee'){
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
			} // receptionist
			elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
			}
			else
			{
				$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
			}
		} // start admin
		else
		{
			$customer = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
		}
		return view('Electronic.viewCustomers', compact('customer'));
	}


	public function customer_jobcards($id)
	{
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();

		if (!isAdmin(Auth::User()->role_id)) 
		{
			if (getUsersRole(Auth::User()->role_id) == "Customer"){
				if(!empty($request->free)){
					$services = Service::orderBy('service_date','asc')
											->where([['job_no','like','J%'],['service_type','=','free'],['done_status','=',1]])
											->where('customer_id','=',Auth::User()->id)
											->whereNotIn('quotation_modify_status',[1])
											->get();
				}
				elseif(!empty($request->paid)){	
					$services = Service::orderBy('service_date','asc')
											->where([['job_no','like','J%'],['service_type','=','paid'],['done_status','=',1]])
											->where('customer_id','=',Auth::User()->id)
											->whereNotIn('quotation_modify_status',[1])
											->get();
				}
				elseif(!empty($request->repeatjob)){
					$services = Service::orderBy('service_date','asc')
									->where([['job_no','like','J%'],['service_category','=','repeat job'],['done_status','=',1]])
									->where('customer_id','=',Auth::User()->id)
									->whereNotIn('quotation_modify_status',[1])
									->get();
				}		
				else{
					$services = Service::orderBy('id','desc')->where([['job_no','like','J%'],['customer_id','=',Auth::User()->id]])->whereNotIn('quotation_modify_status',[1])->get();
				}
			} // end customer
			elseif (getUsersRole(Auth::User()->role_id) == "Employee") 
			{
				if(!empty($request->free)){
					$services = Service::orderBy('service_date','asc')
								->where([['job_no','like','J%'],['service_type','=','free'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])
								->where('assign_to','=',Auth::User()->id)
								->whereNotIn('quotation_modify_status',[1])
								->get();
				}
				elseif(!empty($request->paid)){	
					$services = Service::orderBy('service_date','asc')
											->where([['job_no','like','J%'],['service_type','=','paid'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])
											->where('assign_to','=',Auth::User()->id)
											->whereNotIn('quotation_modify_status',[1])
											->get();
				}
				elseif(!empty($request->repeatjob)){
					$services = Service::orderBy('service_date','asc')
								->where([['job_no','like','J%'],['service_category','=','repeat job'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])
								->where('assign_to','=',Auth::User()->id)
								->whereNotIn('quotation_modify_status',[1])
								->get();
				}		
				else{
					$services = Service::orderBy('id','desc')->where([['job_no','like','J%'],['assign_to','=',Auth::User()->id], ['branch_id',$currentUser->branch_id]])->whereNotIn('quotation_modify_status',[1])->get();
				}
			} // receptionist
			elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {

				if(!empty($request->free)){
					$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_type','=','free'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])->whereNotIn('quotation_modify_status',[1])->get();
				}
				elseif(!empty($request->paid)){	
					$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_type','=','paid'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])->whereNotIn('quotation_modify_status',[1])->get();
				}
				elseif(!empty($request->repeatjob)){
					$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_category','=','repeat job'],['done_status','=',1], ['branch_id',$currentUser->branch_id]])->whereNotIn('quotation_modify_status',[1])->get();
				}		
				else{
					$services = Service::orderBy('id','desc')->where([['job_no','like','J%'], ['branch_id',$currentUser->branch_id]])->whereNotIn('quotation_modify_status',[1])->get();
				}
			}
		}
		else // start admin
		{
			if(!empty($request->free)){				
				$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_type','=','free'],['done_status','=',1],['soft_delete','=',0], ['branch_id',$adminCurrentBranch->branch_id]])->whereNotIn('quotation_modify_status',[1])->where('customer_id', $id)->get();
			}
			elseif(!empty($request->paid)){	
				$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_type','=','paid'],['done_status','=',1],['soft_delete','=',0], ['branch_id',$adminCurrentBranch->branch_id]])->whereNotIn('quotation_modify_status',[1])->where('customer_id', $id)->get();
			}
			elseif(!empty($request->repeatjob)){	
				$services = Service::orderBy('service_date','asc')->where([['job_no','like','J%'],['service_category','=','repeat job'],['done_status','=',1],['soft_delete','=',0], ['branch_id',$adminCurrentBranch->branch_id]])->whereNotIn('quotation_modify_status',[1])->where('customer_id', $id)->get();
			}		
			else{	
				$services = Service::where([['soft_delete',0], ['job_no','like','J%'], ['branch_id',$adminCurrentBranch->branch_id]])->whereNotIn('quotation_modify_status',[1])->where('customer_id', $id)->orderBy('id','desc')->get();
			}
		}

		$month = date('m');
		$year = date('Y');
		$start_date = "$year/$month/01";
		$end_date = "$year/$month/31";
		
		$current_month = DB::select("SELECT service_date FROM tbl_services WHERE service_date BETWEEN  '$start_date' AND '$end_date'");
		if(!empty($current_month)){
			foreach ($current_month as $list){
				$date[] = $list->service_date;
			}
			$available = json_encode($date);
		}
		else
		{
			$available = json_encode([0]);
		}

		return view('Electronic.customer_jobcards', compact('services','available')); 
	}

	public function add_invoice($id)
	{
		$last_order = DB::table('tbl_invoices')->latest()->first();

		if(!empty($last_order)){
			$new_number = str_pad($last_order->invoice_number + 1, 8, 0, STR_PAD_LEFT); 
		}else{
			$new_number = '00000001';
		}

		$code = $new_number;
		$characterss = '0123456789';
		$codepay =  'P'.''.substr(str_shuffle($characterss),0,6);
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$branchDatas = Branch::where('id', $currentUser->branch_id)->get();

		$payments = PaymentMethod::all();
		$branches = Branch::all();
		$service  = Service::findOrFail($id);
		return view('Electronic.add_invoice', compact('code', 'codepay', 'service', 'payments', 'branches', 'currentUser', 'branchDatas'));
	}
}
