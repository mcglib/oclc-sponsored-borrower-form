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
	    'prof_telephone' => 'required|max:254',
	    'borrower_name' => 'required',
	    'borrower_email' => 'required',
	    'borrower_address' => 'nullable',
	    'borrower_auth_to' => 'required',
	    'borrower_auth_from,' => 'required_if:borrower_auth_to, borrower_email',
	    'borrower_status' => 'required',
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
	        'prof_name.required' => 'Professors name  is required',
	        'prof_dept.required' => 'Professors department  is required',
	        'prof_telephone.required' => 'Please enter the Professor\'s phone number',
	    	'borrower_name.required' => 'Please enter the borrower name',
	        'borrower_email.required' => 'Please enter the borrower\'s email',
	        'borrower_email.email' => 'Please enter a valid email for the borrower',
	    	'borrower_auth_to.required' => 'Please enter the start date of the sponsorship',
	    	'borrower_auth_from.required' => 'Please enter the end date of the sponsorship',
	    	'borrower_status.required' => 'Please select the status',
	        'borrower_terms.required' => 'You must accept the terms before submitting the form',
        ];
    }
}
