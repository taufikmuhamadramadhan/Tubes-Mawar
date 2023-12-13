@extends('dashboard.dashboardLayout')

@section('konten2')
<div class="content">
    <h2><strong>Data Warnet</strong></h2>
    <div class="row">
        @forelse ($warnets as $warnet)
            <div class="col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $warnet->nama_warnet }}</h5>
                        <p class="card-text">{{ $warnet->alamat }}</p>
                        <a href="dataKomputer" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
        @empty
            <h5 class="card-title text-black">No data available</h5>
        @endforelse
    </div>
@endsection
