<!DOCTYPE html>
<html>
<head>
    <title>Email de confirmation d'embauche</title>
</head>
<body>
    <h2>Vous avez été embauché !</h2>
    @if ($proposal->freelancer)
        <p>Bonjour {{ $proposal->freelancer->name }},</p>
    @else
        <p>Bonjour,</p>
    @endif

    @if ($proposal->project)
        <p>Félicitations ! Vous avez été embauché pour le projet "{{ $proposal->project->name }}".</p>
    @else
        <p>Félicitations ! Vous avez été embauché pour un projet.</p>
    @endif

    <p>Le projet est maintenant en cours.</p>
    
    <p>Merci,</p>
    <p>L'équipe de votre entreprise</p>
</body>
</html>
