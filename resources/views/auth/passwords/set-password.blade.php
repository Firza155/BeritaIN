@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Setel Kata Sandi Baru</h5>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <p class="mb-4">Masukkan kata sandi baru untuk akun Anda.</p>
                    </div>
                    <form method="POST" action="{{ route('password.set') }}" class="user">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('reset_email') }}">
                        <div class="form-group">
                            <input id="password" type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Kata Sandi Baru" required autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Konfirmasi Kata Sandi Baru" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
