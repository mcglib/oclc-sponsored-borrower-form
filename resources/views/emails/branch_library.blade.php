<!DOCTYPE html>
<html>
<head>
 <title>Sponsored Borrower  </title>
</head>
<body>
Hi,
@if ($borrower->borrower_renewal == 'Yes')
    <p>The following sponsored borrower form has been submitted for renewal on: </p>
@else
    <p>The following sponsored borrower form has been submitted on: </p>
@endif

---------------------------------------------------------------------
@include('emails.prof_details')
@include('emails.account_details')
---------------------------------------------------------------------

</body>
</html>
