@extends('layouts.mainlayout')

@section('content')
    <hr>
    <h3 class="mb-0">McGill Library Borrowing Card Application Form - Error</h3>
    <div class="container py-5">  
	    @if (session()->has('flash.message'))
		   <div class="alert alert-{{ session('flash.class') }}">
		   {{ session('flash.message') }}
		   </div>
	    @endif
	    @if (\Session::has('error'))
		<div class="alert alert-danger">
		    <strong>Error!</strong> {!! \Session::get('error') !!}
		     <p> If you think this is in error, Please contact <a href="mailto:web.library@mcgill.ca" class="alert-link">web.library@mcgill.ca</a>.
		</div>
	    @endif
	    @if (\Session::has('oclcerror'))
		<div class="alert alert-danger">
		    <strong>Error!</strong> {!! \Session::get('oclcerror') !!}
		     <p> If you think this is in error, Please contact <a href="mailto:web.library@mcgill.ca" class="alert-link">web.library@mcgill.ca</a>.
		</div>
	    @endif
    </div>  
    <div class="form-group row">
 	   	<label class="col-lg-3 col-form-label form-control-label"></label>
		<div class="col-lg-9">
			<a role="button" href="create-step1" class="btn btn-primary">Back to form</a>
		</div>
     </div>
     @include('layouts.partials.footer')
@endsection
