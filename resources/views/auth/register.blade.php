<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Halaman pendaftaran akun baru">
    <meta name="author" content="">
    <title>Daftar Akun - Sistem Manajemen</title>
    
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
        
        .bg-register-image {
            background: url("{{ asset('startbootstrap-sb-admin-2-gh-pages/img/undraw_join_re_w1lh.svg') }}") center center no-repeat;
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
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .register-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0 0;
        }
        
        .register-features li {
            margin-bottom: 0.75rem;
            color: #5a5c69;
        }
        
        .register-features i {
            color: var(--success);
            margin-right: 0.5rem;
        }
        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .text-primary {
            color: var(--primary) !important;
        }
        .input-group-text {
            background-color: white;
            border-right: none;
            border-radius: 0.5rem 0 0 0.5rem;
            color: #d1d3e2;
        }
        .input-group .form-control {
            border-left: none;
            padding-left: 0;
            border-radius: 0 0.5rem 0.5rem 0;
        }
        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        .register-features {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0;
        }
        .register-features li {
            margin-bottom: 0.75rem;
            color: #5a5c69;
        }
        .register-features i {
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
                                <h2 class="h3 text-primary mb-3">Selamat Datang!</h2>
                                <p class="text-muted">Bergabunglah bersama kami untuk pengalaman manajemen yang lebih baik</p>
                            </div>
                            <div class="bg-register-image"></div>
                            <ul class="register-features">
                                <li><i class="fas fa-check-circle"></i> Manajemen data terintegrasi</li>
                                <li><i class="fas fa-check-circle"></i> Keamanan terjamin</li>
                                <li><i class="fas fa-check-circle"></i> Dukungan 24/7</li>
                            </ul>
                        </div>
                        
                        <!-- Form Register -->
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center mb-5">
                                    <h1 class="h4 text-gray-900 font-weight-bold mb-2">Buat Akun Baru</h1>
                                    <p class="text-muted">Isi data dibawah untuk membuat akun</p>
                                </div>
                                <!-- Pesan Session -->
                                 @if (session('success'))
                                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                @if (session('status'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" class="mt-4">
                                    @csrf
                                    
                                    <!-- Nama Lengkap -->
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Nama Lengkap</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}" 
                                                required autocomplete="name" autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Alamat Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" 
                                                required autocomplete="email">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Role -->
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Pilih Peran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user-tag"></i>
                                                </span>
                                            </div>
                                            <select name="role" class="form-control" style="height: calc(2.5rem + 2px); padding: 0.375rem 1rem;" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="wartawan">Wartawan</option>
                                                <option value="editor">Editor</option>
                                            </select> 
                                        </div>
                                        @error('role')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label class="small font-weight-bold">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" name="password" required 
                                                autocomplete="new-password" placeholder="Minimal 8 karakter">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Konfirmasi Password -->
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control form-control-user"
                                                id="password-confirm" name="password_confirmation" required 
                                                autocomplete="new-password">
                                        </div>
                                    </div>

                                    <!-- Tombol Daftar -->
                                    <button type="submit" class="btn btn-primary btn-block py-2 mb-3">
                                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                                    </button>

                                    <!-- Sudah Punya Akun -->
                                    <div class="text-center mt-4">
                                        <p class="small text-muted mb-0">Sudah memiliki akun?
                                            <a href="{{ route('login') }}" class="text-primary font-weight-bold">Masuk disini</a>
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
    <!-- Core JavaScript -->
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') }}"></script>
    
    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            function createToggleButton() {
                const toggleBtn = document.createElement('button');
                toggleBtn.type = 'button';
                toggleBtn.className = 'btn btn-outline-secondary';
                toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
                toggleBtn.style.borderTopLeftRadius = '0';
                toggleBtn.style.borderBottomLeftRadius = '0';
                return toggleBtn;
            }

            // Add toggle to password field
            const passwordInput = document.getElementById('password');
            const passwordToggle = createToggleButton();
            passwordInput.parentNode.appendChild(passwordToggle);

            // Add toggle to confirm password field
            const confirmPasswordInput = document.getElementById('password-confirm');
            const confirmPasswordToggle = createToggleButton();
            confirmPasswordInput.parentNode.appendChild(confirmPasswordToggle);

            // Toggle password visibility function
            function togglePasswordVisibility(input, toggleBtn) {
                const icon = toggleBtn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }

            // Add event listeners
            passwordToggle.addEventListener('click', function() {
                togglePasswordVisibility(passwordInput, this);
            });

            confirmPasswordToggle.addEventListener('click', function() {
                togglePasswordVisibility(confirmPasswordInput, this);
            });

             confirmPasswordToggle.addEventListener('click', function() {
                togglePasswordVisibility(confirmPasswordInput, this);
            });
        });
    </script>
</body>
</html>
