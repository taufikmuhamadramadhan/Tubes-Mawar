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
    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    table th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
    <h2>Data Warnet</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Warnet</th>
                <th>Alamat</th>
                <!-- Tambahkan kolom-kolom lain jika diperlukan -->
            </tr>
        </thead>
        <tbody>
            @foreach($warnetData as $warnet)
            <tr>
                <td>{{ $warnet->id_warnet }}</td>
                <td>{{ $warnet->nama_warnet }}</td>
                <td>{{ $warnet->alamat }}</td>
                <!-- Tambahkan kolom-kolom lain jika diperlukan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
