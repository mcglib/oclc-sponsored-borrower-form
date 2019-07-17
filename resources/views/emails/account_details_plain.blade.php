---------Account details-----
First name: {{$borrower->borrower_fname}}
Last name: {{$borrower->borrower_lname}}
Email address: {{$borrower->borrower_email}}
Temporary barcode: {{$borrower->barcode }}
Requested borrowing category:
	 {{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}
@if (isset($borrower->postal_code))
Address:
	{{$borrower->address1}}
	{{$borrower->address2}}
	{{$borrower->city}}
	{{$borrower->province_state}}
	{{$borrower->postal_code}}
Telephone: {{$borrower->telephone_no}}
@endif
---------Account details-----

