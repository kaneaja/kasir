<!DOCTYPE html>
<html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
            <title>Login</title>
            <x-style />
        </head>

        <body class="bg-danger bg-gradient">

            <div class="container">
                <div class="row align-items-center justify-content-center py-5 " style="min-height: 100vh">
                    <div class="col-md-5">
                        <div class="card border-0 shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-body p-5">
                                <a href="." class="logo mb-4">
                                    <img src="assets/images/logo.png" alt="Logo">
                                    <span>kasir dua</span>
                                </a>

                                <h5 class="text-dark fw-bold mb-4">Sign In</h5>
                                <form method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="mb-1">Alamat Email</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror "
                                            placeholder="Tuliskan Username" value="{{ old('username') }}" required autofocus>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="mb-1">Password</label>
                                        <input type="password" name="password" class="form-control form-control @error('password') is-invalid @enderror" name="password""
                                            placeholder="Masukkan password kamu" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <button class="btn btn-primary d-block w-100" type="submit">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-script />
               <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
         </body>
</html>

