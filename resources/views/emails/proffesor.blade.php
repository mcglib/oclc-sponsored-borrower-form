<!DOCTYPE html>
<html>
<head>
 <title>Borrower information </title>
</head>
<body>
Dear {{ $borrower->fname}} {{ $borrower->lname}},

<p>This is a confirmation that a library account has been created for you.Please bring this temporary barcode to a Library Services desk: </p>
<p class="text-large"> <strong>{{$borrower->barcode}}</strong></p>
<h3>Account details</h3>
<hr />
<table class="table">
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
    <tr>
	<td>Temporary barcode:</td>
	<td ><strong>{{$borrower->barcode}}</strong></td>
    </tr>
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
<hr />

<p>
Thank you,
McGill Library
</p>
</body>
</html>
