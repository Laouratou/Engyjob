<?php

// app/Listeners/SendHiringEmails.php

namespace App\Listeners;

use App\Events\FreelancerHired;
use App\Mail\FreelancerHiredMail;
use Illuminate\Support\Facades\Mail;

class SendHiringEmails
{
    public function handle(FreelancerHired $event)
    {
        $proposal = $event->proposal;

        // Envoyer un e-mail au freelancer
        Mail::to($proposal->user->email)->send(new FreelancerHiredMail($proposal));

        // Envoyer un e-mail à l'entreprise (optionnel)
        // Mail::to($entrepriseEmail)->send(new CompanyHiredNotification($proposal));
    }
}
