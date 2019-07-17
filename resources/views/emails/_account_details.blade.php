
<h3>Account details</h3>
<hr />
<table class="table">
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
	<td>Temporary barcode:</td>
	<td ><strong>{{$borrower->barcode}}</strong></td>
    </tr>
    <tr>
	<td>Requested borrowing category:</td>
	<td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong>
	</td>
    </tr>
    @if (isset($borrower->postal_code))
    <tr>
	<td>Address:</td>
	<td><strong>
		<address>
		{{$borrower->borrower_address1}}
		{{$borrower->borrower_address2}}<br />
		{{$borrower->borrower_city}}<br />
		{{$borrower->borrower_province_state}}<br />
		{{$borrower->borrower_postal_code}}<br/>
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
