<!-- resources/views/withdraw.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait d'argent</title>
</head>
<body>
    <h1>Retirer de l'argent</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('withdraw.process') }}" method="POST">
        @csrf
        <label for="amount">Montant:</label>
        <input type="text" name="amount" id="amount" required>
        <br>
        <label for="bank_account">Compte bancaire:</label>
        <input type="text" name="bank_account" id="bank_account" required>
        <br>
        <button type="submit">Retirer</button>
    </form>
</body>
</html>
