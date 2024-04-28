<!-- resources/views/payment/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
<form action="{{ route('payment.pay') }}" method="POST">
    @csrf
    <label for="amount">Amount (EUR):</label>
    <input type="number" id="amount" name="amount" min="10" max="100" step="0.01" required>
    <button type="submit">Pay</button>
</form>
</body>
</html>
