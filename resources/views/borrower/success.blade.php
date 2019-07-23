@extends('layouts.mainlayout')

@section('content')
    <h3 class="mb-0">McGill Library Sponsored Borrower Form</h3>
    <hr />
    <div class="well">
	Your application has been successfully submitted and a confirmation email sent to your email at <strong>{{$borrower->prof_email}}</strong>.
    </div>
        {{ csrf_field() }}
        <table class="table">
	    @if (isset($borrower->barcode))
	    <tr>
		<td>Temporary barcode:</td>
		<td class="text-large"><strong>{{$borrower->barcode}}</strong></td>
	    </tr>
	    @endif
	</table>
	@include('emails.account_details')
        <div class="form-group row">
		<label class="col-lg-3 col-form-label form-control-label"></label>
		<div class="col-lg-9">
        		<a role="button" href="create-step1" class="btn btn-primary">Back to form</a>
		</div>
    	</div>
	@include('layouts.partials.footer')
@endsection
