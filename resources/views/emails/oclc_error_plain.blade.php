Hi,

An error has occured when a user submitted the following form on {{$url}} @ {{ $timestamp }}

Error details
-------------
Date occured: {{ $timestamp }}

Error Message:
{{ $borrower->error_msg() }}


Submission details
@include('emails.account_details_plain')
