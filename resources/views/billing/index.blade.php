<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
</head>
<body>
    <h1>Transaction History</h1>

    @foreach ($transactions as $transaction)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <h2>Transaction ID: {{ $transaction->id }}</h2>
            <p><strong>Warnet:</strong> {{ $transaction->warnet->name }}</p>
            <p><strong>Computer:</strong> {{ $transaction->komputer->name }}</p>
            <p><strong>Customer:</strong> {{ $transaction->customer->name }}</p>
            <p><strong>Billing:</strong> {{ $transaction->billing }} minutes</p>
            <p><strong>Expiration Date:</strong> {{ $transaction->exp_date }}</p>
            <p><strong>Price:</strong> ${{ $transaction->harga }}</p>
            <p><strong>Transaction Time:</strong> {{ $transaction->created_at }}</p>
        </div>
    @endforeach
</body>
</html>