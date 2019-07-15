@extends('layouts.mainlayout')

@section('content')
    <h3>Review Submission</h3>
    <form action="store" method="post" id="store-form" >
    {{ csrf_field() }}
        <h4> Library information </h4>
        <table class="table">
            <tr>
                <td>Branch library:</td>
                <td><strong>{{$borrower->branch_library}}</strong></td>
            </tr>
        </table>
        <h4> Proffesor's information </h4>
        <table class="table">
            <tr>
                <td>Name:</td>
                <td><strong>{{$borrower->prof_name}}</strong></td>
            </tr>
            <tr>
                <td>Department:</td>
                <td><strong>{{$borrower->prof_dept}}</strong></td>
            </tr>
            <tr>
                <td>Telephone number:</td>
                <td><strong>{{$borrower->prof_telephone}}</strong></td>
            </tr>
        </table>
        <h4> Borrower's information </h4>
        <table class="table">
            <tr>
                <td>Name:</td>
                <td><strong>{{$borrower->borrower_name}}</strong></td>
            </tr>
            <tr>
                <td>Borrower's Email Address:</td>
                <td><strong>{{$borrower->borrower_email}}</strong></td>
            </tr>
            <tr>
                <td>Mail Address:</td>
                <td><strong>{{$borrower->borrower_address}}</strong></td>
            </tr>
            <tr>
                <td>Period of Authorization From:</td>
                <td><strong>{{$borrower->borrower_auth_to}}</strong></td>
            </tr>
            <tr>
                <td>Period of Authorization To:</td>
                <td><strong>{{$borrower->borrower_auth_from}}</strong></td>
            </tr>
	        @if (isset($borrower->spouse_name))
            <tr>
                <td>The phone number if the borrower is Not a McGill student.:</td>
                <td><strong>{{$borrower->borrower_telephone}}</strong></td>
            </tr>
	        @endif
            <tr>
                <td>Borrower's terms:</td>
                <td><strong>{{$borrower->borrower_terms}}</strong></td>
            </tr>
        </table>
        <div class="form-group row">
		<label class="col-lg-4 col-form-label form-control-label"></label>
		<div class="col-lg-8">
        		<a role="button" href="create-step1" class="btn btn-secondary">Back</a>
			<input class="btn btn-primary" type="submit" value="Submit" id="submit-request">
		</div>
    	</div>
	@include('layouts.partials.footer')
    </form>
@endsection
