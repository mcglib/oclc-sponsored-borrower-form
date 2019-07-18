<?php

namespace App\Mail;

use App\Oclc\Borrower;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class GeneralError extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower, $timestamp, $url, $error_msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Borrower $borrower, $error_msg)
    {
        //
	$this->borrower = $borrower;
        $this->url = $_ENV['APP_URL'] ?? "https://cml.library.mcgill.ca/borrowing-card";
	$this->timestamp = Carbon::now();
	$this->error_msg = $error_msg;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $_ENV['MAIL_ERROR_SUBJECT'] ?? 'External borrowers: Error creating patron record';
	 
	 return $this->view('emails.general_error')
		      ->subject($subject)
	              ->text('emails.general_error_plain');
    }
}
