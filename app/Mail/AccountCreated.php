<?php

namespace App\Mail;

use App\Oclc\Borrower;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $borrower, $url, $timestamp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Borrower $borrower)
    {
        //
        $this->borrower = $borrower;
        $this->url = $_ENV['APP_URL'] ?? "https://cml.library.mcgill.ca/sponsored-borrower";
        $this->timestamp = Carbon::now();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      if($this->borrower->borrower_renewal) {
        $subject = $_ENV['MAIL_SUBJECT_RENEWAL'] ?? 'McGill Library Sponsored Borrower form';
      }else {
        $subject = $_ENV['MAIL_SUBJECT'] ?? 'McGill Library Sponsored Borrower form';
      }
      return $this->view('emails.borrower')
              ->subject($subject)
              ->text('emails.borrower_plain');
    }
}
