@extends('layouts.mainlayout')

@section('content')
 <div class="col-md-12">
	    <div class="card card-outline-secondary">
		<div class="card-header">
		    <h3 class="mb-0">McGill Library Borrowing Card Application Form</h3>
		</div>
		<div class="card-body">
		     @if (count($errors) > 0)
			     <div class="alert alert-danger">
				 <ul>
				 @foreach ($errors->all() as $error)
				  <li>{{ $error }}</li>
				 @endforeach
				 </ul>
			     </div>
			     @endif
		   <form action="create-step1" method="post">
		    {{ csrf_field() }}
			    <div class="form-group">
				    <label for="fname" class="control-label required">First name <span class="required">*</span></label>
				    {!! Form::input('text', 'fname', $borrower->fname ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
        		    </div>
    
			    <div class="form-group">
    
			       <label for="lname" class="control-label required">Last name <span class="required">*</span></label>
			      {!! Form::input('text', 'lname', $borrower->lname ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
        		    </div>
    
			    <div class="form-group">
    
				    <label for="email" class="control-label required">Email address <span class="required">*</span></label>
			      	    {!! Form::input('email', 'email', $borrower->email ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
        		    </div>
    
    
			    <div class="form-group">
    
				    <label for="borrower_cat" class="control-label required">Requested borrowing category<span class="required">*</span></label>
				    {!! Form::select('borrower_cat', array_merge(['' => 'Please select a category'], $borrower_categories), $borrower->borrower_cat ?? null, ['class' => 'form-control']) !!}
        		    </div>
    
			    <div id="spouseDivCheck" class="no-display">
				<div class="form-group">
    
				    <label for="spouse_name" class="control-label">If applying for faculty spouse borrowing card, please enter the name of your spouse</label>
			      	    {!! Form::input('text', 'spouse_name', $borrower->spouse_name ?? null, ['class'=> 'form-control']) !!}
        		        </div>
			    </div>
			    <div id="homeInstDivCheck" class="no-display">
				<div class="form-group">
				    <label for="home_institution" class="control-label">Please enter the name of your home institution<span class="required">*</span></label>
				    {!! Form::select('home_institution', array_merge(['' => 'Please select an institution'], $home_institutions), $borrower->home_institution ?? null, ['class' => 'form-control']) !!}
        		        </div>
    
			    </div>
			    <div id="addressDivCheck" class="no-display">
				   <fieldset class="form-group" id="borrower_address">
				    <legend>Borrower information</legend>
				    <div class="form-group">
					    <label for="address1" class="control-label">Street address 1<span class="required">*</span></label>
					 {!! Form::input('text', 'address1', $borrower->address1 ?? null, ['class'=> 'form-control']) !!}
				    </div>
				   <div class="form-group">
					<label for="address2" class="control-label">Street address 2</label>
					 {!! Form::input('text', 'address2', $borrower->address2 ?? null, ['class'=> 'form-control']) !!}
	    
				   </div>

				    <div class="form-group">
					<label for="city" class="control-label">City<span class="required">*</span></label>
					 {!! Form::input('text', 'city', $borrower->city ?? null, ['class'=> 'form-control']) !!}
				    </div>
				    <div class="form-group">
					<label for="province" class="control-label">Province/State<span class="required">*</span></label>
					 {!! Form::input('text', 'province_state', $borrower->province_state ?? null, ['class'=> 'form-control']) !!}
				    </div>
				    <div class="form-group">
					<label for="postal_code" class="control-label">Postal code<span class="required">*</span></label>
					 {!! Form::input('text', 'postal_code', $borrower->postal_code ?? null, ['class'=> 'form-control', 'placeholder' => 'XXX XXX']) !!}
				    </div>
				    <div class="form-group">
					    <label for="telephone_no" class="control-label">Telephone<span class="required">*</span></label>
					    {!! Form::input('text', 'telephone_no', $borrower->telephone_no ?? null, ['class'=> 'form-control', 'placeholder' => '(xxx) xxx - xxxx ext. xxxx']) !!}
				    </div>
				    </fieldset>
			    </div>
			    <div> <span>* Required</span></div>
			    <div class="form-group row">
				<label class="col-lg-4 col-form-label form-control-label"></label>
				<div class="col-lg-8">
					<input class="btn btn-primary" type="submit" value="Next">
					<button class="btn btn-secondary" type="button">Cancel</button>
				</div>
			    </div>
			   @include('layouts.partials.footer')
    	    	    </form>
		</div>
	    </div>
	    <!-- /form user info -->
@endsection
