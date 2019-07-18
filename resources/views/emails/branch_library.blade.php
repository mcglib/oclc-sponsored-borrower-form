<!DOCTYPE html>
<html>
<head>
 <title>Sponsored Borrower  </title>
</head>
<body>
Hi,

<p>The following sponsored borrower form has been submitted: </p>
<p class="text-large"> <strong>{{$borrower->barcode}}</strong></p>
<h3>Account details</h3>
---------------------------------------------------------------------
@include('emails.account_details')
---------------------------------------------------------------------
<hr />

</body>
</html>
