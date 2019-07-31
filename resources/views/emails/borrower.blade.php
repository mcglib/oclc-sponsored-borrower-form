<!DOCTYPE html>
<html>
<head>
 <title>Borrower information </title>
</head>
<body>
<p>Hello {{$borrower->borrower_fname}} {{$borrower->borrower_lname}},</p>

@if ($borrower->borrower_renewal === 'Yes')
<p>Your professor/supervisor, {{$borrower->prof_name}}, has requested the renewal of
Your library privileges as a {{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}. </p>
<p>Your Sponsored Borrower account will be renewed by the library branch indicated below.</p>

<p>If you encounter any issues or have questions, please contact us at
rebecca.nicholson@mcgill.ca.</p>

@else
    <p>Your professor/supervisor, {{$borrower->prof_name}}, has sponsored you as a
        {{$borrower->getBorrowerCategoryLabel($borrower->borrower_cat)}}. Please come to the branch library indicated below to
         pick up your McGill Library Borrowing Card. Please bring a photo ID and show this email message when you come.</p>

    <p>If you encounter any issues or have questions, please contact us at {{$borrower->branch_library_email}}.</p>
@endif

---------------------------------------------------------------------
@include('emails.account_details')
---------------------------------------------------------------------

<p>If you need further assistance, please feel free to ask us. [https://www.mcgill.ca/library/contact/askus ].</p>

</body>
</html>
