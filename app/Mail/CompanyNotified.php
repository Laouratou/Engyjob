<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User; // Ajouté pour le freelancer
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyNotified extends Mailable
{
    use Queueable, SerializesModels;

    public $freelancer;
    public $project;

    /**
     * Create a new message instance.
     *
     * @param User $freelancer
     * @param Project $project
     * @return void
     */
    public function __construct(User $freelancer, Project $project)
    {
        $this->freelancer = $freelancer;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.company_notified')
                    ->subject('Freelancer Hired for Project');
    }
}

