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

        $borrower = $request->session()->get('borrower');
        $branch_libraries = $this->get_branch_libraries();

        // clear session data
        $request->session()->forget('borrower');

        return view('borrower.create-step1')
            ->with(compact('borrower', $borrower))
            ->with(compact('branch_libraries', $branch_libraries))
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

        $borrower = $this->build_borrower($validatedData);
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
        dd($borrower);
        return view('borrower.create-step2')
          ->with(compact('borrower', $borrower));
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
          ->with(compact('borrower', $borrower));
    }



    public function store(Request $request)
    {

       $borrower = $request->session()->get('borrower');
       $error_email = $_ENV['MAIL_ERROR_EMAIL_ADDRESS'] ?? 'dev.library@mcgill.ca';

       // Verify the email before sending or creating a record.
       if (!$this->verify_real_email($error_email, $borrower)) {

            $error_msg = "The email address $borrower->borrower_email does not exist. Please check your spelling.";
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

    private function build_borrower($request) {
        $borrower = new \stdClass();
        $borrower->data = $request;
        $borrower->branch_library_value  = $request['branch_library'];
        $borrower->branch_library_name = $this->get_branch_name($request['branch_library']);
        $borrower->branch_library_email = $this->get_branch_email($request['branch_library']);

        $borrower->prof_name = $request['prof_name'];
        $borrower->prof_telephone = $request['prof_telephone'];
        $borrower->prof_dept = $request['prof_dept'];

        $borrower->borrower_name = $request['borrower_name'];
        $borrower->borrower_email = $request['borrower_email'];
        $borrower->borrower_address = $request['borrower_address'] ?? null;
        $borrower->borrower_auth_to = $request['borrower_auth_to'];
        $borrower->borrower_auth_from = $request['borrower_auth_from'] ?? null;
        $borrower->borrower_status = $request['borrower_status'];
        $borrower->borrower_telephone = $request['borrower_telephone'] ?? null;
        $borrower->borrower_terms = $request['borrower_terms'];


        return $borrower;
    }

    public function get_branch_libraries() {
      $branch_libraries = Yaml::parse(
        file_get_contents(base_path().'/branch_libraries.yml'));
      $keys = array_column($branch_libraries['branches'], 'label', 'key');
      return $keys;
    }

    public function get_branch_name($branch_value) {
     $data = Yaml::parse(file_get_contents(base_path().'/branch_libraries.yml'));
     $key = array_search($branch_value, array_column($data['branches'], 'key'));
     return $data['branches'][$key]['label'];
    }

    public function get_branch_email($branch_value) {
     $data = Yaml::parse(file_get_contents(base_path().'/branch_libraries.yml'));
     $key = array_search($branch_value, array_column($data['branches'], 'key'));
     return $data['branches'][$key]['email'];
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
