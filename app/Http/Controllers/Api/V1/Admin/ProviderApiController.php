<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class ProviderApiController extends Controller
{
    public function transactaions(Request $request)
    {
    	$pW_file = public_path('aaa/providerW.json');
    	$pX_file = public_path('aaa/providerX.json');
    	$pY_file = public_path('aaa/providerY.json');

    	$pW = json_decode(file_get_contents($pW_file), true);
    	$pX = json_decode(file_get_contents($pX_file), true);
    	$pY = json_decode(file_get_contents($pY_file), true);

    	$files_paths = [basename($pW_file), basename($pX_file), basename($pY_file)];
    	$all  = array($pW, $pX, $pY);
    	 $data = collect($all)
    	->where('status', 'LIKE', $request->statusCode)
    	->filter()
    	->all();
        
        // start case provider
    	if ($request->has('provider') && $request->provider != '') {
    		$target_file =  public_path('aaa/'. $request->provider.'.json');
    		$exist_file = array(file_get_contents($target_file));
	    		return response()->json([
	    		'data' => $exist_file,
	    		'code' => 200,
	    	], 200);
    	} 
    	// end case provider

    	// start case status code
    	if ( ($request->has('statusCode') && $request->statusCode != '') && (!$request->has('amounteMin') || $request->amounteMin == '') && (!$request->has('amounteMax') || $request->amounteMax == '') && (!$request->has('currency') || $request->currency == '') ) {
    		$common = array();
    		$target_status = $request->statusCode;

    		// start paid case
    		if ($target_status == 'paid') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'done' || $value['status'] == 1 || $value['status'] == 100){
	    			     	array_push($common, $value);
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'done' || $value['transactionStatus'] == 1 || $value['transactionStatus'] == 100){
	    			     	array_push($common, $value);
	    		      	}
    				}
    		    }
    		} // end paid case 

    		// start pending case
    		if ($target_status == 'pending') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'wait' || $value['status'] == 2 || $value['status'] == 200){
	    			     	array_push($common, $value);
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'wait' || $value['transactionStatus'] == 2 || $value['transactionStatus'] == 200){
	    			     	array_push($common, $value);
	    		      	}
    				}
    		    }
    		} // end pending case 

    		// start reject case
    		if ($target_status == 'reject') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'nope' || $value['status'] == 3 || $value['status'] == 300){
	    			     	array_push($common, $value);
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'nope' || $value['transactionStatus'] == 3 || $value['transactionStatus'] == 300){
	    			     	array_push($common, $value);
	    		      	}
    				}
    		    }
    		} // end reject case 

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case status code

    	// start case amount
    	if ( ($request->has('amounteMin') && $request->amounteMin != '' && $request->has('amounteMax') && $request->amounteMax != '') && (!$request->has('statusCode') || $request->statusCode == '') && (!$request->has('currency') || $request->currency == '') ) {

    		$common = array();
    		$amounteMin = $request->amounteMin;
    		$amounteMax = $request->amounteMax;
    		
    			foreach ($all as $key => $value) {
    				if (isset($value['amount'])) {
    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
	    			     	array_push($common, $value);
	    		      	}
    				}
    				if (isset($value['transactionAmount'])) {
    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
	    			     	array_push($common, $value);
	    		      	}
    				}
    		    }

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case amount

    	// start case status code and amount
    	if ( ($request->has('statusCode') && $request->statusCode != '' && $request->has('amounteMin') && $request->amounteMin != '' && $request->has('amounteMax') && $request->amounteMax != '') && (!$request->has('currency') || $request->currency == '') ){

    		$common = array();
    		$target_status = $request->statusCode;
    		$amounteMin    = $request->amounteMin;
    		$amounteMax    = $request->amounteMax;

    		// start paid case
    		if ($target_status == 'paid') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'done' || $value['status'] == 1 || $value['status'] == 100){

		    						if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'done' || $value['transactionStatus'] == 1 || $value['transactionStatus'] == 100){
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end paid case 

    		// start pending case
    		if ($target_status == 'pending') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'wait' || $value['status'] == 2 || $value['status'] == 200){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}

	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'wait' || $value['transactionStatus'] == 2 || $value['transactionStatus'] == 200){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}

	    		      	}
    				}
    		    }
    		} // end pending case 

    		// start reject case
    		if ($target_status == 'reject') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'nope' || $value['status'] == 3 || $value['status'] == 300){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'nope' || $value['transactionStatus'] == 3 || $value['transactionStatus'] == 300){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end reject case 

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case status code and amount

    	// start case status code and currency
    	if ( ($request->has('statusCode') && $request->statusCode != '' && $request->has('currency') && $request->currency != '') && (!$request->has('amounteMin') || $request->amounteMin == '') && (!$request->has('amounteMax') || $request->amounteMax == '') ){
    		$common = array();
    		$target_status = $request->statusCode;
    		$currency = $request->currency;

    		// start paid case
    		if ($target_status == 'paid') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'done' || $value['status'] == 1 || $value['status'] == 100){

		    						if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}

	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'done' || $value['transactionStatus'] == 1 || $value['transactionStatus'] == 100){
	    			     	if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end paid case 

    		// start pending case
    		if ($target_status == 'pending') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'wait' || $value['status'] == 2 || $value['status'] == 200){
	    			     	
	    			     	if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}

	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'wait' || $value['transactionStatus'] == 2 || $value['transactionStatus'] == 200){
	    			     	
	    			     	if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}

	    		      	}
    				}
    		    }
    		} // end pending case 

    		// start reject case
    		if ($target_status == 'reject') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'nope' || $value['status'] == 3 || $value['status'] == 300){
	    			     	
	    			     	if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'nope' || $value['transactionStatus'] == 3 || $value['transactionStatus'] == 300){
	    			     	
	    			     	if (isset($value['currency'])) {
				    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
				    				if (isset($value['Currency'])) {
				    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
					    			     	array_push($common, $value);
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end reject case 

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case status code and currency

    	// start case amount and currency
    	if ( (!$request->has('statusCode') || $request->statusCode == '') && ($request->has('currency') && $request->currency != '') && ($request->has('amounteMin') && $request->amounteMin != '') && ($request->has('amounteMax') && $request->amounteMax != '') ){
    		$common = array();
    		$amounteMin    = $request->amounteMin;
    		$amounteMax    = $request->amounteMax;
    		$currency      = $request->currency;

    		// start paid case
    			foreach ($all as $key => $value) {

		    						if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){

					    			     	    if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){

					    			         	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
    		
    		} // end foreach	

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case status code and currency

    	// start case status code , amount and currency
    	if ( ($request->has('statusCode') && $request->statusCode != '') && ($request->has('amounteMin') && $request->amounteMin != '') && ($request->has('amounteMax') && $request->amounteMax != '') && ($request->has('currency') && $request->currency != '') ){

    		$common = array();
    		$target_status = $request->statusCode;
    		$amounteMin    = $request->amounteMin;
    		$amounteMax    = $request->amounteMax;
    		$currency      = $request->currency;

    		// start paid case
    		if ($target_status == 'paid') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'done' || $value['status'] == 1 || $value['status'] == 100){

		    						if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){

					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){

					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'done' || $value['transactionStatus'] == 1 || $value['transactionStatus'] == 100){
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end paid case 

    		// start pending case
    		if ($target_status == 'pending') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'wait' || $value['status'] == 2 || $value['status'] == 200){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}

	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'wait' || $value['transactionStatus'] == 2 || $value['transactionStatus'] == 200){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}

	    		      	}
    				}
    		    }
    		} // end pending case 

    		// start reject case
    		if ($target_status == 'reject') { 
    			foreach ($all as $key => $value) {
    				if (isset($value['status'])) {
    					if($value['status'] == 'nope' || $value['status'] == 3 || $value['status'] == 300){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
	    		      	}
    				}
    				if (isset($value['transactionStatus'])) {
    					if($value['transactionStatus'] == 'nope' || $value['transactionStatus'] == 3 || $value['transactionStatus'] == 300){
	    			     	
	    			     	if (isset($value['amount'])) {
				    					if( ($value['amount'] >= $amounteMin) && ($value['amount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
				    				if (isset($value['transactionAmount'])) {
				    					if( ($value['transactionAmount'] >= $amounteMin) && ($value['transactionAmount'] <= $amounteMax) ){
					    			     	
					    			     	if (isset($value['currency'])) {
								    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
								    			}
							    				if (isset($value['Currency'])) {
								    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
									    			     	array_push($common, $value);
									    		      	}
							    				}
					    		      	}
				    				}
	    		      	}
    				}
    		    }
    		} // end reject case 

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case status code , amount and currency

    	// start case currency
    		if ( (!$request->has('amounteMin') || $request->amounteMin == '') && (!$request->has('amounteMax') || $request->amounteMax == '') && (!$request->has('statusCode') || $request->statusCode == '') && ($request->has('currency') && $request->currency == '') ) {

    		$common = array();
    		$currency = $request->currency;
    		
    			foreach ($all as $key => $value) {
    				if (isset($value['currency'])) {
    					if( ($value['currency'] == strtolower($currency)) || ($value['currency'] == strtoupper($currency)) ){
	    			     	array_push($common, $value);
	    		      	}
    				}
    				if (isset($value['Currency'])) {
    					if( ($value['Currency'] == strtolower($currency)) || ($value['Currency'] == strtoupper($currency)) ){
	    			     	array_push($common, $value);
	    		      	}
    				}
    		    }

	    		return response()->json([
	    		'data' => $common,
	    		'code' => 200,
	    	], 200);
    	}  
    	// end case currency

    	return response()->json([
    		'data' => $all,
    		'code' => 200,
    	], 200);
    	//return $all;
	}
	


	public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
        }
        if ($validator->fails()) 
        {
            return response()->json(['status'=>false,'message'=>$validator->errors(),'code'=>400],400);
        }
        if (! $token = auth()->attempt($validator->validated()))
        {
            return response()->json(
                ['status'=>false,
                'message'=>trans('app.log_in_error'),
                'code'=>401],401);
        }
        
        $user = auth()->user();
        $user->last_login=Carbon::now();
        return $this->createNewToken($token);

    }

    public function logout() 
    {
        auth()->logout();
        return response()->json(['status'=>true,'message'=>trans('app.logout_success'),'code'=>200],200);
    }

    public function refresh() 
    {
        
        return $this->createNewToken(auth()->refresh());
    
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'status'=>true,
            'message'=>trans('app.token_success'),
            'code'=>201,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'data' => auth()->user()
        ],201);
    }

    public function userProfile()
    {
        return response()->json([
            'status'=>true,
            'message'=>trans('app.userProfile'),
            'code'=>200,
            'data' => auth()->user()           
        ],200);
    }

    public function isValidToken(Request $request)
    {
        
            return response()->json([
                'status'=>true,
                'message'=>trans('app.valid'),
                'code'=>200,
                'data' => auth()->check()           
            ],200); 

    }

}
