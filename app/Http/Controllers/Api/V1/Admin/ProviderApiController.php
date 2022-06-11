<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
