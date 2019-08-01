<!DOCTYPE html>
<html>
<head>
 <title>Sponsored Borrower  </title>
</head>
<body>
Hi,
@if ($borrower->borrower_renewal == 'Yes')
    <p>The following sponsored borrower form has been submitted for renewal on: {{ $timestamp }}</p>
@else
    <p>The following sponsored borrower form has been submitted on: {{ $timestamp  }}</p>
@endif

---------------------------------------------------------------------
@include('emails.prof_details')
@include('emails.account_details')

<p>Terms: I accept full responsibility for fines, replacement costs and any
    other charges incurred by the aforementioned for library privileges
    authorized under my name.</p>
---------------------------------------------------------------------

</body>
</html>
