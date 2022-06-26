<?php

use Illuminate\Http\Request;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
	Route::get('/transactaions', 'ProviderApiController@transactaions')->name('admin.transactaions');
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::get('/v', 'InvoiceController@get_jobcard_no')->name('admin.get_jobcard_no');
});

*/

use App\Http\Controllers\Auth\VerifyEmailController;


//auth routes
Route::middleware([ 'api'])->group(function () {

    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

});