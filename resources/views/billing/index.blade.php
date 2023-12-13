@extends('dashboard.dashboardLayout')

@section('konten2')
<div class="content">
    <h2 class="section-title"><strong>Billing List</strong></h2>
    <form action="{{ route('billing.exportPdf') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning  w-auto">Export to PDF</button>
    </form>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Warnet</th>
                    <th>Komputer</th>
                    <th>Customer</th>
                    <th>Billing</th>
                    <th>Expiration Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($billings as $billing)
                <tr>
                    <td>{{ $billing->id }}</td>
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
    </div>
</div>

<style>
    .section-title {
        color: #333;
    }

    .table-container {
        margin-top: 20px;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
@endsection