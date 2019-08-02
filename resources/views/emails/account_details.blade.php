<table class="table">
   <tr>
		<td>Branch library:</td>
		<td><strong>{{$borrower->branch_library_name}}</strong></td>
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

    @if (isset($borrower->barcode))
    <tr>
	<td>Temporary barcode:</td>
	<td ><strong>{{$borrower->barcode}}</strong></td>
    </tr>
    @endif

    <tr>
	<td>Sponsored borrower category:</td>
	<td><strong>{{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}</strong>
	</td>
     </tr>
     @if (!$borrower->is_renewal())
	<tr>
		<td>Authorized from:</td>
		<td><strong>{{$borrower->borrower_startdate}}</strong></td>
	</tr>
     @endif
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
