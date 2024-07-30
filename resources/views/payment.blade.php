<!-- resources/views/payment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>
<body>
    <h1>Payment Form</h1>
    
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payment.initiate') }}" method="POST">
        @csrf
        
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" value="{{ old('amount') }}" required>
        @error('amount')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="{{ old('description') }}" required>
        @error('description')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
        @error('phone')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        
        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>
