@extends('layouts.base_admin.base_dashboard')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Komputer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('list_komputer.index') }}">List Komputer</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Komputer</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif

    <form action="{{ route('list_komputer.update', $listKomputer->id_komputer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Data Komputer</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_warnet">Nama Warnet</label>
                            <select name="id_warnet" class="form-control">
                                @foreach($warnets as $warnet)
                                    <option value="{{ $warnet->id_warnet }}" {{ $warnet->id_warnet == $listKomputer->id_warnet ? 'selected' : '' }}>
                                        {{ $warnet->nama_warnet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_komputer">Nama Komputer</label>
                            <input type="text" name="nama_komputer" class="form-control" value="{{ $listKomputer->nama_komputer }}" required>
                        </div>
                        <div class="form-group">
                            <label for="processor">Processor</label>
                            <input type="text" name="processor" class="form-control" value="{{ $listKomputer->processor }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ram">Ram</label>
                            <input type="text" name="ram" class="form-control" value="{{ $listKomputer->ram }}" required>
                        </div>
                        <div class="form-group">
                            <label for="gpu">GPU</label>
                            <input type="text" name="gpu" class="form-control" value="{{ $listKomputer->gpu }}" required>
                        </div>
                        <!-- Add other form fields as needed -->
                    </div>
                </div>
                <a href="{{ route('list_komputer.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Update Komputer</button>
            </div>
        </div>
    </form>
</section>
@endsection
