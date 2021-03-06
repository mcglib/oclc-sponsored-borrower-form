@extends('layouts.mainlayout')

@section('content')
<h3>Review Submission</h3>
    <br />
    <form action="store" method="post" id="store-form" >
    {{ csrf_field() }}
        <h4> Sponsored borrower </h4>
        <table class="table">
            <tr>
                <td>Requested borrowing category:</td>
		        <td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong></td>
            </tr>
        </table>
        <br />
        <h4> Library information </h4>
        <table class="table">
            <tr>
                <td>Branch library:</td>
                <td><strong>{{$borrower->branch_library_name}}</strong></td>
            </tr>
        </table>
        <h4> Professor's information </h4>
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
                <td>Email:</td>
                <td><strong>{{$borrower->prof_email}}</strong></td>
            </tr>
            <tr>
                    <td>Telephone no:</td>
                    <td><strong>{{$borrower->prof_telephone}}</strong></td>
                </tr>
        </table>
        <h4> Borrower's information </h4>
        <table class="table">
            <tr>
                    <td>Is this a renewal?:</td>
                    <td><strong>{{{$borrower->borrower_renewal }}}</strong></td>
            </tr>
	    @if (isset($borrower->borrower_renewal_barcode))
            <tr>
                <td>Barcode:</td>
                <td><strong>{{$borrower->borrower_renewal_barcode}}</strong></td>
            </tr>
	    @endif
            <tr>
                <td>First name:</td>
                <td><strong>{{$borrower->borrower_fname}}</strong></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><strong>{{$borrower->borrower_lname}}</strong></td>
            </tr>
            <tr>
                <td>Email address:</td>
                <td><strong>{{$borrower->borrower_email}}</strong></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><strong>
                    <address>
                    {{$borrower->borrower_address1}}<br />
                    {{$borrower->borrower_address2}}<br />
                    {{$borrower->borrower_city}}<br />
                    {{$borrower->borrower_province_state}}<br />
                    {{$borrower->borrower_postal_code}}<br/>
                    </address>
                </strong></td>
            </tr>
	    @if (!$borrower->is_renewal())
            <tr>
                <td>Period of authorization from:</td>
                <td><strong>{{$borrower->borrower_startdate}}</strong></td>
            </tr>
	    @endif
            <tr>
                <td>Period of authorization to:</td>
                <td><strong>{{$borrower->borrower_enddate}}</strong></td>
            </tr>
            <tr>
                <td>Terms accepted?:</td>
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
