<!DOCTYPE html>
<html>
<head>
    <title>Notification d'embauche de freelancer</title>
</head>
<body>
    <h2>Notification d'embauche de freelancer</h2>
    <p>Chère Entreprise,</p>
    <p>Un freelancer a été embauché pour le projet "{{ $project->name }}".</p>
    <p>Détails du projet :</p>
    <ul>
        <li>ID du freelancer : {{ $project->freelancer_id }}</li>
        <li>Statut : {{ $project->status }}</li>
        <li>Date d'embauche : {{ $project->hired_on }}</li>
    </ul>
    <p>Merci,</p>
    <p>L'équipe de votre entreprise</p>
</body>
</html>
