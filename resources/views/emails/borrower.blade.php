<!DOCTYPE html>
<html>
<head>
 <title>Borrower information </title>
</head>
<body>
Dear {{ $borrower->borrower_fname}} {{ $borrower->borrower_lname}},

<p>This is a confirmation that a library account has been created for you.Please bring this temporary barcode to a Library Services desk: </p>
<p class="text-large"> <strong>{{$borrower->barcode}}</strong></p>

@include('emails.account_details')

<hr />

<p>
Thank you,
McGill Library
</p>
</body>
</html>
