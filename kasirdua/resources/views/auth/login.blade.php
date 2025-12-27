<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Login</title>
    <x-style />
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        .card {
            background: rgba(162, 133, 133, 0.95);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row align-items-center justify-content-center py-5  " style="min-height: 100vh">
            <div class="col-md-5 ">
                <div class="card border-0 shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body p-5 " >
                        <a href="." class="logo mb-4">
                            <img src="assets/images/logo.png" alt="Logo">
                            <span>kasir dua</span>
                        </a>

                        <h5 class="text-dark fw-bold mb-4">Sign In</h5>
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="mb-1">Username</label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror "
                                    placeholder="Tuliskan Username" value="{{ old('username') }}" required autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="mb-1">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password kamu" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword"
                                        title="Show/Hide Password">
                                        <span id="toggleIcon">👁️</span>
                                    </button>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <!-- <div class="mb-3 text-end">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">gaada akun?</a>
                                    </div> -->
                            <button class="btn btn-primary d-block w-100" type="submit" id="loginBtn">
                                <span id="loginBtnText">Sign In</span>
                                <span id="loginBtnSpinner"
                                    class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-script />
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.textContent = type === 'password' ? '👁️' : '🙈';
        });


        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('loginBtnText').classList.add('d-none');
            document.getElementById('loginBtnSpinner').classList.remove('d-none');
        });
    </script>
</body>

</html>

