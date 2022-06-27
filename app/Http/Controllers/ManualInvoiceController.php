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
use App\Car;
use App\Customer;
use App\PaymentMethod;
// use PDF;
use Barryvdh\DomPDF\Facade as PDF;
use App\Electronicinvoice;
use App\Invoiceservice;

class ManualInvoiceController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth')->except(['scanInvoice']);
    }

    public function getInvoice2()
	{
		$auth_user               = Auth::user();
		$auth_branch_id          = Auth::user()->branch_id;
		$auth_branch             = Branch::findOrFail($auth_branch_id);
		$auth_branch_vat_number  = $auth_branch->vat_number;
        $cars = Car::get();
		$customers_list= Customer::get();
		$list= Customer::all();
	
		$last_order  = Electronicinvoice::whereNull('deleted_at')->orderBy('id', 'desc')->first();
	    // return $last_order;

		if(!empty($last_order)){
			$new_number1 = str_pad($last_order->Invoice_Number + 1, 8, 0, STR_PAD_LEFT);
			$new_number= $new_number1;
		}else{
			$new_number = '00000001';
		}

		// $nn = '00000025';
		// return str_pad($nn + 1, 8, 0, STR_PAD_LEFT); 

		$code = $new_number;
		$characterss = '0123456789';
		$codepay =  'P'.''.substr(str_shuffle($characterss),0,6);

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		$tax = DB::table('tbl_account_tax_rates')->where('soft_delete','=',0)->get()->toArray();

		$tbl_payments = PaymentMethod::all();
		$branches     = Branch::all();
		//$service  = Service::findOrFail($id);
		$customers = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
		return view('Manual.getInvoiceNov2', compact('code', 'codepay', 'tbl_payments', 'branches', 'currentUser', 'branchDatas', 'customers', 'tax', 'auth_branch_vat_number', 'auth_branch','cars','customers_list','list'));
	}

	public function customer_invoice($id)
	{
           $data=Customer::where('id',$id)->first();
		   return response()->json($data);

	}
	public function car_invoice($id)
	{
           $data=Car::where('customer_id',$id)->get();
		   return response()->json($data);

	}

	public function storeInvoice2(Request $request)
	{
		//return strlen($request->registeration);
		$this->validate($request, [
			'customer_address' => 'required|string', 
			'service_name.0'   => 'required',
			'service_value.0'   => 'required|numeric|min:1',
			'qty.0'   => 'required|integer|min:1',
			//'service_name.*'   => 'required',
			//'service_value.*'   => 'required',
			'Customer'           => 'required|string', 
			'customer_vat'       => 'nullable', 
			'customer_phone'     => 'required|integer|digits_between:9,9|starts_with:5',
			'customer_po_number' => 'nullable|integer', 
			'quotation_number'   => 'nullable', 
			'Discount' => 'nullable|numeric|min:1',
			'model_name'    => 'required|string', 
			'chassis_no'    => 'required', 
			'manufacturer'  => 'required|integer',
			'reg_chars'     => 'required|string|min:1|max:3', 
			'registeration' => 'required|integer|digits_between:1,4', 
			'fleet_number' => 'required|string',   // manufacturer
			'meters_reading' => 'required|numeric|min:1',
			'service_name.1'   => 'nullable',
			'service_value.1'   => 'nullable|numeric',
			'service_name.2'   => 'nullable',
			'service_value.2'   => 'nullable|numeric',
			'service_name.3'   => 'nullable',
			'service_value.3'   => 'nullable|numeric',
			'service_name.4'   => 'nullable',
			'service_value.4'   => 'nullable|numeric',
			'job_open_date' => 'required',
			'delivery_date' => 'required',
		]);

		// return $request->vat_number;
		$branch_id = Auth::user()->branch_id;
		$unique = array();

		$services_sum    = 0; //array_sum($request->service_value);
		$paid_amount     = 0;
		$services_values = $request->service_value;
		$quantities      = $request->qty;
		$reg_chars       = str_replace(' ', '', $request->reg_chars);
		
		//$service       = Service::where('job_no', $request->Job_card)->first();
	//	$vehicle       = Vehicle::findOrFail($service->vehicle_id);
		$Date          = $request->Date;
		$job_open_date = $request->job_open_date;
		$delivery_date = $request->delivery_date;
		
		if(getDateFormat() == 'm-d-Y'){
			$dates = date('Y-m-d',strtotime(str_replace('-','/', $Date)));
			$dates_jop_open = date('Y-m-d',strtotime(str_replace('-','/', $job_open_date)));
			$dates_delivery = date('Y-m-d',strtotime(str_replace('-','/', $delivery_date)));
		}
		else{
			$dates = date('Y-m-d',strtotime($Date));
			$dates_jop_open = date('Y-m-d',strtotime($job_open_date));
			$dates_delivery = date('Y-m-d',strtotime($delivery_date));
		}

		    $invoice = new Electronicinvoice;

		    $invoice->Invoice_type       = 'service';
            $invoice->Invoice_Number     = $request->Invoice_Number;
            $invoice->Customer           = $request->Customer;
            $invoice->customer_address   = $request->customer_address;
            $invoice->customer_vat       = $request->customer_vat;
            $invoice->customer_phone     = $request->customer_phone;
            $invoice->phone_code         = $request->phone_code;
           // $invoice->customer_number    = $request->customer_number;
            $invoice->Job_card           = $request->Job_card;
            $invoice->quotation_number   = $request->quotation_number;
            $invoice->customer_po_number = $request->customer_po_number;
            $invoice->branch_name        = $request->branch_name;
            $invoice->meters_reading     = $request->meters_reading;
            $invoice->fleet_number       = $request->fleet_number;
            $invoice->registeration      = $request->registeration;
            $invoice->reg_chars          = $reg_chars; 
            $invoice->manufacturer       = $request->manufacturer;
            $invoice->chassis_no         = $request->chassis_no;
            $invoice->model_name         = $request->model_name;
           // $invoice->vehicle            = $request->vehicle;
            $invoice->Date               = $request->Date;
            $invoice->Discount           = $request->Discount;
            $invoice->job_open_date      = $request->job_open_date;
            $invoice->delivery_date      = $request->delivery_date;
            $invoice->Details            = $request->Details;
            $invoice->vat_number         = $request->vat_number;
            $invoice->Status             = $request->Status;
            $invoice->Payment_type       = $request->Payment_type;
            $invoice->services_sum       = $services_sum;

            $invoice->services_sum       = $services_sum;
            $invoice->total_amount       = $services_sum;
            $invoice->grand_total        = $paid_amount;
            $invoice->tax                = 15;
            $invoice->paid_amount        = $paid_amount;
            $invoice->branch_id          = $branch_id;

		    $invoice->save();

		foreach ($request->service_name as $key => $value) {
			if ($value == null) {
				continue;
			}else{
					if ( ($services_values[$key] == null) || ($services_values[$key] < 1 ) ){
						return redirect()->back();
					}
				   if ( isset($quantities[$key]) && $quantities[$key] != '' ) {
				   	    if ( ( $quantities[$key] < 1 ) ) {
				   	    	return redirect()->back();
				   	    }
					}
			}
		}

		foreach ($request->service_name as $key => $value) {
			if ($value == null) {
				continue;
			}else{
				if ( !isset($quantities[$key]) || $quantities[$key] == ''  || $quantities[$key] == null ) {
				   	    $inserted_qty = 1;
					}else{
						$inserted_qty = $quantities[$key];
					}
				Invoiceservice::create([
					'invoice_id'    => $invoice->id,
					'service_name'  => $value,
					'service_value' => $services_values[$key],
					'qty'           => $inserted_qty,
					'sub_total'     => $services_values[$key] * $inserted_qty,
				]);
				//array_push($unique, $services_values[$key]);
			}
		}

		$sub_sum = Invoiceservice::where('invoice_id', $invoice->id)->sum('sub_total');

		if ($request->Discount > 0) {
			//return 'lll';
			$percent = ($sub_sum * $request->Discount ) / 100;
			$total_amount = $sub_sum - $percent;
		}else{
			$total_amount = $sub_sum;
		}

		$tax_percent = ($total_amount * 15) / 100;
		$updated_amount = $total_amount + $tax_percent;

		$invoice->services_sum       = $total_amount;
        $invoice->total_amount       = $total_amount;
        $invoice->paid_amount        = $updated_amount;
        $invoice->save();

		return redirect('invoice/listall')->with('message','Successfully Submitted');
		// return $request->all();
	}

	public function ManualInvoiced($id)
	{
		$invoice  = Electronicinvoice::findOrFail($id);
		$invoice->update([
			'final' => 1,
		]);
		return redirect('invoice/listall')->with('message','Successfully Invoiced');
	}

    public function ManualEdit($id)
	{
		$invoice = Electronicinvoice::findOrFail($id);
		$auth_user               = Auth::user();
		$auth_branch_id          = Auth::user()->branch_id;
		$auth_branch             = Branch::findOrFail($auth_branch_id);
		$auth_branch_vat_number  = $auth_branch->vat_number;

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		$tax = DB::table('tbl_account_tax_rates')->where('soft_delete','=',0)->get()->toArray();

		$tbl_payments = PaymentMethod::all();
		$branches     = Branch::all();
		$customers = User::where([['role','=','Customer'],['soft_delete',0]])->orderBy('id','DESC')->get();
		$services = Invoiceservice::where('invoice_id', $invoice->id)->get();

		return view('Manual.ManualEdit', compact('invoice', 'tbl_payments', 'branches', 'currentUser', 'branchDatas', 'customers', 'tax', 'auth_branch_vat_number', 'auth_branch', 'services'));
	}

	// nw method for update
	public function UpdateInvoice2(Request $request)
	{	
		$this->validate($request, [
			'customer_address' => 'required|string', 
			'service_name.0'   => 'required',
			'service_value.0'   => 'required|numeric|min:1',
			'qty.0'   => 'required|integer|min:1',
			//'service_name.*'   => 'required',
			//'service_value.*'   => 'required',
			'Customer'           => 'required|string', 
			'customer_vat'       => 'nullable', 
			'customer_phone'     => 'required|integer|digits_between:9,9|starts_with:5',
			'customer_po_number' => 'nullable|integer', 
			'quotation_number'   => 'nullable', 
			'Discount'         => 'nullable|numeric|min:1',
			'model_name'       => 'required|string', 
			'chassis_no'       => 'required',
			'manufacturer'     => 'required|integer',
			'reg_chars'        => 'required|string|min:1|max:3', 
			'registeration'    => 'required|numeric|digits_between:1,4',
			'fleet_number'     => 'required|string',   // manufacturer
			'meters_reading'   => 'required|numeric|min:1',
			'service_name.1'   => 'nullable',
			'service_value.1'  => 'nullable|numeric',
			'service_name.2'   => 'nullable',
			'service_value.2'  => 'nullable|numeric',
			'service_name.3'   => 'nullable',
			'service_value.3'  => 'nullable|numeric',
			'service_name.4'   => 'nullable',
			'service_value.4'  => 'nullable|numeric',
			'job_open_date'    => 'required',
			'delivery_date'    => 'required',
		]);
		// end validation
		
		$current_invoice_id = $request->current_invoice;

		$branch_id = Auth::user()->branch_id;
		$unique = array();
		$services_sum  = array_sum($request->service_value);
		$services_values = $request->service_value;
		$quantities      = $request->qty;
		$markers         = $request->markers;
		$reg_chars = str_replace(' ', '', $request->reg_chars);
		
		//$service       = Service::where('job_no', $request->Job_card)->first();
	//	$vehicle       = Vehicle::findOrFail($service->vehicle_id);
		$Date          = $request->Date;
		$job_open_date = $request->job_open_date;
		$delivery_date = $request->delivery_date;
		
		if(getDateFormat() == 'm-d-Y'){
			$dates = date('Y-m-d',strtotime(str_replace('-','/', $Date)));
			$dates_jop_open = date('Y-m-d',strtotime(str_replace('-','/', $job_open_date)));
			$dates_delivery = date('Y-m-d',strtotime(str_replace('-','/', $delivery_date)));
		}
		else{
			$dates = date('Y-m-d',strtotime($Date));
			$dates_jop_open = date('Y-m-d',strtotime($job_open_date));
			$dates_delivery = date('Y-m-d',strtotime($delivery_date));
		}

		    $invoice = Electronicinvoice::findOrFail($current_invoice_id);

		    $invoice->Invoice_type       = 'service';
            $invoice->Invoice_Number     = $request->Invoice_Number;
            $invoice->Customer           = $request->Customer;
            $invoice->customer_address   = $request->customer_address;
            $invoice->customer_vat       = $request->customer_vat;
            $invoice->customer_phone     = $request->customer_phone;
            $invoice->phone_code         = $request->phone_code;
           // $invoice->customer_number    = $request->customer_number;
            $invoice->Job_card           = $request->Job_card;
            $invoice->quotation_number   = $request->quotation_number;
            $invoice->customer_po_number = $request->customer_po_number;
            $invoice->branch_name        = $request->branch_name;
            $invoice->meters_reading     = $request->meters_reading;
            $invoice->fleet_number       = $request->fleet_number;
            $invoice->registeration      = $request->registeration;
            $invoice->reg_chars          = $reg_chars; 
            $invoice->manufacturer       = $request->manufacturer;
            $invoice->chassis_no         = $request->chassis_no;
            $invoice->model_name         = $request->model_name;
           // $invoice->vehicle            = $request->vehicle;
            $invoice->Date               = $request->Date;
            $invoice->Discount           = $request->Discount;
            $invoice->job_open_date      = $request->job_open_date;
            $invoice->delivery_date      = $request->delivery_date;
            $invoice->Details            = $request->Details;
            $invoice->vat_number         = $request->vat_number;
            $invoice->Status             = $request->Status;
            $invoice->Payment_type       = $request->Payment_type;
            $invoice->services_sum       = $services_sum;

            $invoice->services_sum       = $services_sum;
            $invoice->total_amount       = $services_sum;
            $invoice->grand_total        = $invoice->paid_amount;
            $invoice->tax                = 15;
            $invoice->paid_amount        = $invoice->paid_amount;
            $invoice->branch_id          = $branch_id;

		    $invoice->save();

	    foreach ($request->service_name as $key => $value) {
			if ($value == null) {
				continue;
			}else{
					if ( ($services_values[$key] == null) || ($services_values[$key] < 1 ) ){
						return redirect()->back();
					}
				   if ( isset($quantities[$key]) && $quantities[$key] != '' ) {
				   	    if ( $quantities[$key] < 1 ) {
				   	    	return redirect()->back();
				   	    }
					}
			}
		}

		  Invoiceservice::where('invoice_id', $invoice->id)->delete();

		    foreach ($request->service_name as $key => $value) {
			if ($value == null) {
				continue;
			}else{
				if ( !isset($quantities[$key]) || $quantities[$key] == ''  || $quantities[$key] == null ) {
				   	    $inserted_qty = 1;
					}else{
						$inserted_qty = $quantities[$key];
					}
				Invoiceservice::create([
					'invoice_id'    => $invoice->id,
					'service_name'  => $value,
					'service_value' => $services_values[$key],
					'qty'           => $inserted_qty,
					'sub_total'     => $services_values[$key] * $inserted_qty,
				]);
				//array_push($unique, $services_values[$key]);
			}
		}

		$sub_sum = Invoiceservice::where('invoice_id', $invoice->id)->sum('sub_total');

		if ($request->Discount > 0) {
			//return 'lll';
			$percent = ($sub_sum * $request->Discount ) / 100;
			$total_amount = $sub_sum - $percent;
		}else{
			$total_amount = $sub_sum;
		}

		$tax_percent = ($total_amount * 15) / 100;
		$updated_amount = $total_amount + $tax_percent;

		$invoice->services_sum       = $total_amount;
        $invoice->total_amount       = $total_amount;
        $invoice->paid_amount        = $updated_amount;
        $invoice->save();

		return redirect('invoice/listall')->with('message','Successfully Updated');
		// return $request->all();
	}

	//invoice list
	public function showall()
	{	
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])
		                   ->orderBy('id','DESC')->first();

		$invoice = Electronicinvoice::where('branch_id', $currentUser->branch_id)->whereNull('deleted_at')
		                          ->where('final', 0)
				                  ->orderBy('id','DESC')->get();

		return view('Manual.showall',compact('invoice'));
	}

	//invoice list
	public function showallFinal()
	{	
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])
		                   ->orderBy('id','DESC')->first();

		$invoice = Electronicinvoice::where('branch_id', $currentUser->branch_id)->whereNull('deleted_at')
		                          ->where('final', 1)
				                  ->orderBy('id','DESC')->get();

		return view('Manual.showallFinal',compact('invoice'));
	}


	public function showInvoice2($id)
	{
		$invoice  = Electronicinvoice::findOrFail($id);
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])
		                   ->orderBy('id','DESC')->first();
		if ($currentUser->branch_id != $invoice->branch_id) {
		  // return redirect()->back()->with('message', 'untouchable');
		   return redirect('invoice/listall')->with('message','restricted');
		}                  
		$branch   = Branch::findOrFail($invoice->branch_id);
		$paymentMethod = PaymentMethod::findOrFail($invoice->Payment_type);
		$services = Invoiceservice::where('invoice_id', $invoice->id)->get();

		return view('Manual.ShowInvoice2',compact('invoice', 'branch', 'paymentMethod', 'services'));
	}

	public function preview($id)
	{
		$invoice  = Electronicinvoice::findOrFail($id);
		$branch   = Branch::findOrFail($invoice->branch_id);
		$paymentMethod = PaymentMethod::findOrFail($invoice->Payment_type);
		$services = Invoiceservice::where('invoice_id', $invoice->id)->get();

		return view('Manual.preview',compact('invoice', 'branch', 'paymentMethod', 'services'));
	}

	public function scanInvoice($inv_number, $inv_branch, $inv_vatno, $inv_date, $inv_total, $inv_15_value)
	{
		// $invoice  = Electronicinvoice::findOrFail($id);
		$invoice  = Electronicinvoice::where('Invoice_Number', $inv_number)->first();
		if (!$invoice) {
			return redirect()->back();
		}
		$branch   = Branch::findOrFail($invoice->branch_id);
		$paymentMethod = PaymentMethod::findOrFail($invoice->Payment_type);
		$services = Invoiceservice::where('invoice_id', $invoice->id)->get();
	    return view('Manual.ShowInvoice3',compact('invoice', 'branch', 'paymentMethod', 'services'));
	}

	public function scanInvoicepdf($id)
	{
		$invoice  = Electronicinvoice::findOrFail($id);
		$branch   = Branch::findOrFail($invoice->branch_id);
		$paymentMethod = PaymentMethod::findOrFail($invoice->Payment_type);
		$services = Invoiceservice::where('invoice_id', $invoice->id)->get();
		$pdf = PDF::loadView('Manual.scanInvoicepdf', compact('id', 'invoice', 'branch', 'paymentMethod', 'services'));
	    return $pdf->stream('INVOICE.pdf');
	    // return view('Manual.scanInvoicepdf',compact('invoice', 'branch', 'paymentMethod', 'services'));
	}	
}
