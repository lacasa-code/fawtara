<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use URL;
use PDF;
use Mail;
use Auth;

use App\Http\Requests;
use Illuminate\Mail\Mailer;
use App\Illuminate\Support\Facades\Gate;

use App\User;
use App\tbl_incomes;
use App\tbl_services;
use App\tbl_invoices;
use App\tbl_payment_records;
use App\tbl_income_history_records;

use App\Invoice;
use App\Service;
use App\Income;
use App\IncomeHistoryRecord;
use App\Sale;
use App\MailNotification;
use App\CustomField;
use App\Updatekey;
use App\Setting;
use App\JobcardDetail;
use App\Vehicle;
use App\RtoTax;
use App\SalePart;
use App\Product;
use App\Washbay;
use App\Branch;
use App\BranchSetting;

/*Following path is for invoice sales and service add and edit form*/
use App\Http\Requests\InvoiceAddEditFormRequest;
/*Following path is only for invoice salespart edit form*/
use App\Http\Requests\StoreInvoiceEditFormRequest;

class InvoiceController extends Controller
{
    //get jobcard number for which service has not generated Invoice
	public function get_jobcard_no(Request $request)
	{	
		$cus_id = 27;//$request->cus_name;

		$currentUser = User::where([['soft_delete',0],['id','=',1]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();
		
		if (isAdmin(1)){			
			$getJobcardNoFromServiceTbl = DB::table('tbl_services')->where([['customer_id','=', $cus_id],['done_status','=',1],['job_no','like','J%'], ['branch_id',$adminCurrentBranch->branch_id]])->where('soft_delete', 0)->get()->toArray();
			$invoiceTblJobcardNo = DB::table('tbl_invoices')->where([['customer_id','=', $cus_id],['job_card','like','J%'],['type', '=', 0], ['branch_id',$adminCurrentBranch->branch_id]])->where('soft_delete', 0)->get()->toArray();
		}
		elseif (getUsersRole(1) == 'Customer') {
			$getJobcardNoFromServiceTbl = DB::table('tbl_services')->where([['customer_id','=', $cus_id],['done_status','=',1],['job_no','like','J%']])->get()->toArray();
			$invoiceTblJobcardNo = DB::table('tbl_invoices')->where([['customer_id','=', $cus_id],['job_card','like','J%'],['type', '=', 0]])->get()->toArray();
		}
		else{
			$getJobcardNoFromServiceTbl = DB::table('tbl_services')->where([['customer_id','=', $cus_id],['done_status','=',1],['job_no','like','J%'], ['branch_id',$currentUser->branch_id]])->get()->toArray();
			$invoiceTblJobcardNo = DB::table('tbl_invoices')->where([['customer_id','=', $cus_id],['job_card','like','J%'],['type', '=', 0], ['branch_id',$currentUser->branch_id]])->get()->toArray();
		}

		$serviceTblJobcardArray = array();
		foreach ($getJobcardNoFromServiceTbl as $getJobcardNoFromServiceTbls) {
			$serviceTblJobcardArray[]	= $getJobcardNoFromServiceTbls->job_no;		
		}

		$invoiceTblJobcardArray = array();
		foreach ($invoiceTblJobcardNo as $invoiceTblJobcardNos) {
			$invoiceTblJobcardArray[] = $invoiceTblJobcardNos->job_card;
		}

		$diff_value = array_diff($serviceTblJobcardArray, $invoiceTblJobcardArray);
		$diff_normalvalue = implode(',', $diff_value);
		$getJobcardServiceTbl = DB::table('tbl_services')->where('job_no','=', $diff_normalvalue)->get()->toArray();

		?>

		<?php if($diff_normalvalue == '') { 
			foreach ($getJobcardServiceTbl as $getJobcardServiceTbls) { ?>
			<option class="invoice_job_number" value="<?php echo $getJobcardServiceTbls->job_no; ?>" >		<?php echo $getJobcardServiceTbls->job_no; ?>
			</option>
		<?php } } else{  foreach ($getJobcardServiceTbl as $getJobcardServiceTbls) { ?>

			<option class="invoice_job_number" value="<?php echo $getJobcardServiceTbls->job_no; ?>" >		<?php echo $getJobcardServiceTbls->job_no; ?>
			</option>

		<?php } } ?>

		<?php 
	}
	
}
