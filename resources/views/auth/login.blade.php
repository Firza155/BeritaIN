<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Halaman login sistem">
    <meta name="author" content="">
    <title>Login - Sistem Manajemen</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('startbootstrap-sb-admin-2-gh-pages/img/undraw_profile.svg') }}">
    
    <!-- Custom fonts -->
    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles -->
    <link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #2e59d9;
            --success: #1cc88a;
            --light: #f8f9fc;
        }
        
        body {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Nunito', sans-serif;
        }
        
        .bg-login-image {
            background: url("{{ asset('startbootstrap-sb-admin-2-gh-pages/img/undraw_secure_login_pdn4.svg') }}") center center no-repeat;
            background-size: contain;
            min-height: 300px;
            margin: 2rem 0;
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 0.35rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .login-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0;
        }
        
        .login-features li {
            margin-bottom: 0.75rem;
            color: #5a5c69;
        }
        
        .login-features i {
            color: var(--success);
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <!-- Gambar Samping -->
                        <div class="col-lg-6 d-none d-lg-flex flex-column p-5 bg-light">
                            <div class="text-center mb-4">
                                <h2 class="h3 text-primary mb-3">Selamat Datang Kembali!</h2>
                                <p class="text-muted">Masuk untuk melanjutkan ke sistem manajemen</p>
                            </div>
                            <div class="bg-login-image"></div>
                            <ul class="login-features">
                                <li><i class="fas fa-check-circle"></i> Akses penuh ke semua fitur</li>
                                <li><i class="fas fa-check-circle"></i> Keamanan data terjamin</li>
                                <li><i class="fas fa-check-circle"></i> Dukungan teknis 24/7</li>
                            </ul>
                        </div>
                        
                        <!-- Form Login -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center mb-5">
                                    <h1 class="h4 text-gray-900 font-weight-bold mb-2">Masuk ke Akun Anda</h1>
                                    <p class="text-muted">Silakan masukkan email dan password</p>
                                </div>
                                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                                    @csrf
                                    
                                    <!-- Email -->
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold">Alamat Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" 
                                                required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group mb-4">
                                        <div class="d-flex justify-content-between">
                                            <label class="small font-weight-bold">Password</label>
                                            <a href="#" id="forgot-password-link" class="small text-primary">Lupa Password?</a>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('forgot-password-link').addEventListener('click', function(e) {
            e.preventDefault();
            var email = document.getElementById('email').value;
            if (!email) {
                alert('Silakan isi email terlebih dahulu.');
                return;
            }
            window.location.href = "{{ route('password.request') }}" + "?email=" + encodeURIComponent(email);
        });
    });
</script>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" required 
                                                autocomplete="current-password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Ingat Saya -->
                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label small" for="remember">Ingat Saya</label>
                                        </div>
                                    </div>

                                    <!-- Tombol Login -->
                                    <button type="submit" class="btn btn-primary btn-block py-2 mb-3">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                                    </button>

                                    <!-- Belum Punya Akun -->
                                    <div class="text-center mt-4">
                                        <p class="small text-muted mb-0">Belum punya akun?
                                            <a href="{{ route('register') }}" class="text-primary font-weight-bold">Daftar disini</a>
                                        </p>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JavaScript -->
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') }}"></script>
    
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');
            
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
</body>
</html>
