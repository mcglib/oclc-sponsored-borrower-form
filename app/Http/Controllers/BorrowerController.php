<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Routing\Controller as BaseController;
use App\Forms\BorrowerForm;
use App\Mail\AccountCreated;
use App\Mail\OclcError;
use App\Mail\GeneralError;
use App\Extlog;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests\Borrower;
use App\Services\VerifyEmailService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Yaml;
use Mail;

if ($_ENV['APP_ENV'] ==='production') {
  putenv($_ENV['PROXY_HTTPS']);
  putenv($_ENV['PROXY_HTTP']);
}


class BorrowerController extends BaseController {
    use FormBuilderTrait;
    use ValidatesRequests;
    private $form_session = 'register_form';

    public function createStep1(Request $request)
    {

	$borrower_categories = $this->get_borrower_categories();
        $home_institutions = $this->get_home_institutions();
	$borrower = $request->session()->get('borrower');

	// clear session data
	$request->session()->forget('borrower');

	
	$form = $this->form(BorrowerForm::class, [
		            'method' => 'POST',
		            'route' => 'borrower.create_step_2'
        ]);
	return view('borrower.create-step1')
		->with(compact('borrower_categories', $borrower_categories))
		->with(compact('home_institutions', $home_institutions))
		->with(compact('borrower', $borrower))
	;

    }

     /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Borrower $request)
    {
	    $validatedData = $request->validated();
	    
	    $borrower = new \App\Oclc\Borrower($validatedData);
            $request->session()->put('borrower', $borrower);
        return redirect('/create-step2');
    }

    /**
     * Show the step 2 Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request)
    {
        $borrower = $request->session()->get('borrower');
        $home_institutions = $this->get_home_institutions();
        return view('borrower.create-step2')
          ->with(compact('borrower', $borrower))
          ->with(compact('home_institutions', $home_institutions))
        ;
    }
    public function created(Request $request)
    {
	$borrower = $request->session()->get('borrower');

	if (is_null($borrower)) {
		// clear session data
        	$request->session()->flush();
        	return redirect('/create-step1');
	}
	// clear session data
        $request->session()->flush();
        return view('borrower.success')
          ->with(compact('borrower', $borrower));
    }
    public function errorPage(Request $request)
    {
        $borrower = $request->session()->get('borrower');
        return view('borrower.error')
          ->with(compact('borrower', $borrower))
	  ;
    }



    public function store(Request $request)
    {

       $borrower = $request->session()->get('borrower');
       $error_email = $_ENV['MAIL_ERROR_EMAIL_ADDRESS'] ?? 'dev.library@mcgill.ca';
       
       // Verify the email before sending or creating a record.
       if (!$this->verify_real_email($error_email, $borrower)) {

            $error_msg = "The email address $borrower->email does not exist. Please check your spelling.";
	    Mail::to($error_email)->send(new GeneralError($borrower, $error_msg));

	    $request->session()->flash('message', $error_msg);
       	    return redirect('error')
                   ->with('error', $error_msg);
       }


       if ($borrower->create()){

            return redirect()->route('borrower.created')
                   ->with('success',
            		'Congratulations, your request has been received!');
       }else {
         // Error occured.
         $borrower->error_msg();
	 
	 // Send the email with the data
	 Mail::to($error_email)->send(new OclcError($borrower));

         // Redirect to the form.
         return redirect('error')
           ->with('oclcerror',
             'An Error has occured creating an OCLC record for you.');
       }
       
       // clear session data
       $request->session()->flush();
    }
    public function get_borrower_categories() {
      $borrowers = Yaml::parse(
		    file_get_contents(base_path().'/borrowing_categories.yml'));
      $keys = array_column($borrowers['categories'], 'label', 'key');
      return $keys;
    }

    public function get_home_institutions() {
      $borrowers = Yaml::parse(
		    file_get_contents(base_path().'/home_institutions.yml'));
      $keys = $borrowers['institutions'];
      return $keys;
    }
    public function verify_real_email($error_email, $borrower) {

        $valid = true;
    	// Initialize library class
	$mail = new VerifyEmailService();

	// Set the timeout value on stream
	$mail->setStreamTimeoutWait(20);

	// Set debug output mode
	$mail->Debug= TRUE; 
	$mail->Debugoutput= 'html'; 

	// Set email address for SMTP request
	$mail->setEmailFrom($error_email);

	// Email to check
	// check the result of the mail before creating the account
        try{
       		$result = Mail::to($borrower->email)->send(new AccountCreated($borrower));
	}catch(\Swift_TransportException $e){
		$response = $e->getMessage() ;
		$valid = false;
	}


	// Check if email is valid and exist
	return $valid;
    
    }

}
