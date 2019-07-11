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
		   <form action="create-step1" method="post">
		    {{ csrf_field() }}
			<fieldset class="form-group" id="library_information">
				<legend>Library information</legend>
                <div class="form-group">
                    <label for="branch_library" class="control-label required">Branch Library<span class="required">*</span></label>
                    {!! Form::input('text', 'branch_library', $borrower->branch_library ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
            </fieldset>
			<fieldset class="form-group" id="professors_information">
				<legend>Professors information</legend>
                <div class="form-group">
                    <label for="prof_name" class="control-label required">Name <span class="required">*</span></label>
                    {!! Form::input('text', 'prof_name', $borrower->prof_name ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="prof_dept" class="control-label required">Department <span class="required">*</span></label>
                    {!! Form::input('text', 'prof_dept', $borrower->prof_dept ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="prof_telephone" class="control-label required">Telephone number<span class="required">*</span></label>
                    {!! Form::input('text', 'dept', $borrower->prof_telephone ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
            </fieldset>
			<fieldset class="form-group" id="borrower_information">
				<legend>Borrower information</legend>
                <div class="form-group">
                    <label for="borrower_name" class="control-label required">Name <span class="required">*</span></label>
                    {!! Form::input('text', 'borrower_name', $borrower->borrower_name ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_email" class="control-label required">Borrower's Email Address <span class="required">*</span></label>
                    {!! Form::input('email', 'email', $borrower->borrower_email ?? null, ['class'=> 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="borrower_address" class="control-label">Mailing Address<span class="required">*</span></label>
                    {!! Form::textarea('borrower_address',$borrower->borrower_address ?? null, array('class'=>'form-control','rows' => 8, 'cols' => 50)) !!}
                </div>
               <div class="form-group">
                <label for="borrower_auth_from" class="control-label">Period of Authorization From<span class="required">*</span></label>
                {!! Form::date('borrower_auth_from',$borrower->borrower_auth_from ?? \Carbon\Carbon::now()->format('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
               </div>
               <div class="form-group">
                <label for="borrower_auth_to" class="control-label">Period of Authorization To<span class="required">*</span></label>
                {!! Form::date('borrower_auth_to', $borrower->borrower_auth_to ?? \Carbon\Carbon::today()->addYears(1)->format('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
               </div>
               <div class="form-group">
               <label for="borrower_status" class="control-label">Borrower's status<span class="required">*</span></label>
                {{ Form::radio('borrower_status',  true, 'The authorized borrower is a McGill student.') }}
                {{ Form::radio('borrower_status', false, 'The authorized borrower is not a McGill student.' , false) }}
               </div>

            </fieldset>





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
 </div>
@endsection
