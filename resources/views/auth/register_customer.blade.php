@extends('layouts.base_admin.base_auth')@section('judul', 'Halaman Registrasi') @section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#">
            <b>MAWAR</b>Main Warnet</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrasi Akun Baru</p>

            <form action="{{ route('submit.register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="inputName" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" placeholder="Masukkan Nama" value="{{ old('nama_customer') }}" required="required" autocomplete="nama_customer">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('nama_customer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="no_telp" placeholder="Nomor Telephone" type="no_telp" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required="required" autocomplete="no_telp">
                    {{-- <input type="text" class="form-control" > --}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    @error('no_telp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="username" placeholder="Username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required="required" autocomplete="username">
                    {{-- <input type="text" class="form-control" > --}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" placeholder="Kata Sandi" class="form-control @error('password') is-invalid @enderror" name="password" required="required" autocomplete="new-password">
                    {{-- <input type="password" class="form-control" > --}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        {{-- <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                 I agree to the <a href="#">terms</a>
                </label>
              </div> --}}
                        Sudah punya akun? <a href="{{ route('loginCustomer') }}" class="text-center">Login</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.card -->
</div>
@endsection