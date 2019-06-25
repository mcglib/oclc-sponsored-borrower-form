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
    @if (isset($borrower->telephone_no))
    <tr>
	<td>Telephone:</td>
	<td><strong>{{$borrower->telephone_no}}</strong></td>
    </tr>
    @endif
    <tr>
	<td>Requested Borrowing Category:</td>
	<td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong></td>
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
    @endif
</table>
