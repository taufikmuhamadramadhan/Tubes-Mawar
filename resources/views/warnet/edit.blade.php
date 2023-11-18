<!-- resources/views/warnet/edit.blade.php -->

@extends('layouts.base_admin.base_dashboard')

@section('content')
    <div class="container">
        <h2>Edit Warnet</h2>

        <form action="{{ route('warnet.update', $warnet->id_warnet) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_warnet" class="form-label">Nama Warnet</label>
                <input type="text" class="form-control" id="nama_warnet" name="nama_warnet" value="{{ $warnet->nama_warnet }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ $warnet->alamat }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('warnet.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
