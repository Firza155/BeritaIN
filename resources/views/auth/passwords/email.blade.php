@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __('Reset Password') }}</h5>
                </div>
                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <p class="mb-4">Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}" class="user">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                                   name="email" value="{{ request('email', old('email')) }}" 
                                   placeholder="Masukkan alamat email..." 
                                   required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Kirim Link Reset Password') }}
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('login.form') }}">Kembali ke halaman login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
