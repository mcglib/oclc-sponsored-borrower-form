Hi,

An error has occured when a user submitted the following form on {{$url}} @ {{ $timestamp }}

Error details
-------------
Date occured: {{ $timestamp }}

Error Message:
{{ $borrower->error_msg() }}


Submission details
-----------------
First name: {{$borrower->fname}}
Last name: {{$borrower->lname}}
Email address:{{$borrower->email}}
Temporary barcode: {{ $borrower->barcode }} 
Requested borrowing category: {{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}
@if (isset($borrower->spouse_name))
Spouse's name: {{$borrower->spouse_name}}
@endif
@if (isset($borrower->home_institution))
Home institution name: {{$borrower->home_institution}}
@endif
@if (isset($borrower->postal_code))
Address:
	{{$borrower->address1}}
	{{$borrower->address2}}
	{{$borrower->city}}
	{{$borrower->postal_code}}
Telephone no: {{$borrower->telephone_no}}
@endif
