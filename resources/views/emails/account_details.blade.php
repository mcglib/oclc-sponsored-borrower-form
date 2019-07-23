<table class="table">
   <tr>
		<td>Branch Library:</td>
		<td><strong>{{$borrower->branch_library_name}}</strong></td>
   </tr>
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
	<td>Sponsored Borrower category:</td>
	<td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong>
	</td>
     </tr>
     <tr>
			<td>Authorized from:</td>
			<td><strong>{{$borrower->borrower_startdate}}</strong></td>
    </tr>
    <tr>
			<td>Authorized to:</td>
			<td><strong>{{$borrower->borrower_enddate}}</strong></td>
    </tr>
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
</table>
