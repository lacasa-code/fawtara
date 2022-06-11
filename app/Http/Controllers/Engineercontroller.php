<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Mail;
use Auth;

use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\User;
use App\tbl_sales;
use App\tbl_colors;
use App\tbl_services;
use App\tbl_vehicals;
use App\tbl_rto_taxes;
use App\tbl_sales_taxes;
use App\tbl_mail_notifications;
use App\Service;
use App\Sale;
use App\MailNotification;
use App\Role;
use App\Role_user;
use App\CustomField;
use App\Branch;
use App\BranchSetting;
use App\Http\Requests\SupportstaffAddEditFormRequest;

class Engineerstaffcontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


	//supportstaff list
	public function index()
	{
	    $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();

		if (isAdmin(Auth::User()->role_id))
		{
			$supportstaff = User::where([['role','=','engineer'],['soft_delete',0], ['branch_id',$adminCurrentBranch->branch_id]])->orderBy('id','DESC')->get();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$supportstaff = User::where([['role','=','engineer'],['soft_delete',0]])->orderBy('id','DESC')->get();
		}
		else
		{
			$supportstaff = User::where([['role','=','engineer'],['soft_delete',0], ['branch_id',$currentUser->branch_id]])->orderBy('id','DESC')->get();
		}

		return view('engineer.list',compact('supportstaff'));
	}


	//supportstaff add form
	public function supportstaffadd()
	{
		$country = DB::table('tbl_countries')->get()->toArray();
		$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','engineer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();

		if (isAdmin(Auth::User()->role_id)){

			$branchDatas = Branch::where('id', $adminCurrentBranch->branch_id)->get();
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$branchDatas = Branch::get();
		}
		else{
			$branchDatas = Branch::where('id', $currentUser->branch_id)->get();
		}

		return view('engineer.add',compact('country','tbl_custom_fields', 'branchDatas'));
	}

	//supportstaff store
	public function store_supportstaff(SupportstaffAddEditFormRequest $request)
	{
		//dd($request->all());
		$email = $request->email;
		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
        $employeeid =$request->employeeid;
		$gender = $request->gender;
		$birthdate = $request->dob;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;

		$dob = null;
		if(!empty($birthdate))
		{
			if(getDateFormat() == 'm-d-Y'){
				$dob = date('Y-m-d',strtotime(str_replace('-','/', $birthdate)));
			}
			else{
				$dob = date('Y-m-d',strtotime($birthdate));
			}
		}
        if(getDateFormat() == 'm-d-Y')
        {
            //$dob=date('Y-m-d',strtotime(str_replace('-','/',Input::get('dob'))));
            $join_date = date('Y-m-d',strtotime(str_replace('-','/',$request->join_date)));
            $leftdate = $request->left_date;

            if($leftdate == ''){
                $left_date = "";
            }
            else{
                $left_date = date('Y-m-d',strtotime(str_replace('-','/',$request->left_date)));
            }
        }
        else
        {
            //$dob=date('Y-m-d',strtotime(Input::get('dob')));
            $join_date = date('Y-m-d',strtotime($request->join_date));
            $leftdate = $request->left_date;

            if($leftdate == ''){
                $left_date = "";
            }
            else{
                $left_date = date('Y-m-d',strtotime($request->left_date));
            }
        }

		//Get user role id from Role table
		$getRoleId = Role::where('role_name', '=', 'Engineer')->first();

		$supportstaff = new User;
		$supportstaff->name = $firstname;
		$supportstaff->lastname = $lastname;
		$supportstaff->display_name = $displayname;
        $supportstaff->employeeid =$employeeid;
        $supportstaff->join_date = $join_date;
		$supportstaff->gender = $gender;
		$supportstaff->birth_date = $dob;
		$supportstaff->email = $email;

		$supportstaff->password = bcrypt($password);
		$supportstaff->mobile_no = $mobile;
		$supportstaff->landline_no = $landlineno;
		$supportstaff->address = $address;
		$supportstaff->country_id = $country;
		$supportstaff->state_id = $state;
		$supportstaff->city_id = $city;
		$supportstaff->branch_id = $request->branch;


		$image = $request->image;
		if(!empty($image)){
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path().'/engineer/', $file->getClientOriginalName());
			$supportstaff->image = $filename;
		}
		else{
			$supportstaff->image = 'avtar.png';
		}

		$supportstaff->role_id = $getRoleId->id; /*Store Role table User Role Id*/

		$supportstaff->role = "engineer";
		$supportstaff->language = "en";
		$supportstaff->timezone = "UTC";

		//custom field
		$custom = $request->custom;
		$custom_fileld_value = array();
		$custom_fileld_value_jason_array = array();

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
				$supportstaffData = $val1;
			}
			$supportstaff->custom_field = $supportstaffData;
		}
		$supportstaff -> save();

		/*For data store inside Role_user table*/
		if ($supportstaff->save())
		{
			$currentUserId = $supportstaff->id;

			$role_user_table = new Role_user;
			$role_user_table->user_id = $currentUserId;
			$role_user_table->role_id = $getRoleId->id;
			$role_user_table->save();
		}

		//email format
		$logo = DB::table('tbl_settings')->first();
		$systemname = $logo->system_name;
		$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
		if($emailformats->is_send == 0)
		{
			if($supportstaff -> save()){
				$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
				$mail_format = $emailformat->notification_text;
				$mail_subjects = $emailformat->subject;
				$mail_send_from = $emailformat->send_from;
				$search1 = array('{ system_name }');
				$replace1 = array($systemname);
				$mail_sub = str_replace($search1, $replace1, $mail_subjects);

				$systemlink = URL::to('/');
				$search = array('{ system_name }','{ user_name }', '{ email }', '{ Password }', '{ system_link }' );
				$replace = array($systemname, $firstname, $email, $password, $systemlink);

				$email_content = str_replace($search, $replace, $mail_format);
				$actual_link = $_SERVER['HTTP_HOST'];
			     $startip = '0.0.0.0';
			    $endip = '255.255.255.255';
				if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip ))
				{

					//local format email
					$data = array(
					'email'=>$email,
					'mail_sub1' => $mail_sub,
					'email_content1' => $email_content,
					'emailsend' =>$mail_send_from,
					);
					$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

						$message->from($data['emailsend'],'noreply');
						$message->to($data['email'])->subject($data['mail_sub1']);
					});
				}
				else
				{
					//live format email
					$headers = 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
					$headers .= 'From:'. $mail_send_from . "\r\n";
					$data = mail($email,$mail_sub,$email_content,$headers);
				}
			}
		}

		return redirect('/engineer/list')->with('message','Successfully Submitted');
	}


	//supportstaff show
	public function supportstaff_show($id)
	{
		$viewid = $id;
	    $supportstaff = User::where('id','=',$id)->first();
		$service = Service::where([['customer_id','=',$id],['done_status','=','1']])->get();
		$servic = Service::where([['customer_id','=',$id],['done_status','=','2']])->get();
		$sales = Sale::where('customer_id','=',$id)->get();
		$taxes = DB::table('tbl_sales_taxes')->where('sales_id','=',$id)->get()->toArray();
		$tbl_custom_fields = CustomField::where([['form_name','=','supportstaff'],['always_visable','=','yes']])->get();

		return view('engineer.view',compact('supportstaff','viewid','sales','service','servic','tbl_custom_fields'));
	}

	//supportstaff delete
    public function destory($id)
	{
		//$supportstaff = DB::table('users')->where('id','=',$id)->delete();
		$supportstaff = User::where('id','=',$id)->update(['soft_delete' => 1]);

		return redirect('/engineer/list')->with('message','Successfully Deleted');
	}

	//supportstaff edit
    public function edit($id)
	{

	    $editid = $id;
	    $currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();

	    if (!isAdmin(Auth::User()->role_id))
	    {
			if (Gate::allows('engineer_owndata'))
			{
				if (Auth::User()->id == $id) {
					$country = DB::table('tbl_countries')->get()->toArray();
					$supportstaff = DB::table('users')->where('id','=',$id)->first();

					$state = DB::table('tbl_states')->where('country_id', $supportstaff->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $supportstaff->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','engineer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('engineer.update',compact('country','supportstaff','state','city','editid','tbl_custom_fields', 'branchDatas'));
				}
				else if (Gate::allows('supportstaff_edit'))
				{
					$country = DB::table('tbl_countries')->get()->toArray();
					$supportstaff = DB::table('users')->where('id','=',$id)->first();

					$state = DB::table('tbl_states')->where('country_id', $supportstaff->country_id)->get()->toArray();
					$city = DB::table('tbl_cities')->where('state_id', $supportstaff->state_id)->get()->toArray();

					$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','engineer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

					$branchDatas = Branch::where('id', '=', $currentUser->branch_id)->get();

					return view('engineer.update',compact('country','supportstaff','state','city','editid','tbl_custom_fields', 'branchDatas'));
				}
				else
				{
					return abort('403', 'This action is unauthorized.');
				}
			}
			else if (Gate::allows('engineer_edit'))
			{
				$country = DB::table('tbl_countries')->get()->toArray();
				$supportstaff = DB::table('users')->where('id','=',$id)->first();

				$state = DB::table('tbl_states')->where('country_id', $supportstaff->country_id)->get()->toArray();
				$city = DB::table('tbl_cities')->where('state_id', $supportstaff->state_id)->get()->toArray();

				$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','engineer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();

				if (getUsersRole(Auth::User()->role_id) == "Customer") {
					$branchDatas = Branch::get();
				}
				else {
					$branchDatas = Branch::where('id',$currentUser->branch_id)->get();
				}

				return view('engineer.update',compact('country','supportstaff','state','city','editid','tbl_custom_fields', 'branchDatas'));
			}
			else
			{
				return abort('403', 'This action is unauthorized.');
			}
		}
		else
		{
			$country = DB::table('tbl_countries')->get()->toArray();
			$supportstaff = DB::table('users')->where('id','=',$id)->first();
			$state = DB::table('tbl_states')->where('country_id', $supportstaff->country_id)->get()->toArray();
			$city = DB::table('tbl_cities')->where('state_id', $supportstaff->state_id)->get()->toArray();
			$tbl_custom_fields = DB::table('tbl_custom_fields')->where([['form_name','=','engineer'],['always_visable','=','yes'],['soft_delete','=',0]])->get()->toArray();
			$branchDatas = Branch::get();

			return view('engineer.update',compact('country','supportstaff','state','city','editid','tbl_custom_fields', 'branchDatas'));
		}
	}

	//supportstaff update
    public function update($id, SupportstaffAddEditFormRequest $request)
	{
		//dd($request->all());
		$usimgdtaa = DB::table('users')->where('id','=',$id)->first();
        if(getDateFormat() == 'm-d-Y')
        {
            //$dob=date('Y-m-d',strtotime(str_replace('-','/',Input::get('dob'))));
            $join_date = date('Y-m-d',strtotime(str_replace('-','/', $request->join_date)));

            $leftdate = $request->left_date;

            if($leftdate == ''){
                $left_date = "";
            }
            else{
                $left_date = date('Y-m-d',strtotime(str_replace('-','/', $request->left_date)));
            }
        }
        else
        {
            //$dob=date('Y-m-d',strtotime(Input::get('dob')));
            $join_date = date('Y-m-d',strtotime( $request->join_date));

            $leftdate = $request->left_date;

            if($leftdate == ''){
                $left_date = "";
            }
            else{
                $left_date = date('Y-m-d',strtotime($request->left_date));
            }
        }
		$email = $usimgdtaa->email;

		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$displayname = $request->displayname;
        $employeeid = $request->employeeid;
		$gender = $request->gender;
		$email = $request->email;
		$join_date = $request->join_date;
		$password = $request->password;
		$mobile = $request->mobile;
		$landlineno = $request->landlineno;
		$address = $request->address;
		$country = $request->country_id;
		$state = $request->state_id;
		$city = $request->city;
		$birtDate = $request->dob;

		$dob = null;
		if(!empty($birtDate))
		{
			if(getDateFormat() == 'm-d-Y'){
				$dob = date('Y-m-d',strtotime(str_replace('-','/', $birtDate)));
			}
			else{
				$dob = date('Y-m-d',strtotime($birtDate));
			}
		}

	    $supportstaff = User::find($id);
	    $supportstaff->name = $firstname;
		$supportstaff->lastname = $lastname;
        $supportstaff->employeeid = $employeeid;
        $supportstaff->join_date = $join_date;
		$supportstaff->display_name = $displayname;
		$supportstaff->gender = $gender;
		$supportstaff->birth_date = $dob;
		$supportstaff->email = $email;

		if(!empty($password)){
			$supportstaff->password = bcrypt($password);
		}

		$supportstaff->mobile_no = $mobile;
		$supportstaff->landline_no = $landlineno;
		$supportstaff->address = $address;
		$supportstaff->country_id = $country;
		$supportstaff->state_id = $state;
		$supportstaff->city_id = $city;
		$supportstaff->branch_id = $request->branch;

		$image = $request->image;
		if(!empty($image)){
			$file = $image;
			$filename = $file->getClientOriginalName();
			$file->move(public_path().'/engineer/', $file->getClientOriginalName());
			$supportstaff->image = $filename;
		}
		$supportstaff->role = "engineer";

		//custom field
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
				$supportstaffData = $val1;
			}
			$supportstaff->custom_field = $supportstaffData;
		}
		$supportstaff->save();

		//email format
		$logo = DB::table('tbl_settings')->first();
		$systemname = $logo->system_name;
		$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
		if($emailformats->is_send == 0)
		{
			if($supportstaff -> save())
			{
				$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
				$mail_format = $emailformat->notification_text;
				$mail_subjects = $emailformat->subject;
				$mail_send_from = $emailformat->send_from;
				$search1 = array('{ system_name }');
				$replace1 = array($systemname);
				$mail_sub = str_replace($search1, $replace1, $mail_subjects);
				$systemlink = URL::to('/');
				$search = array('{ system_name }','{ user_name }', '{ email }', '{ Password }', '{ system_link }' );
				$replace = array($systemname, $firstname, $email, $password, $systemlink);

				$email_content = str_replace($search, $replace, $mail_format);

				$actual_link = $_SERVER['HTTP_HOST'];
			    $startip = '0.0.0.0';
			    $endip = '255.255.255.255';
				if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip ))
				{
					//local format email

					$data = array(
					'email'=>$email,
					'mail_sub1' => $mail_sub,
					'email_content1' => $email_content,
					'emailsend' =>$mail_send_from,
					);
					$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

							$message->from($data['emailsend'],'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
				}
				else
				{
					//live format email
					$headers = 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
					$headers .= 'From:'. $mail_send_from . "\r\n";
					$data = mail($email,$mail_sub,$email_content,$headers);
				}
			}
		}
		return redirect('/engineer/list')->with('message','Successfully Updated');
	}
}
