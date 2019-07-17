<?php
namespace App\Oclc;
use OCLC\Auth\WSKey;
use OCLC\Auth\AccessToken;
use OCLC\User;
use App\Extlog;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;
use Yaml;

class Borrower {
    /**
     * The valid field.
     *
     * @var string
     */
    public $borrower_fname;
    public $borrower_lname;
    public $data = [];
    public $borrower_email;
    public $borrower_telephone;
    public $borrower_cat;
    public $borrower_city;
    public $borrower_address1;
    public $borrower_address2;
    public $borrower_enddate, $borrower_startdate;
    public $borrower_postal_code, $borrower_province_state;
    public $prof_name, $prof_dept, $prof_email;
    public $expiry_date;
    public $barcode;

    private $id;
    private $circInfo = [];
    private $defaultType = 'home';
    private $status;
    private $serviceUrl = '.share.worldcat.org/idaas/scim/v2';
    private $authorizationHeader;
    private $barcode_counter_init =  670000;
    private $oclc_data;
    private $error_msg;

    private $eTag;
    private $borrowerCategory = 'McGill community borrower';
    private $homeBranch = 262754; // Maybe 262754
    private $institutionId;

    function __construct($request) {
	   // Set the variables
	    $this->data = $request;

	   $this->borrower_fname = $request['borrower_fname'];
	   $this->borrower_lname = $request['borrower_lname'];
	   $this->borrower_email = $request['borrower_email'];
	   $this->borrower_cat = $request['borrower_cat'];
	   $this->borrower_telephone = $request['borrower_telephone'] ?? null;
	   $this->prof_name = $request['prof_name'] ?? null;
	   $this->prof_dept = $request['prof_dept'] ?? null;
	   $this->prof_email = $request['prof_email'] ?? null;
	   $this->borrower_city = $request['borrower_city'] ?? null;
	   $this->borrower_address1 = $request['borrower_address1'] ?? null;
	   $this->borrower_address2 = $request['borrower_address2'] ?? null;
	   $this->borrower_postal_code = $request['borrower_postal_code'] ?? null;
	   $this->borrower_enddate = $request['borrower_enddate'] ?? null;
	   $this->borrower_startdate = $request['borrower_startdate'] ?? null;
	   $this->borrower_province_state = $request['borrower_province_state'] ?? "Quebec";


       $oclc_config = config('oclc.connections.development');

	   $this->institutionId = $oclc_config['institution_id'];

	   $this->homeBranch = $oclc_config['home_branch'];

	   // set the address
       $this->addAddress($request);

	   // set the expiry date
	   $this->expiry_date = $this->setExpiryDate($request['borrower_enddate']);

       // Generate the barcode
	   $this->barcode = $this->generateBarCode();
    }
    public function create() {


      $url = 'https://' . $this->institutionId . $this->serviceUrl . '/Users/';
      $this->getAuth($url);

      // Send the request to create a record
      $state = $this->sendRequest($url, $this->getData());

      $status = $state['status'];

      // if success save data to $this->oclc_data
      if($state['status'] === 201) {
          $this->oclc_data = $state['body'];
          return TRUE;
      }else {
       	  $this->error_msg = $state['body'];
      }
      return FALSE;

    }

    public function error_msg() {
    	return $this->error_msg;
    }
    public function getAuth($url) {
       $oclc_config = config('oclc.connections.development');
       $key = $oclc_config['api_key'];
       $secret = $oclc_config['api_secret'];
       $inst_id = $oclc_config['institution_id'];

       $services = array('SCIM');

       $user = new User($inst_id, $oclc_config['ppid'], $oclc_config['pdns']);

       $options = array('services' => $services);
       $wskey = new WSKey($key, $secret, $options);
       // provide the WSKEY
       $accessToken = $wskey->getAccessTokenWithClientCredentials($inst_id, $inst_id, $user);


       $this->setAuth($accessToken);

    }

    private function setExpiryDate($end_date) {
       $futureDate = date('Y-m-d', strtotime('+1 year'));
       return $futureDate."T00:00:00Z";


    }
    private function setAuth($token) {
    	$this->authorizationHeader = "Bearer ".$token->getValue();
    }

    private function sendRequest($url, $payload) {
	    $client = new Client(
            [
	           'curl' => []
	    ]);
	    $headers = array();
	    $headers['Authorization'] = $this->authorizationHeader;
	    $headers['User-Agent'] = 'McGill OCLC Client';
	    $headers['Content-Type'] = 'application/scim+json';
	    $body = ['headers' => $headers,
		    'json' => $payload,
            ];
	    // Save the post into a db log
	    $log = new Extlog;
	    $log->email = $this->email;
	    $log->post = json_encode($body);
	    $log->form_data = json_encode($this->data);
	    try {

		  $log->posted_on = Carbon::now();
		  $log->save();

		  // Make the post
		  $response = $client->request('POST', $url, $body);

		  ob_start();
		   echo $response->getBody();
		  $body = ob_get_clean();

		  // get the response and save to db log
		  $log->status = $response->getStatusCode();

		  $log->response = $body;
		  $log->received_on = Carbon::now();
		  $log->save();


		  return array("response" => $response,
			 	 "body" => $body,
				 "status" => $log->status
		  );
	    } catch (RequestException $error) {

		  $log->status = $error->getResponse()->getStatusCode();

		  ob_start();
		  echo (string)$error->getResponse()->getBody();
		  $body = ob_get_clean();

		  $log->response = $body;
		  $log->received_on = Carbon::now();
		  $log->error_msg = $error->getResponse()->getBody()->getContents();
		  $log->save();

		  return array("error" => $error,
			 	 "body" => $body,
				 "status" => $log->status
		  );
	    }

    }

    public function search() {

    }
    public function getBorrowerCategoryName($borrow_cat) {
     $data = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
     $key = array_search($borrow_cat, array_column($data['categories'], 'key'));
     return $data['categories'][$key]['borrower_category'];

    }
    public function getBorrowerCategoryLabel($borrow_cat) {
	 $data = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
	 $key = array_search($borrow_cat, array_column($data['categories'], 'key'));
	 return $data['categories'][$key]['label'];

    }
    public function get_home_institution($key = null) {
      $borrowers = Yaml::parse(
		    file_get_contents(base_path().'/home_institutions.yml'));
      $keys = $borrowers['institutions'];
      if (!is_null($key)) {
        return $keys[$key];
      }
      return null;
    }

    public function getBorrowerCustomData3($borrow_cat) {
	 $data = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
	 $key = array_search($borrow_cat, array_column($data['categories'], 'key'));
	 return $data['categories'][$key]['wms_custom_data_3'];

    }
    public function getBorrowerCustomData2($borrow_cat){
	 $data = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
	 $key = array_search($borrow_cat, array_column($data['categories'], 'key'));
	 $is_home_inst = $data['categories'][$key]['home_institution'];
	 if ($is_home_inst) {
	 	return $this->home_institution;
	 }else {
	 	return $data['categories'][$key]['wms_custom_data_2'];
	 }

    }


    private function addAddress($request) {
	    if (isset($request['borrower_postal_code'])) {
	       $locality = isset($request['borrower_address2']) ? $request['borrower_address2'] : "";
	       $this->addresses[] = [
		"streetAddress" => $request['borrower_address1'],
		"region" => $request['borrower_city'],
		"locality" => $locality,
		"postalCode" => $request['borrower_postal_code'],
		"type" => "",
		"primary" => false
	       ];
	    }

    }

    //**** Accessors ***//
    public function getborrower_fnameAttribute() {
    	return $this->borrower_fname;
    }
    public function getRequestAttribute() {
    	return $this->request;
    }
    public function getEmailAttribute() {
    	return $this->email;
    }
    public function getTelephoneNoAttribute() {
    	return $this->borrower_telephone;
    }
    public function getBarcodeAttribute() {
    	return $this->barcode;
    }
    public function getborrower_lnameAttribute() {
    	return $this->borrower_lname;
    }

    public function generateBarcode() {

	if (Storage::disk('local')->exists('counter')){
	   $curr_val = (int)Storage::disk('local')->get('counter');
	   $curr_val++;
	}else {
	   $curr_val = $this->barcode_counter_init;
	}
	Storage::disk('local')->put('counter', $curr_val);


	// Read the counter
        // increament the last counter
        // write to the counter file
	$str_val = (string)($curr_val);
	//$str_val = substr_replace( $str_val, "-", 3, 0 );
        return "EXT".$str_val;

    }
    private function getAddresses() {
	    if($this->requiresAddress($this->borrower_cat)) {
		    return array(
			    0 => array (
			      'streetAddress' => $this->borrower_address1." ".$this->borrower_address2,
			      'locality' => $this->borrower_city ?? "",
			      'region' => $this->borrower_province_state ?? "",
			      'postalCode' => $this->borrower_postal_code ?? "",
			      //'type' => $this->defaultType,
			      'type' => "",
			      'primary' => false,
			   )
		   );
	    }
	    return null;

    }
    private function requiresAddress($borrow_cat) {
	 $data = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
	 $key = array_search($borrow_cat, array_column($data['categories'], 'key'));
	 return $data['categories'][$key]['need_address'];

    }
    private function  getNotes() {
	if (isset($this->prof_name)) {
	   $data = array(
		       "businessContext" => $this->institutionId,
		       "note" => $this->prof_name
	   );
	   return array($data);

	}
	return array();
    }
    private function getCustomData() {

	// Save data depending on the borrower category
	$custom_data_3 = $this->getBorrowerCustomData3($this->borrower_cat);
	$custom_data_2 = $this->getBorrowerCustomData2($this->borrower_cat);

	$custom_data_2 = mb_convert_encoding($custom_data_2, "UTF-8");
	$custom_data_3 = mb_convert_encoding($custom_data_3, "UTF-8");

	$data = array();

        $data_1 = array(
               "businessContext" => "Circulation_Info",
               "key" => "customdata1",
               "value" => ""
        );
        $data[] = $data_1;

        if (!empty($custom_data_2)) {
	   $data_2 = array(
		 "businessContext" => "Circulation_Info",
	         "key" => "customdata2",
		 "value" => $custom_data_2
	    );
	    $data[] = $data_2;
	}

        if (!empty($custom_data_3)) {
	   $data_3 = array(
		 "businessContext" => "Circulation_Info",
	         "key" => "customdata3",
		 "value" => $custom_data_3
	    );
	    $data[] = $data_3;
        }
	return $data;

    }
    private function getCircInfo() {

        return array (
			'barcode' => $this->barcode,
			'borrowerCategory' => $this->getBorrowerCategoryName($this->borrower_cat),
			'homeBranch' => $this->homeBranch,
			'isVerified' => false,
	      	        "isCircBlocked" =>  true,
                        "isCollectionExempt" =>  false,
                        "isFineExempt" => false,
	);

    }

    private function getData() {
	       $data = array (
	  'schemas' => array (
		 0 => 'urn:ietf:params:scim:schemas:core:2.0:User',
		 1 => 'urn:mace:oclc.org:eidm:schema:persona:correlationinfo:20180101',
		 2 => 'urn:mace:oclc.org:eidm:schema:persona:persona:20180305',
		 3 => 'urn:mace:oclc.org:eidm:schema:persona:wmscircpatroninfo:20180101',
		 4 => 'urn:mace:oclc.org:eidm:schema:persona:wsillinfo:20180101',
		 5 => 'urn:mace:oclc.org:eidm:schema:persona:additionalinfo:20180501',
		 6 => 'urn:mace:oclc.org:eidm:schema:persona:newnotes:20180101'
	  ),
	  'name' => array (
		'familyName' => $this->borrower_lname,
		'givenName' => $this->borrower_fname,
		'middleName' => '',
		'honorificPrefix' => '',
		'honorificSuffix' => '',
	  ),
	  'addresses' => $this->getAddresses(),
	  'emails' => array (
		0 =>  array (
			'value' => $this->email,
			//'type' => $this->defaultType,
			'type' => "",
			'primary' => true,
		),
	  ),
	  'phoneNumbers' => array (
		0 =>  array (
			'value' => $this->borrower_telephone,
			'type' => $this->defaultType,
			'primary' => true,
		),
	  ),
	  'urn:mace:oclc.org:eidm:schema:persona:wmscircpatroninfo:20180101' =>  array (
	    'circulationInfo' =>  $this->getCircInfo()
          ),
	  'urn:mace:oclc.org:eidm:schema:persona:additionalinfo:20180501' =>  array (
	    'oclcKeyValuePairs' =>  $this->getCustomData()
          ),
	  'urn:mace:oclc.org:eidm:schema:persona:newnotes:20180101' =>  array (
	    'newNotes' =>  $this->getNotes()
          ),
	  'urn:mace:oclc.org:eidm:schema:persona:persona:20180305' =>  array (
		  'institutionId' => $this->institutionId,
		  'oclcExpirationDate' => $this->setExpiryDate(),
	  ),
	);
	return $data;
    }

}


