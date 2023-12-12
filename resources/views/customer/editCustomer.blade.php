@extends('layouts.base_admin.base_dashboard')
@section('judul', 'Ubah Akun')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ubah Akun</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Ubah Akun</li>
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
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Data Diri</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input type="text" id="inputName" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" placeholder="Masukkan Nama" value="{{ $customer->nama_customer }}" required="required" autocomplete="nama_customer">
                            @error('nama_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" id="inputUsername" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username" value="{{ $customer->username }}" required="required" autocomplete="username">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input id="inputPassword" type="password" placeholder="Kata Sandi" class="form-control @error('password') is-invalid @enderror" name="password" required="required" autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputBilling">Billing</label>
                            <input type="text" id="inputBilling" name="billing" class="form-control @error('billing') is-invalid @enderror" placeholder="Masukkan Billing" value="{{ $customer->billing }}" required="required" autocomplete="billing">
                            @error('billing')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNoTelp">No. Telp</label>
                            <input type="text" id="inputNoTelp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Masukkan No. Telp" value="{{ $customer->no_telp }}" required="required" autocomplete="no_telp">
                            @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputCreateDate">Create Date</label>
                            <input type="date" id="inputCreateDate" name="create_date" class="form-control @error('create_date') is-invalid @enderror" value="{{ $customer->create_date }}" required="required" autocomplete="create_date">
                            @error('create_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Ubah Akun" class="btn btn-success float-right">
                <!-- /.card -->
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection

@section('script_footer')

@endsection
