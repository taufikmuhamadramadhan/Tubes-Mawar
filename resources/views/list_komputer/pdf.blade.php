<!-- pdf.blade.php for ListKomputer -->

<style>
    /* Add CSS styles here if needed */
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
    <h2>Data List Komputer</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Komputer</th>
                <th>Processor</th>
                <th>Ram</th>
                <th>GPU</th>
                <th>Nama Warnet</th>
                <!-- Add other columns if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($listKomputerData as $listKomputer)
            <tr>
                <td>{{ $listKomputer->id_komputer }}</td>
                <td>{{ $listKomputer->nama_komputer }}</td>
                <td>{{ $listKomputer->processor }}</td>
                <td>{{ $listKomputer->ram }}</td>
                <td>{{ $listKomputer->gpu }}</td>
                <td>{{ $listKomputer->warnet ? $listKomputer->warnet->nama_warnet : '' }}</td>
                <!-- Add other columns if needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
