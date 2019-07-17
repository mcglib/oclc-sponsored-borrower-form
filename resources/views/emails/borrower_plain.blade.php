Dear {{ $borrower->fname}} {{ $borrower->lname}},

This is a confirmation that a library account has been created for you.Please bring this temporary barcode to a Library Services desk: 
{{$borrower->barcode }}

@include('emails.account_details_plain')


Thank you
McGill Library

