@extends('layouts.mainlayout')

@section('content')
 <div class="col-md-12">
	    <div class="card card-outline-secondary">
		<div class="card-header">
		    <h3 class="mb-0">McGill Library Sponsored Borrower form</h3>
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
		   <form action="create-step1" id="store-form" method="post">
		    {{ csrf_field() }}
			<fieldset class="form-group" id="library_information">
				<legend>Sponsored Borrower Category</legend>
                <div class="form-group">
                   <label for="borrower_renewal" class="control-label"></label><br />
                   {!! Form::checkbox('borrower_renewal','Yes', $borrower->borrower_renewal ?? false,  ['class'=> 'checkbox', 'id' => 'showRenewal']) !!}
                   This submission is for the renewal of an existing Sponsored Borrower.
                </div>
                <div class="form-group">
                    <label for="borrower_category" class="control-label required">Sponsored borrower<span class="required">*</span></label>
                    {!! Form::select('borrower_category', array_merge(['' => 'Please select the category'], $borrowing_categories), $borrower->borrower_cat ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </fieldset>
			<fieldset class="form-group" id="library_information">
				<legend>Library information</legend>
                <div class="form-group">
                    <label for="branch_library" class="control-label required">Branch library<span class="required">*</span></label>
                    {!! Form::select('branch_library', array_merge(['' => 'Please select a branch'], $branch_libraries), $borrower->branch_library_value ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </fieldset>
			<fieldset class="form-group" id="professors_information">
				<legend>Professor information</legend>
                <div class="form-group">
                    <label for="prof_name" class="control-label required">Name <span class="required">*</span></label>
                    {!! Form::input('text', 'prof_name', $borrower->prof_name ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="prof_email" class="control-label required">Email address <span class="required">*</span></label>
                    {!! Form::input('email', 'prof_email', $borrower->prof_email ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="prof_dept" class="control-label required">Department <span class="required">*</span></label>
                    {!! Form::input('text', 'prof_dept', $borrower->prof_dept ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="prof_telephone" class="control-label required">Telephone number<span class="required">*</span></label>
                    {!! Form::input('text', 'prof_telephone', $borrower->prof_telephone ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
            </fieldset>
			<fieldset class="form-group" id="borrower_information">
                <legend>Borrower information</legend>
                <div id="BarcodeBlock">
                    <div class="form-group">
                        <label for="borrower_renewal_barcode" class="control-label">Barcode</label>
                        {!! Form::input('text', 'borrower_renewal_barcode', $borrower->borrower_renewal_barcode ?? null, ['class'=> 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="borrower_fname" class="control-label required">First name <span class="required">*</span></label>
                    {!! Form::input('text', 'borrower_fname', $borrower->borrower_fname ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_lname" class="control-label required">Last name <span class="required">*</span></label>
                    {!! Form::input('text', 'borrower_lname', $borrower->borrower_lname ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_email" class="control-label required">Email address <span class="required">*</span></label>
                    {!! Form::input('email', 'borrower_email', $borrower->borrower_email ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>

                <div class="form-group">
                    <label for="borrower_address1" class="control-label">Street address 1<span class="required">*</span></label>
                     {!! Form::input('text', 'borrower_address1', $borrower->borrower_address1 ?? null, ['class'=> 'form-control']) !!}
                </div>
               <div class="form-group">
                    <label for="borrower_address2" class="control-label">Street address 2</label>
                     {!! Form::input('text', 'borrower_address2', $borrower->borrower_address2 ?? null, ['class'=> 'form-control']) !!}
               </div>

                <div class="form-group">
                    <label for="borrower_city" class="control-label">City<span class="required">*</span></label>
                     {!! Form::input('text', 'borrower_city', $borrower->borrower_city ?? null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_province" class="control-label">Province/State<span class="required">*</span></label>
                     {!! Form::input('text', 'borrower_province_state', $borrower->borrower_province_state ?? null, ['class'=> 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_postal_code" class="control-label">Postal code<span class="required">*</span></label>
                     {!! Form::input('text', 'borrower_postal_code', $borrower->borrower_postal_code ?? null, ['class'=> 'form-control', 'placeholder' => 'XXX XXX']) !!}
                </div>
                <br />
                <hr />
                <br />
                <div id="RenewalAuthFrom">
                    <div class="form-group">
                    <label for="borrower_startdate" class="control-label">Period of authorization from<span class="required">*</span></label>
                    {!! Form::date('borrower_startdate',$borrower->borrower_startdate ?? \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
                   </div>
                </div>
                <div id="RenewalAuthToTxt" class="hidden">
		   <p>Please select the new expiry date.</p>
		</div>
               <div class="form-group">
                <label for="borrower_enddate" class="control-label">Period of authorization to<span class="required">*</span></label>
                {!! Form::date('borrower_enddate', $borrower->borrower_enddate ?? \Carbon\Carbon::today()->addMonths(1)->format('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
               </div>
            </fieldset>
            <hr />
           <div class="form-group">
               <label for="borrower_terms" class="control-label">Terms<span class="required">*</span></label><br />
               {!! Form::checkbox('borrower_terms', 'Yes', $borrower->borrower_terms ?? false, ['class'=> 'checkbox', 'required' => 'required']) !!}
               I accept full responsibility for fines, replacement costs and any other charges incurred by the aforementioned for library privileges authorized under my name.
           </div>

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
 </div>
@endsection
