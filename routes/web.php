<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	    return view('borrower');
});

Route::get('/','BorrowerController@createStep1');

Route::get('success', [
	    'uses' => 'BorrowerController@created',
            'as' => 'borrower.created'
]);
Route::get('error', [
	    'uses' => 'BorrowerController@errorPage',
            'as' => 'borrower.error'
]);


Route::get('create-step1', [
	    'uses' => 'BorrowerController@createStep1',
            'as' => 'borrower.create_step_1'
]);
Route::post('create-step1', [
	    'uses' => 'BorrowerController@postCreateStep1',
           'as' => 'borrower.create_step_1'
]);

Route::get('create-step2', [
	    'uses' => 'BorrowerController@createStep2',
            'as' => 'borrower.create_step_2'
]);

Route::get('store', function () {
      return redirect('create-step1');
});
Route::post('store', [
	    'uses' => 'BorrowerController@store',
           'as' => 'borrower.store'
]);

Route::get('/login', function () {
    return Saml2::login(url('/'));
});

Route::get('/logout', function () {
    $url = route('saml_logout');
    return redirect($url);
});
