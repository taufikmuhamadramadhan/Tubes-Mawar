@extends('layouts.base_admin.base_dashboard')

@section('content')
    <div class="container">
        <h1>Billing List</h1>
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
                        <td>{{ $billing->warnet->name }}</td>
                        <td>{{ $billing->komputer->name }}</td>
                        <td>{{ $billing->customer->name }}</td>
                        <td>{{ $billing->billing }}</td>
                        <td>{{ $billing->exp_date }}</td>
                        <td>{{ $billing->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
