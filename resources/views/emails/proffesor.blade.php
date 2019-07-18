<!DOCTYPE html>
<html>
<head>
 <title>Borrower information </title>
</head>
<body>
		<p>Hello {{$borrower->prof_name}},</p>

		@if ($borrower->borrower_renewal == 'yes')
		<p>Your Sponsored Borrower renewal request was submitted {{ $timestamp }}.</p>

		<p>Your Sponsored Borrower, {{$borrower->borrower_fname}} {{$borrower->borrower_lname}}, has been notified by email.</p>

		<p>Please note: In the event that you need to cancel this authorization before the specified “Authorized to” date, 
		please contact us at {{$borrower->branch_library_email}}.</p>
			
		@else
		<p>Your Sponsored Borrower application form for a {{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}
				was submitted {{ $timestamp }}.</p>
			   
			   <p>Your Sponsored Borrower, {{$borrower->borrower_fname}} {{$borrower->borrower_lname}}, has been notified by email.</p>
			   
			   <p>Please note: In the event that you need to cancel this authorization before the specified “Authorized to” date, please contact us at 
					   {{$borrower->branch_library_email}}.</p>	
		@endif

		---------------------------------------------------------------------
		@include('emails.account_details')

		<p>Terms: I accept full responsibility for fines, replacement costs and any
		other charges incurred by the aforementioned for library privileges
		authorized under my name.</p>
				
		---------------------------------------------------------------------
		
		<p>If you need further assistance, please feel free to ask us. [
		https://www.mcgill.ca/library/contact/askus ].</p>
		


</body>
</html>
