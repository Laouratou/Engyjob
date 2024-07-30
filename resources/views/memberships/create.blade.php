<!-- resources/views/memberships/create.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Abonnement</title>
</head>
<body>
    <h1>Créer un nouvel Abonnement</h1>

    <form action="{{ route('memberships.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nom de l'abonnement :</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="price">Prix :</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div>
            <label for="periodicity">Périodicité :</label>
            <select name="periodicity" id="periodicity" required>
                <option value="monthly">Mensuel</option>
                <option value="yearly">Annuel</option>
            </select>
        </div>
        <div>
            <button type="submit">Créer l'abonnement</button>
        </div>
    </form>

    <a href="{{ route('memberships.index') }}">Retour à la liste des abonnements</a>
</body>
</html>
