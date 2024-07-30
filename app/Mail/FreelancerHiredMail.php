<?php

// app/Mail/FreelancerHiredMail.php
namespace App\Mail;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreelancerHiredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;

    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }
    

    public function build()
    {
        return $this->view('emails.freelancer_hired')
                    ->subject('Vous avez été embauché !');
    }
}
