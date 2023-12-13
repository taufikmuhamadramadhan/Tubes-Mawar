<!-- pdf.blade.php -->

<style>
    /* Tambahkan gaya CSS di sini jika diperlukan */
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table th {
        background-color: #f2f2f2;
    }
</style>
</head>

<body>
    <h2>Data Billing Warnet</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Warnet</th>
                <th>Komputer</th>
                <th>Customer</th>
                <th>Billing</th>
                <th>Expiration Date</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($billings as $index => $billing)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $billing->warnet->nama_warnet }}</td>
                <td>{{ $billing->komputer->nama_komputer }}</td>
                <td>{{ $billing->customer->nama_customer }}</td>
                <td>{{ $billing->billing }}</td>
                <td>{{ $billing->exp_date }}</td>
                <td>{{ $billing->harga }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>

</html>