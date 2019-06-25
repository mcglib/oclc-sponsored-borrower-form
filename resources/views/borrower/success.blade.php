@extends('layouts.mainlayout')

@section('content')
    <h3 class="mb-0">McGill Library Borrowing Card Application Form</h3>
    <hr />
    <div class="well">
	Your application has been successfully submitted and a confirmation email sent to your email at <strong>{{$borrower->email}}</strong>.
    </div>
        {{ csrf_field() }}
        <table class="table">
	    @if (isset($borrower->barcode))
	    <tr>
		<td>Temporary barcode:</td>
		<td class="text-large"><strong>{{$borrower->barcode}}</strong></td>
	    </tr>
	    @endif
            <tr>
                <td>First name:</td>
                <td><strong>{{$borrower->fname}}</strong></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><strong>{{$borrower->lname}}</strong></td>
            </tr>
            <tr>
                <td>Email address:</td>
                <td><strong>{{$borrower->email}}</strong></td>
            </tr>
	    @if (isset($borrower->telephone_no))
            <tr>
                <td>Telephone:</td>
		<td><strong>{{$borrower->telephone_no}}</strong></td>
	    </tr>
	    @endif
            <tr>
                <td>Requested borrowing category:</td>
		<td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong>
		</td>
	    </tr>
	    @if (isset($borrower->spouse_name))
		    <tr>
			<td>Spouse's name:</td>
			<td><strong>{{$borrower->spouse_name}}</strong></td>
		    </tr>
	    @endif
	    @if (isset($borrower->home_institution))
		    <tr>
			<td>Home institution name:</td>
			<td><strong>{{$borrower->home_institution}}</strong></td>
		    </tr>
	    @endif
	    @if (isset($borrower->postal_code))
            <tr>
                <td>Address:</td>
		<td><strong>
			<address>
			{{$borrower->address1}}
			{{$borrower->address2}}<br />
			{{$borrower->city}}<br />
			{{$borrower->province_state}}<br />
			{{$borrower->postal_code}}<br/>
			</address>
	            </strong>
		</td>
	    </tr>
	    <tr>
		<td>Telephone:</td>
		<td><strong>{{$borrower->telephone_no}}</strong></td>
	    </tr>
	    @endif
        </table>
        <div class="form-group row">
		<label class="col-lg-3 col-form-label form-control-label"></label>
		<div class="col-lg-9">
        		<a role="button" href="create-step1" class="btn btn-primary">Back to form</a>
		</div>
    	</div>
	@include('layouts.partials.footer')
@endsection
