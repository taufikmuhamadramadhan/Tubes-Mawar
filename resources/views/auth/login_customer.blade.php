@extends('layouts.base_admin.base_auth') @section('judul', 'Halaman Login') @section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="#">
            <b>Welcome to </b>MAWAR</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

            <form method="POST" action="{{ route('loginCustomer') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="username" type="text" placeholder="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required="required" autocomplete="username" autofocus="autofocus">
                    {{-- <input type="username" class="form-control" placeholder="username" autocomplete="off"> --}}
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
                    {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required="required" autocomplete="current-password">
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
                    <!-- <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Ingat sesi saya
                            </label>
                        </div>
                    </div> -->
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>


            <p class="mb-0">
                Belum mempunyai akun?
                <a href="{{ route('customer.register') }}" class="text-center">Register</a>
            </p>
            <!-- /.social-auth-links -->

            <!-- <p class="mb-1">
                
            </p> -->
            <!-- <p class="mb-0">
                Belum mempunyai akun?
                
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection

<!-- /.login-box -->