<!DOCTYPE html>
<html>
<head>
 <title>Borrower information </title>
</head>
<body>
Hi,
<p> An error has occured when a user submitted the following form on {{$url}} @ {{ $timestamp }}</p>

<h3>Error details</h3>
<dl class="row">
  <dt class="col-sm-3">Date occured</dt>
  <dd class="col-sm-9">{{ $timestamp }}</dd>

  <dt class="col-sm-3">Error Message</dt>
  <dd class="col-sm-9">
	<p> {{ $borrower->error_msg() }} </p>
  </dd>

</dl>


<h3>Submission details</h3>
<hr />
@include('emails.account_details')
