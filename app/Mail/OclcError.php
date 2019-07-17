<?php

namespace App\Mail;

use App\Oclc\Borrower;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class OclcError extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower, $timestamp, $url, $error_msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Borrower $borrower)
    {
        //
	$this->borrower = $borrower;
        $this->url = $_ENV['APP_URL'] ?? "https://cml.library.mcgill.ca/borrower";
	$this->timestamp = Carbon::now();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $_ENV['MAIL_ERROR_SUBJECT'] ?? 'External borrowers: Error creating patron record';
	 
	 return $this->view('emails.oclc_error')
		      ->subject($subject)
	              ->text('emails.oclc_error_plain');
    }
}
