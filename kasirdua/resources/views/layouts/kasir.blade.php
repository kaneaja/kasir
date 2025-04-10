<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <title>Halaman Depan</title>

    
    <x-style/>
</head>

<body class="bg-soft-blue">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container-fluid">
            <a href="." class="navbar-brand logo">
                <img src="assets/images/logo.png" alt=""> KasirOnlen
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto gap-2">
                    <li class="nav-item">
                        <a href="." class="nav-link px-4 {{ Request::is('/') ? 'active' : ''}}">Kasir</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('kasir.order-list')}}" class="nav-link px-4 {{ Request::is('order-list') ? 'active' : ''}}">Order List</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                             {{Auth:: user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li>
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    {{Auth:: user()->roles}}
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{route(name: 'logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="pt-5 pb-4">
        <div class="container">
            <p class="mb-0 text-center text-secondary fs-7">
                Copyright &copy; PT Onlenkan Teknologi Indonesia 2024. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

    {{-- <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <x-script />
    <script>
        document.getElementById('checkoutModal').addEventListener('shown.bs.modal', function () {
            document.getElementById('name').focus();
        });


        function formatNumber(input) {
            // Menghapus karakter non-digit dari nilai input
            let cleanedValue = input.value.replace(/\D/g, '');

            // Memisahkan nilai menjadi bagian ribuan dengan menggunakan regular expression
            cleanedValue = cleanedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Memperbarui nilai input dengan format yang diinginkan
            input.value = cleanedValue;
            document.getElementById('nominal').value = cleanedValue.replace(/,/g, '');
        }
    </script>
</body>

</html>
