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
	    'branch_library' => 'required',
	    'prof_name' => 'required|max:50',
	    'prof_dept' => 'required|max:50',
	    'prof_email' => 'required|email',
	    'prof_telephone' => 'required|max:254',
	    'borrower_category' => 'required',
	    'borrower_fname' => 'required|max:50',
	    'borrower_lname' => 'required|max:50',
	    'borrower_email' => 'required|email',
	    'borrower_address1' => 'required',
	    'borrower_address2' => 'nullable',
            'borrower_city' => 'required',
            'borrower_province_state' => 'required',
            'borrower_postal_code' => 'required',
	    'borrower_startdate' => 'required',
	    'borrower_enddate' => 'required',
	    'borrower_renewal' => 'nullable',
	    'borrower_renewal_barcode' => 'nullable',
	    'borrower_telephone' => 'nullable',
	    'borrower_terms' => 'required',
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
        return [
	        'branch_library.required' => 'Please select  a branch library',
	        'prof_name.required' => 'Professor name  is required',
	        'prof_dept.required' => 'Professor department  is required',
	        'prof_email.email' => 'Please enter a valid email for the professor',
	        'prof_email.required' => 'Please enter the professor\'s email',
	        'prof_telephone.required' => 'Please enter the Professor\'s phone number',
	    	'borrower_category.required' => 'Please select a borrowing category for the borrower',
	    	'borrower_name.required' => 'Please enter the borrower name',
	        'borrower_email.required' => 'Please enter the borrower\'s email',
	        'borrower_email.email' => 'Please enter a valid email for the borrower',
	    	'borrower_startdate.required' => 'Please enter the start date of the sponsorship',
	    	'borrower_enddate.required' => 'Please enter the end date of the sponsorship',
	    	'borrower_status.required' => 'Please select the status of the borrower',
	        'borrower_terms.required' => 'You must accept the terms before submitting the form',
	        'borrower_address1.required' => 'Please enter the address of the borrower',
            'borrower_city' => 'Please enter the city',
            'borrower_province_state' => 'Please enter the state or province',
            'borrower_postal_code' => 'Please enter the postal code',
	        'borrower_fname.max' => 'Borrowers first name may not be greater than 50 characters',
	        'borrower_lname.max' => 'Borrowers last name  may not be greater than 50 characters',
	        'borrower_email.max' => 'Borrowers email  may not be greater than 254 characters',
        ];
    }
}
