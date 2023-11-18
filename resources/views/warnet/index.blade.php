<!-- resources/views/warnet/index.blade.php -->
@extends('layouts.base_admin.base_dashboard')

@section('content')
    <div class="container">
        <h2>Warnet List</h2>
        <a href="{{ route('warnet.create') }}" class="btn btn-primary">Add Warnet</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warnet as $warnetItem)
                    <tr>
                        <td>{{ $warnetItem->id_warnet }}</td>
                        <td>{{ $warnetItem->nama_warnet }}</td>
                        <td>{{ $warnetItem->alamat }}</td>
                        <td>
                            <a href="{{ route('warnet.show', $warnetItem->id_warnet) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('warnet.edit', $warnetItem->id_warnet) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('warnet.destroy', $warnetItem->id_warnet) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
