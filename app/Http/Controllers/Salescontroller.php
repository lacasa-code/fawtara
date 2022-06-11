<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Mail;
use Auth;

use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;

use App\User;
use App\tbl_sales;
use App\tbl_colors;
use App\tbl_services;
use App\tbl_rto_taxes;
use App\tbl_sales_taxes;
use App\tbl_mail_notifications;

use App\Service;
use App\Color;
use App\Sale;
use App\Invoice;
use App\Vehicle;
use App\Vehiclebrand;
use App\PaymentMethod;
use App\CustomField;
use App\RtoTax;
use App\Setting;
use App\Updatekey;
use App\Branch;
use App\BranchSetting;
use App\Http\Requests\StoreVehicleSaleAddEditFormRequest;

class Salescontroller extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	//sales list
    public function index()
	{	
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();

		if (!isAdmin(Auth::User()->role_id))
		{
			if (getUsersRole(Auth::user()->role_id) == 'Customer'){

				$sales = Sale::where([['customer_id','=',Auth::User()->id],['soft_delete','=',0]])->orderBy('id','DESC')->get();
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Employee'){

				$sales = Sale::where([['salesmanname',Auth::User()->id],['soft_delete',0], ['branch_id',$currentUser->branch_id]])->orderBy('id','DESC')->get();
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Support Staff' || getUsersRole(Auth::user()->role_id) == 'Accountant' || getUsersRole(Auth::user()->role_id) == 'Branch Admin') {
				
				$sales = Sale::where([['soft_delete',0], ['branch_id',$currentUser->branch_id]])->orderBy('id','DESC')->get();
			}
			else{
				$sales = Sale::where([['soft_delete',0], ['branch_id',$currentUser->branch_id]])->orderBy('id','DESC')->get();
			}
		}
		else{
			$sales = Sale::where([['soft_delete',0], ['branch_id',$adminCurrentBranch->branch_id]])->orderBy('id','DESC')->get();
		}

		return view('sales.list',compact('sales'));
	}

	
	//sales add form
	public function addsales()
	{	
		$characters = '0123456789';
		$code =  'S'.''.substr(str_shuffle($characters),0,6);

		$color = DB::table('tbl_colors')->where('soft_delete','=',0)->get()->toArray();				
		$taxes = DB::table('tbl_account_tax_rates')->where('soft_delete','=',0)->get()->toArray();
		$payment = DB::table('tbl_payments')->where('soft_delete','=',0)->get()->toArray();
		$brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','sales'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();
		
		if (isAdmin(Auth::User()->role_id)){			
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
			$employee = DB::table('users')->where([['role','employee'], ['branch_id',$adminCurrentBranch->branch_id]])->where('soft_delete', '=', 0)->get()->toArray();
			$customer = DB::table('users')->where([['role','Customer'],['soft_delete',0]])->get()->toArray();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$employee = DB::table('users')->where('role','employee')->where('soft_delete', '=', 0)->get()->toArray();
			$customer = DB::table('users')->where([['role','=','Customer'],['soft_delete','=',0]])->get()->toArray();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Employee'){
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role','employee'], ['branch_id',$currentUser->branch_id]])->where('soft_delete', '=', 0)->get()->toArray();
			$customer = DB::table('users')->where([['role','Customer'],['soft_delete',0]])->get()->toArray();
		}
		else{
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$employee = DB::table('users')->where([['role','employee'], ['branch_id',$currentUser->branch_id]])->where('soft_delete', '=', 0)->get()->toArray();
			$customer = DB::table('users')->where([['role','Customer'],['soft_delete',0]])->get()->toArray();
		}
		
		return view('sales.add',compact('customer','employee','code','color','taxes','payment','brand','tbl_custom_fields', 'branchDatas'));
	}
	
	//color add
	public function coloradd(Request $request)
	{   
		$color_name = $request->c_name;
		$colors = DB::table('tbl_colors')->where('color','=',$color_name)->count();
		if($colors == 0){
			$color = new Color;
			$color->color=$color_name;
			$color->save();
			echo $color->id;
		}
		else{
			return '01';
		}	
	}
	
	//color delete
	public function colordelete(Request $request)
	{
		$id = $request->colorid;
		//$color =DB::table('tbl_colors')->where('id','=',$id)->delete();
		$color = DB::table('tbl_colors')->where('id','=',$id)->update(['soft_delete' => 1]);
	}
	
	//get chassis
	public function getchasis(Request $request)
	{	
		$modelname = $request->modelname;
		$vehicle_id = $request->vehicle_id;
		$sales = DB::table('tbl_sales')->where('vehicle_id','!=',$vehicle_id)->get()->toArray();
		$count = DB::table('tbl_sales')->where('vehicle_id','!=',$vehicle_id)->count();	
		if($count > 0 ){		
			foreach ($sales as $sale){
				$ve_id[] = $sale->vehicle_id;
				$csno[] = $sale->chassisno;				
			}
			$data = DB::table('tbl_vehicles')->whereNotIn('id',$ve_id)->where('modelname',$modelname)->get()->toArray();
		}
		else{
			$data = DB::table('tbl_vehicles')->where('modelname','=',$modelname)->get()->toArray();
		}
		?>
			<?php foreach ($data as $datas) { ?>
				<option value="<?php echo $datas->chassisno;?>" ><?php echo $datas->chassisno;?></option>
		<?php	} ?>		
		<?php
	}
	
	//get vehicle data
	public function getrecord(Request $request)
	{	
		$vid = $request->vehicale_id;
		$v_record = DB::table('tbl_vehicles')->where([['id','=',$vid],['soft_delete','=',0]])->first();
		$record = json_encode($v_record);
		
		echo $record;
	}
	
	//get model name
	public function getmodel_name(Request $request)
	{	
		$brand_name = $request->brand_name;
		$data = DB::table('tbl_sales')->where([['vehicle_brand','=',$brand_name],['soft_delete','=',0]])->get()->toArray();
		$count = DB::table('tbl_sales')->where([['vehicle_brand','=',$brand_name],['soft_delete','=',0]])->count();

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
	    $adminCurrentBranch = BranchSetting::where('id','=',1)->first();

		if($count>0)
		{	
			foreach ($data as $datas){
				$vehical_id[] = $datas->vehicle_id;	
			}

			if (isAdmin(Auth::User()->role_id)) {
				$vehicale = DB::table('tbl_vehicles')->whereNotIn('id',$vehical_id)->where([['vehiclebrand_id',$brand_name], ['added_by_service',0], ['branch_id',$adminCurrentBranch->branch_id]])->get()->toArray();
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
				$vehicale = DB::table('tbl_vehicles')->whereNotIn('id',$vehical_id)->where([['vehiclebrand_id',$brand_name], ['added_by_service',0]])->get()->toArray();
			}
			else{
				$vehicale = DB::table('tbl_vehicles')->whereNotIn('id',$vehical_id)->where([['vehiclebrand_id',$brand_name], ['added_by_service',0], ['branch_id',$currentUser->branch_id]])->get()->toArray();
			}			
		}
		else
		{			
			if (isAdmin(Auth::User()->role_id)) {
				$vehicale = DB::table('tbl_vehicles')->where([['vehiclebrand_id',$brand_name], ['added_by_service',0], ['branch_id',$adminCurrentBranch->branch_id]])->get()->toArray();
			}
			elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
				$vehicale = DB::table('tbl_vehicles')->where([['vehiclebrand_id',$brand_name],['added_by_service',0]])->get()->toArray();
			}
			else{
				$vehicale = DB::table('tbl_vehicles')->where([['vehiclebrand_id',$brand_name], ['added_by_service',0], ['branch_id',$currentUser->branch_id]])->get()->toArray();
			}
		}		
		?>
			<?php foreach ($vehicale as $vehicales) { ?>
				<option  class="modelnm" value="<?php echo $vehicales->id;?>" modelname="<?php echo $vehicales->modelname; ?>" brand="<?php echo $vehicales->vehiclebrand_id;?>" vhi_type="<?php $vehicales->vehicletype_id;?>" ><?php echo $vehicales->modelname;?></option>
		<?php	} ?>		
		<?php	
	}
	
	//get tax per
	public function gettaxespercentage(Request $request)
	{	
		$t_name = $request->t_name;
		if(!empty($t_name)){
			$t_record = DB::table('tbl_account_tax_rates')->where('taxname','=',$t_name)->first();
			$tax = $t_record->tax;
			echo $tax;
		}
		else{
			echo 0;
		}
	}
	
	// free services
	public function getservices(Request $request)
	{	

		$interval = $request->interval;
		$date_gape = $request->date_gape;
		$no_service = $request->no_service;
		$characters = '0123456789';
		$code =  'C'.''.substr(str_shuffle($characters),0,6);	
		$new_interval=$interval;
			
		$new_interval_array=array();
		$no_service_arry=array();
		$get_service_data=date('Y-m-d');		
		$addmonth=(int)$interval;
		$addday = (int)$date_gape;

		for($j=1;$j<=$no_service;$j++){
			
			$no_service_date = date('Y-m-d', strtotime("+".$addmonth." months", strtotime($get_service_data)));
			$no_service_date_gap = date('Y-m-d', strtotime("+".$addday." days", strtotime($no_service_date)));
			
			$get_service_data=$no_service_date;
			$codes = $code.$j;
			$no_service_arry[$get_service_data]=("$j Service");
			
			?>
			<table class="table" align="center" style="width:80%;">
			<tr class="data_of_type">
				<td class="text-center"><?php echo $j; ?></td>
				<td class="text-center"><input type="text" class="form-control first_width" value="<?php echo $no_service_date.'  To  '.$no_service_date_gap; ?>" name="service[service_date][]"></td>
				<td class="text-center"><input type="text" class="form-control second_width" name="service[service_text][]" value="<?php echo $no_service_arry[$get_service_data];?>" ></td>
				<td class="text-center"><input type="text" class="form-control second_width" name="service[service_job][]" value="<?php echo $codes;?>" readonly></td>
			</tr>
			</table>
			<?php
		}			
	}
	
	//get taxes
	public function gettaxes(Request $request)
	{
		$id = $request->row_id;
		$ids = $id+1;
		$rowid = 'row_id_'.$ids;	
		$taxes = DB::table('tbl_account_tax_rates')->get()->toArray();		
		?>		

		<tr id="<?php echo $rowid;?>">
		<input type="hidden" value="<?php echo $ids;?>" name="account[tr_id][]"/>
		<td><select name="account[tax_name][]" url="<?php  echo url('sales/add/gettaxespercentage'); ?>" class="form-control tax_name" row_did="<?php echo $ids;?>" data-id="<?php echo $ids;?>" required="">
		<option value="0">Select Tax</option><?php  foreach($taxes as $tax) { ?><option value="<?php echo $tax->taxname;?>"><?php echo $tax->taxname;?></option> <?php } ?> </select>
		</td>
		<td>
			<input type="text" name="account[tax][]" class="form-control tax" value="" id="tax_<?php echo $ids;?>" readonly="true">
		</td>
		<td>
			<span class="trash_account" data-id="<?php echo $ids; ?>"><i class="fa fa-trash"></i> Delete</span>
		</td>
		</tr>
		<?php
	}
	
	//get qty
	public function getqty(Request $request)
	{	
		$qty = $request->qty;
		$price = $request->price;
		echo $qty;
		echo $price;
	}
	
	//sales store
	public function store(Request $request)
	{	
		/*$this->validate($request, [  
         //'qty' => 'numeric',
         // 'price' => 'numeric',
	     ]);*/
			
		//dd($request->all());
		$c_id=$request->cus_name;
		if(getDateFormat()== 'm-d-Y'){
			$s_date=date('Y-m-d',strtotime(str_replace('-','/',$request->date)));
		}
		else{
			$s_date=date('Y-m-d',strtotime($request->date));
		}
		$totalamount=$request->total_price;
		$bill_no=$request->bill_no;
		
		$sales = new Sale;
		$sales->customer_id =$c_id;		
		$sales->bill_no = $bill_no;
		$sales->date =$s_date; 
		$sales->vehicle_brand = $request->vehi_bra_name;
		$sales->chassisno = $request->chassis;
		$sales->vehicle_id = $request->vehicale_name;
		$sales->color_id = $request->color;		
		$sales->price = $request->price;
		$sales->total_price = $totalamount;
		$sales->no_of_services = $request->no_of_services;
		$sales->interval = $request->interval;
		$sales->date_gap = $request->date_gape;
		$sales->assigne_to = $request->assigne_to;
		$sales->salesmanname = $request->salesmanname;
		$sales->branch_id = $request->branch;
		//$sales->quantity = $request->qty;
		//$sales->payment_type_id = 0;
		//$sales->status = $request->status;

		//custom field save	
		$custom=$request->custom;
		$custom_fileld_value=array();	
		$custom_fileld_value_jason_array=array();
		if(!empty($custom))
		{
			foreach($custom as $key=>$value){
				if (is_array($value)) {
					$add_one_in = implode(",",$value);
					$custom_fileld_value[] = array("id" => "$key", "value" => "$add_one_in");
				}
				else{
					$custom_fileld_value[] = array("id" => "$key", "value" => "$value");	
				}				
			}	
		   
			$custom_fileld_value_jason_array['custom_fileld_value'] = json_encode($custom_fileld_value); 
			foreach($custom_fileld_value_jason_array as $key1 => $val1){
				$salesData = $val1;
			}	
			$sales->custom_field = $salesData;
		}
		$sales->save();
				
		$sales_record = DB::table('tbl_sales')->orderBy('id','desc')->first();
		$id = $sales_record->id;
		
		//Services Code Code  
		$service = $request->service;
		if(!empty($service)){
			foreach($service['service_date'] as $key => $value)
			{	
				$date = $service['service_date'][$key];
				$new_date = strtok($date, " ");
				$title = $service['service_text'][$key];
				$job = $service['service_job'][$key];
				
				$services = new Service;
				$services->job_no = $job;
				$services->service_type = 'free';
				$services->sales_id = $id;
				$services->service_date = $new_date;
				$services->full_date = $date;
				$services->title = $title;
				$services->done_status =2;
				$services->assign_to = $request->assigne_to;
				$services->customer_id = $request->cus_name;
				$services->vehicle_id = $request->vehicale_name;
				$services->branch_id = $request->branch;
				$services->save();				
			}
		}

		return redirect('sales/list')->with('message','Successfully Submitted');
	}
	
	//modal view for sales
	public function view(Request $request)
	{
		if(!empty($request->saleid)){
			$id = $request->saleid;
			$invoice_number = $request->invoice_number;			
		}
		else{
			$id = $request->serviceid;
			$auto_id = $request->auto_id;
		}
				
		$viewid = $id;
		$sales = Sale::where('id','=',$id)->first();
		$v_id = $sales->vehicle_id;
		$vehicale = Vehicle::where('id','=',$v_id)->first();
		
		if($request->saleid){
			$invioce = Invoice::where([['sales_service_id',$id],['invoice_number',$invoice_number]])->first();
		}
		else{
			$invioce = Invoice::where('id',$auto_id)->first();
		}
		if(!empty($invioce->tax_name)){
			$taxes = explode(', ',$invioce->tax_name);	
		}
		else{
			$taxes='';	
		}		

		$rto = RtoTax::where('vehicle_id','=',$v_id)->first();
		$logo = Setting::first();
		$updatekey = Updatekey::first();
		$s_key = $updatekey->secret_key;
		$p_key = $updatekey->publish_key;

		//Custom Field Data of Sales Table
		$tbl_custom_fields_sales = DB::table('tbl_custom_fields')->where([['form_name','=','sales'],['always_visable','=','yes']])->get()->toArray();

		//Custom Field Data of Invoice Table
		$tbl_custom_fields_invoice = DB::table('tbl_custom_fields')->where([['form_name','=','invoice'],['always_visable','=','yes']])->get()->toArray();

		//Custom Field Data of User Table (For Customer Module)
		$tbl_custom_fields_customers = DB::table('tbl_custom_fields')->where([['form_name','=','customer'],['always_visable','=','yes']])->get()->toArray();
		
		$html = view('invoice.salesinvoicemodel')->with(compact('viewid','vehicale','sales','logo','invioce','taxes','rto','p_key','tbl_custom_fields_sales','tbl_custom_fields_invoice','tbl_custom_fields_customers'))->render();
		
		return response()->json(['success' => true, 'html' => $html]);
	}
	

	public function destroy($id)
	{	
		//$sales = DB::table('tbl_sales')->where('id','=',$id)->delete();
		$sales = DB::table('tbl_sales')->where('id','=',$id)->update(['soft_delete' => 1]);

		//$services = DB::table('tbl_services')->where('sales_id','=',$id)->delete();
		$services = DB::table('tbl_services')->where('sales_id','=',$id)->update(['soft_delete' => 1]);

		//If Vehiclesale is deleted after invoice data should not ben deleted
		//$invoice = DB::table('tbl_invoices')->where('sales_service_id','=',$id)->delete();

		return redirect('sales/list')->with('message','Successfully Deleted');	
	}
	

	//sales edit form
	public function edit($id)
	{	
		$editid = $id;
		$color = Color::where('soft_delete','=',0)->get();				
		$payment = PaymentMethod::get();		

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();		
		if (isAdmin(Auth::User()->role_id)){			
			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
			$sales = Sale::where([['id',$id], ['branch_id',$adminCurrentBranch->branch_id]])->first();
			$employee = User::where([['role','Employee'], ['soft_delete',0], ['branch_id',$adminCurrentBranch->branch_id]])->get();
			$customer = User::where([['role','=','Customer'],['soft_delete','=',0], ['id', $sales->customer_id]])->get();
			$vehicale = Vehicle::where([['soft_delete',0], ['branch_id',$adminCurrentBranch->branch_id], ['id',$sales->vehicle_id]])->get();			
			$sales_services = Service::where([['sales_id',$id], ['branch_id',$adminCurrentBranch->branch_id]])->get();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
			$sales = Sale::where('id','=',$id)->first();
			$employee = User::where([['role','Employee'],['soft_delete',0]])->get();
			$customer = User::where([['role','Customer'],['soft_delete',0], ['id', $sales->customer_id]])->get();
			$vehicale = Vehicle::where([['soft_delete',0], ['id',$sales->vehicle_id]])->get();
			$sales_services = Service::where('sales_id','=',$id)->get();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Employee'){
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$sales = Sale::where([['id',$id], ['branch_id',$currentUser->branch_id]])->first();
			$customer = User::where([['role','Customer'],['soft_delete',0], ['id', $sales->customer_id]])->get();
			$employee = User::where([['role','Employee'], ['soft_delete',0], ['branch_id',$currentUser->branch_id]])->get();			
			$vehicale = Vehicle::where([['soft_delete',0], ['branch_id',$currentUser->branch_id], ['id',$sales->vehicle_id]])->get();
			$sales_services = Service::where([['sales_id',$id], ['branch_id',$currentUser->branch_id]])->get();
		}
		else{
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
			$sales = Sale::where([['id',$id], ['branch_id',$currentUser->branch_id]])->first();
			$employee = DB::table('users')->where([['role','employee'], ['branch_id',$currentUser->branch_id]])->where('soft_delete', '=', 0)->get()->toArray();
			$customer = User::where([['role','=','Customer'],['soft_delete','=',0], ['id', $sales->customer_id]])->get();
			$vehicale = Vehicle::where([['soft_delete',0], ['branch_id',$currentUser->branch_id], ['id',$sales->vehicle_id]])->get();		
			$sales_services = Service::where([['sales_id',$id], ['branch_id',$currentUser->branch_id]])->get();
		}

		$brand_id = $sales->vehicle_brand;
		$brand = Vehiclebrand::where([['soft_delete',0], ['id',$sales->vehicle_brand]])->get();

		//Custom Field Data of Sale Table
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','sales'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();
		
		return view('sales.edit',compact('sales','editid','vehicale','customer','payment','color','employee','sales_services','brand','tbl_custom_fields', 'branchDatas'));
	}
	
	//sales update
	public function update($id, Request $request)
	{ 
		/*$this->validate($request, [  
         //'qty' => 'numeric',
         // 'price' => 'numeric',
	    ]);*/

		$service_coupan = DB::table('tbl_services')->where('sales_id','=',$id)->get()->toArray();
		if(!empty($service_coupan)){
			foreach($service_coupan as $coupan){
				Service::Destroy($coupan->id);
			}
		}
		if(getDateFormat() == 'm-d-Y'){
			$s_date=date('Y-m-d',strtotime(str_replace('-','/',$request->date)));
		}
		else{
			$s_date=date('Y-m-d',strtotime($request->date));
		}

		$sales = Sale::find($id);
		$sales->customer_id = $request->cus_name;		
		$sales->bill_no = $request->bill_no;
		$sales->date =$s_date;
		$sales->vehicle_brand = $request->vehi_bra_name;
		$sales->chassisno = $request->chassis;
		$sales->vehicle_id = $request->vehicale_name;
		$sales->color_id = $request->color;		
		$sales->price = $request->price;
		$sales->total_price = $request->total_price;
		$sales->no_of_services = $request->no_of_services;
		$sales->interval = $request->interval;
		$sales->date_gap = $request->date_gape;
		$sales->assigne_to = $request->assigne_to;
		$sales->salesmanname = $request->salesmanname;
		$sales->branch_id = $request->branch;
		//$sales->quantity = $request->qty;
		// $sales->status = $request->status;		
		// $sales->payment_type_id = $request->payment;

		//Custom Field Data
		$custom = $request->custom;
		$custom_fileld_value = array();	
		$custom_fileld_value_jason_array = array();
		if(!empty($custom))
		{
			foreach($custom as $key=>$value)
			{
				if (is_array($value)) {
					$add_one_in = implode(",",$value);
					$custom_fileld_value[] = array("id" => "$key", "value" => "$add_one_in");
				}
				else{
					$custom_fileld_value[] = array("id" => "$key", "value" => "$value");	
				}				
			}	
		   
			$custom_fileld_value_jason_array['custom_fileld_value'] = json_encode($custom_fileld_value); 
			foreach($custom_fileld_value_jason_array as $key1 => $val1){
				$salesData = $val1;
			}	
			$sales->custom_field = $salesData;
		}
		
		$sales->save();
		
		$service = $request->service;
		if(!empty($service)){
			foreach($service['service_date'] as $key => $value)
			{	
				$date = $service['service_date'][$key];
				$new_date = strtok($date, " ");
				$title = $service['service_text'][$key];
				$job = $service['service_job'][$key];
				
				$services = new Service;
				$services->job_no = $job;
				$services->service_type = 'free';
				$services->sales_id = $id;
				$services->service_date = $new_date;
				$services->full_date = $date;
				$services->title = $title;
				$services->done_status = 2;
				$services->assign_to = $request->assigne_to;
				$services->customer_id = $request->cus_name;
				$services->vehicle_id = $request->vehicale_name;
				$services->save();	
			}
		}				
		return redirect('sales/list')->with('message','Successfully Updated');
	}
}	