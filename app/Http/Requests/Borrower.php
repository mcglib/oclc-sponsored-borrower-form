<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Yaml;

class Borrower extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'fname' => 'required|max:50',
	    'lname' => 'required|max:50',
	    'email' => 'required|email|max:254',
	    'borrower_cat' => 'required',
	    'address2' => 'nullable',
	    'telephone_no' => 'required_if:borrower_cat,value2,value3,value4,value5,value6,value8,value10|max:17',
	    'spouse_name' => 'required_if:borrower_cat,value4|max:50',
	    'address1' => 'required_if:borrower_cat,value2,value3,value4,value5,value6,value8,value10|max:120',
	    'city' => 'required_if:borrower_cat,value2,value3,value4,value5,value6,value8,value10|max:50',
	    'province_state' => 'required_if:borrower_cat,value2,value3,value4,value5,value6,value8,value10|max:50',
	    'postal_code' => 'required_if:borrower_cat,value2,value3,value4,value5,value6,value8,value10|max:20',
	    'home_institution' => 'required_if:borrower_cat,value1,value9|max:120',
        ];
    }
    /**
	    *  * Get the error messages for the defined validation rules.
	    *   *
	    *    * @return array
	    *     */
    public function messages()
    {
	// Load the variables
	$yamlContents = Yaml::parse(file_get_contents(base_path().'/borrowing_categories.yml'));
        return [
	        'fname.required' => 'Your first name  is required',
	        'lname.required' => 'Your last name  is required',
	        'email.required' => 'Your email  is required',
	        'email.email' => 'Please enter a valid email',
	        'borrower_cat.required' => 'Please select  a borrowing category',
	        'telephone_no.required_if' => 'Please enter a phone number we can reach you at',
	    	'spouse_name.required_if' => 'Please enter the name of your spouse',
	    	'address1.required_if' => 'Please fill in your address',
	    	'postal_code.required_if' => 'Please enter your postal code',
	    	'city.required_if' => 'Please enter your city',
	    	'province_state.required_if' => 'Please enter the name of your province/state',
	    	'home_institution.required_if' => 'Please enter the name of your home institution',
	        'fname.max' => 'Your first name may not be greater than 50 characters',
	        'lname.max' => 'Your last name  may not be greater than 50 characters',
	        'email.max' => 'Your email  may not be greater than 254 characters',
	        'telephone_no.max' => 'Your telephone number  may not be greater than 17 characters',
	        'spouse_name.max' => 'The spouse name  may not be greater than 50 characters',
	        'address1.max' => 'The address 1  may not be greater than 120 characters',
	        'city.max' => 'The city  may not be greater than 50 characters',
	        'postal_code.max' => 'Your telephone number  may not be greater than 20 characters',
        ];
    }
}
