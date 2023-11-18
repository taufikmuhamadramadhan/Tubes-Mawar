<!-- resources/views/warnet/show.blade.php -->

@extends('layouts.base_admin.base_dashboard')

@section('content')
    <div class="container">
        <h2>Warnet Details</h2>

        <table class="table mt-3">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $warnet->id_warnet }}</td>
                </tr>
                <tr>
                    <th>Nama Warnet</th>
                    <td>{{ $warnet->nama_warnet }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $warnet->alamat }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('warnet.edit', $warnet->id_warnet) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('warnet.destroy', $warnet->id_warnet) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>

        <a href="{{ route('warnet.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
