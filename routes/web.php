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

use Aacotroneo\Saml2\Events\Saml2LogoutEvent;

Route::get('/', function () {
	    return view('borrower');
});

Route::get('/','BorrowerController@createStep1');

Route::get('create-step1', [
	    'uses' => 'BorrowerController@createStep1',
            'as' => 'borrower.create_step_1'
]);//->middleware('auth.saml');

Route::post('create-step1', [
	    'uses' => 'BorrowerController@postCreateStep1',
           'as' => 'borrower.create_step_1'
]);//->middleware('auth.saml');

Route::get('create-step2', [
	    'uses' => 'BorrowerController@createStep2',
            'as' => 'borrower.create_step_2'
]);//->middleware('auth.saml');

Route::get('store', function () {
      return redirect('create-step1');
});//->middleware('auth.saml');

Route::post('store', [
	    'uses' => 'BorrowerController@store',
           'as' => 'borrower.store'
]);//->middleware('auth.saml');

Route::get('success', [
	    'uses' => 'BorrowerController@created',
            'as' => 'borrower.created'
]);

Route::get('error', [
	    'uses' => 'BorrowerController@errorPage',
            'as' => 'borrower.error'
]);


Route::get('/login', function () {
    return Saml2::login(url('/'));
})->name('login');

Route::get('/logout', function () {
    event(new Saml2LogoutEvent());
    return Saml2::logout();
})->name('logout');
